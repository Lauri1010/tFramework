<?php

/**
 * The system runs Using batches. This mainly because there is no point in crashing "the whole" crawl stack because of a failure on one scraping ran. 
 * 
 * 
CREATE PROCEDURE resetCategoryLink
BEGIN

  SELECT @max := MAX(store_category_link_id)+ 1 FROM store_product_categorylinks; 

  PREPARE stmt FROM 'ALTER TABLE store_product_categorylinks AUTO_INCREMENT = ?';
  EXECUTE stmt USING @max;

  DEALLOCATE PREPARE stmt;

END $$

Full refresh: starts all over again.. 
If full refresh is not on the system starts store spesific reset. 


 */
 
try{

updateStoresToDatabase();

}catch(Exception $e){
	
	print_r($e);
}

// $scraped_data = scrape_between($scraped_page, "<title>", "</title>");   // Scraping downloaded dara in $scraped_page for content between <title> and </title> tags

// echo $scraped_data;
 

function updateStoresToDatabase($fullRefresh=true,$batches=2){
	
	
	// Start the batches
	
	$batchIndex=1;

	$oldDeleted=true;
	$autoIncrementReset=true;

	$maxStorecategoryLink="SELECT MAX(store_category_link_id) as maxCategoryLikId FROM store_product_categorylinks";
	
	require_once 'C:/nginx/framework/lib/database.class.php';
	
	$db = new Database();
	
	/*
	 * Full refresh: when everything is run at once
	 * Not full refresh: run when there have been some errors. 
	 * The system automatically sets the states to 3 after a full refresh
	 * Then it will run it again. 
	 * 
	 * */
	
	if($fullRefresh){
	
		// Usefull when deleting large rows of data.
			
		$sqlDeleteCategories="DELETE FROM store_product_categorylinks LIMIT 1000";
	
	
		do{
				
			$db->prepare($sqlDeleteCategories);
				
			$oldDeleted=$db->execute();
				
			$deletedCount=$db->rowCount();
	
		}while($deletedCount!=0);
	
 		$resetAutoIncrement="ALTER TABLE store_product_categorylinks AUTO_INCREMENT=1";
	
		$db->prepare($resetAutoIncrement);
	
		$autoIncrementReset=$db->execute();  

	}
	

			while($batchIndex<$batches){

			// 1.  Get the store URL:s from the database. Will check the date: when was the store udpated last time.
				
			/* 	$db->prepare("SELECT s.store_id,s.store_name,s.store_link,s.store_image,s.store_type_ref,s.store_discount_start_page,s.store_products_updated,s.store_categories_updated,
			 su.store_url, su.store_discount_url_start, su.store_url_category_html_container
			 FROM store s JOIN store_url su ON(s.store_id=su.store_url_store_ref)
			 WHERE store_categories_updated < DATE_SUB(NOW(), INTERVAL 90 DAY)
			 AND su.store_url_language='fi'"); */
				
			// This can simply be run every 90 days or so. no need to keep track of this so often.
				
			$db->prepare("SELECT s.store_id,s.store_name,s.store_link,s.store_image,s.store_type_ref,s.store_discount_start_page,s.store_products_updated,s.store_categories_updated,
					su.store_url, su.store_discount_url_start, su.store_url_category_html_container,su.store_url_category_html_mainheading,su.store_url_category_html_subheadings
					FROM store s JOIN store_url su ON(s.store_id=su.store_url_store_ref)
					JOIN store_country_language scl ON(scl.store_country_language_id_ref=s.store_id)
					JOIN crawl_category_batch_row_run ccbe ON(ccbe.store_id_batch_ref=s.store_id)
					JOIN crawl_category_batch_run_index ccbri ON(ccbe.batch_index_ref=ccbri.batch_run_index)
					WHERE scl.store_language_ref=1 AND scl.store_country_ref=1 AND ccbri.success_state=3
					AND ccbe.batch_index_ref=$batchIndex
					");

			$rows = $db->resultset();
			
			
			if(!empty($rows)){
			
				// Individual refresh is there has been some error in the full refresh.  
				
				if(!$fullRefresh){
				
					/* 				$db->prepare($maxStorecategoryLink);
				
					// Used to reset the auto increment.
					$maxCategoryLikIdArray=$db->single();
					$maxCategoryLikId=$maxCategoryLikIdArray['maxCategoryLikId'];
						
					// Delete the old links if some exist.
						
					if($maxCategoryLikId!=null){
					*/
						
					$deleteOldcategories="DELETE FROM store_product_categorylinks WHERE store_product_categories_store_ref IN( ";
						
					$firstDeleteRow=true;
						
					foreach($rows as $storeDataRow){
				
						$storeId=$storeDataRow['store_id'];
				
						if($firstDeleteRow){
								
							$deleteOldcategories.=$storeId;
							$firstDeleteRow=false;
								
						}else{
								
							$deleteOldcategories=",".$storeId;
								
						}
				
				
				
					}
					
					$deleteOldcategories.=")";
						
					$oldDeleted=$db->prepare($deleteOldcategories);
					$$deleteOldcategoriescte();
						
						
					/* 				if($oldDeleted){
				
					$deletedRows=$db->rowCount();
				
					// After this delete, update the autoincrements
				
					// Calculate the auto increment:
				
					$newAutoIncrement=($maxCategoryLikId+1)-$deletedRows;
				
					var_dump($newAutoIncrement);
				
					$resetAutoIncrement="ALTER TABLE store_product_categorylinks AUTO_INCREMENT=".$newAutoIncrement;
				
					$db->prepare($resetAutoIncrement);
					$autoIncrementReset=$db->execute();
				
				
					} */
						
						
					// }
							
				}
				
				
				// exit;
			
				$firstRow=true;
				
				if($oldDeleted && $autoIncrementReset and !empty($rows)){
			
					// Get the product categories and product data. If product data html container does not contain # it is a class or other selector
					
					require_once 'C:/nginx/framework/lib/simplePhpDom/advanced_html_dom.php';
			
					require_once 'C:/nginx/framework/lib/curlFunctions.php';
						
					$dom = new AdvancedHtmlDom();
					
					$iStoreProductCat='INSERT INTO store_product_categorylinks (store_category_link_id,store_product_categories_store_ref,url_main_heading,store_category_link,store_category_link_text) VALUES ';
					
					$count=0;
					
					foreach($rows as $storeDataRow){
					
						$count++;
						
						
						$storeId=$storeDataRow['store_id'];

						$toBefetchedUrl=$storeDataRow['store_url'];
						
						$toBeFetchedCategory=$storeDataRow['store_url_category_html_container'];
						
						$storeCategoryMainHeadingContainer=$storeDataRow['store_url_category_html_mainheading'];
						
						$storeUrlCategorySubheadings=$storeDataRow['store_url_category_html_subheadings'];

				
						$rawData = curl($toBefetchedUrl);
					
						$dom->load($rawData);
						
				
						// Note that for simplicity (and to save time) the statement has not been bind. This however should not be an issue, because the data comes from our own scraper
						// However if you need to purify the data you can do it for each statement
						
	/* 					$firstRow=true;
						
	 					$insertQuery = array();
						$insertData = array();
						$n = 0;
						
						foreach($dom->find("{$toBeFetchedCategory} a") as $linkHtml){
							
							$linkUrl=$linkHtml->href;
							
							$linkText=$linkHtml->innertext;
	
							if($firstRow){
							
								$iStoreProductCat.= '(NULL, :store_product_categories_store_ref'.$n.', :store_category_link'.$n.', :store_category_link_text'.$n.')';
								$firstRow=false;
								
							}else{
								
								$iStoreProductCat.= ', (NULL, :store_product_categories_store_ref'.$n.', :store_category_link'.$n.', :store_category_link_text'.$n.')';
							}
							
							
							$insertData[$n][':store_product_categories_store_ref' . $n] = $storeId;
							$insertData[$n][':store_category_link' . $n]=$linkUrl;
							$insertData[$n][':store_category_link_text' . $n] = $linkText;
							
							$n++;
							
						}
						
						$success=false;
						
						if (!empty($insertQuery)) {
							
							$db->prepare($iStoreProductCat);
							
		
							foreach($insertData as $key => $dataToBind){
			
					
								
	 							$store_product_categories_store_ref_value=$dataToBind[':store_product_categories_store_ref'.$key];
								
								$store_category_link_value=$dataToBind[':store_category_link'.$key];
								
								$store_category_link_text_value=$dataToBind[':store_category_link_text'.$key];
	
								
								$db->bind(':store_product_categories_store_ref'.$key, $store_product_categories_store_ref_value);
								
								$db->bind(':store_category_link'.$key, $store_category_link_value);
								
								$db->bind(':store_category_link_text'.$key, $store_category_link_text_value); 

							}
							
							$success=$db->execute();
						} */ 

	 					$success=false;
	 					
	 					// $hasGeneralLinkHeadings=$row['has_general_link_headings'];

	 					// 1. Get the main container
	 					// 2. Get the main heading data
	 					//    and for it every subheading
						
						foreach($dom->find($toBeFetchedCategory) as $mainNavigationHtml){
													
							// Another find
							
							$mainHeadingcontainer=$mainNavigationHtml->find($storeCategoryMainHeadingContainer);
							
							$mainHeading=utf8_decode($mainHeadingcontainer->text());
							
							foreach($mainNavigationHtml->find($storeUrlCategorySubheadings) as $subheadingHtml){

								$linkUrl=$subheadingHtml->href;
									
								$linkText=utf8_decode($subheadingHtml->text());

								if($firstRow){
										
									$iStoreProductCat.="(NULL, {$storeId}, '{$mainHeading}','{$linkUrl}','{$linkText}')";
									$firstRow=false;
										
								}else{
								
									$iStoreProductCat.=", (NULL, {$storeId}, '{$mainHeading}','{$linkUrl}','{$linkText}')";
								
								}
								
								
							}
							
						
				
						}

						// echo $iStoreProductCat;
						
						$db->prepare($iStoreProductCat);
						$success=$db->execute(); 
						
/* 						echo "Count ".$count;
						echo "<br/><br/>";
						echo "store id ".$storeId; */

			
					}
					
					if($success){
					
						// Everything went smoothly, save the successfull batch to database.
					
/* 						$saveBatchStateTodatabaseSql="UPDATE crawl_category_batch_run_index SET success_state = 1 WHERE batch_run_index=".$batchIndex;
					
						$db->prepare($saveBatchStateTodatabaseSql);
					
						// $db->bind(":batchRunIndex", $batchIndex);
					
						$autoIndicesUpdated=$db->execute(); */
					
					}
				
				}
			
				
			}
		
			$batchIndex++;
	
		}
	
	
}



?>