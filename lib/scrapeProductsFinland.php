<?php


function updateStoresToDatabase(){
	
	
	require 'C:/nginx/framework/lib/database.class.php';
	
	$db = new Database();
	
	// 1.  Get the store URL:s from the database. Will check the date: when was the store udpated last time. 
	
/* 	$db->prepare("SELECT s.store_id,s.store_name,s.store_link,s.store_image,s.store_type_ref,s.store_discount_start_page,s.store_products_updated,s.store_categories_updated, 
				 su.store_url, su.store_discount_url_start, su.store_url_category_html_container 
				 FROM store s JOIN store_url su ON(s.store_id=su.store_url_store_ref)
			     WHERE store_categories_updated < DATE_SUB(NOW(), INTERVAL 90 DAY)
			     AND su.store_url_language='fi'"); */
	
	// This can simply be run every 90 days or so. no need to keep track of this so often. 
	
	$db->prepare("SELECT s.store_id,s.store_name,s.store_link,s.store_image,s.store_type_ref,s.store_discount_start_page,s.store_products_updated,s.store_categories_updated,
				 su.store_url_discounts_html_container,su.store_discount_url_start,
				 p.product_id,p.product_name,p.price,p.discount_price,p.discount.url
				 FROM store s JOIN product p ON(s.store_id=p.product_store_ref)
				 FROM store s JOIN store_url su ON(s.store_id=su.store_url_store_ref)
			     JOIN store_country_language scl ON(scl.store_country_language_id_ref=s.store_id)
			     WHERE scl.store_language_ref=1 AND scl.store_country_ref=1");
	
	$rows = $db->resultset();
	
	$maxStorecategoryLink="SELECT MAX(product_id) as maxProductId FROM product";
	
	$db->prepare($maxStorecategoryLink);
	
	// Used to reset the auto increment. 
	$productIdArray=$db->single();
	$maxProductId=$productIdArray['maxProductId'];
	
	$oldDeleted=true;
	$autoIncrementReset=true;
	
	// Delete the old links if some exist. 

	if($maxProductId!=null){
	
		$deleteOldcategories="DELETE FROM product WHERE product_store_ref IN( ";
		
		$firstDeleteRow=true;
		
		foreach($rows as $storeDataRow){
			
			$storeId=$storeDataRow['store_id'];
			
			if($firstDeleteRow){
				
				$deleteOldcategories.=$storeId;
				$firstDeleteRow=false;
				
			}else{
				
				$deleteOldcategories.=",$storeId ";
				
			}
			
	
			
		}
		
		$deleteOldcategories.=")";
		
		$db->prepare($deleteOldcategories);
		$oldDeleted=$db->execute();
		$deletedRows=$db->rowCount();
		
		// After this delete, update the autoincrements
		
		// Calculate the auto increment: 
		
		$newAutoIncrement=($maxProductId+1)-$deletedRows;

		$resetAutoIncrement="ALTER TABLE store AUTO_INCREMENT=".$newAutoIncrement;
		
		$db->prepare($resetAutoIncrement);
		$autoIncrementReset=$db->execute();
	
	}
	
	// exit;

	if($oldDeleted && $autoIncrementReset){

		// Get the product categories and product data. If product data html container does not contain # it is a class or other selector
		
		require 'C:/nginx/framework/lib/simplePhpDom/simple_html_dom.php';

		require 'C:/nginx/framework/lib/curlFunctions.php';
			
		$dom = new simple_html_dom();
		
		
		foreach($rows as $storeDataRow){
		
			
			$storeId=$storeDataRow['store_id'];
			
			$toBefetchedUrl=$storeDataRow['store_discount_url_start'];
			
			$toBeFetchedProductContainer=$storeDataRow['store_url_discounts_html_container'];
			
	
			$rawData = curl($toBefetchedUrl);
		
			$dom->load($rawData);
			
			$iStoreProductCat="INSERT INTO products (store_category_link_id,store_product_categories_store_ref,store_category_link) VALUES ";
	
			// Note that for simplicity (and to save time) the statement has not been bind. This however should not be an issue, because the data comes from our own scraper
			// However if you need to purify the data you can do it for each statement
			
			$firstRow=true;
			
			foreach($dom->find("{$toBeFetchedProductContainer} a") as $linkHtml){
			
				$linkUrl=$linkHtml->href;
				
				if($firstRow){
				
					$iStoreProductCat.="(NULL, $storeId, '$linkUrl')";
					$firstRow=false;
				
				}else{
					
					$iStoreProductCat.=", (NULL, $storeId, '$linkUrl')";
					
				}
	
			}
	
			$db->prepare($iStoreProductCat);
			$success=$db->execute();

		}
	
	}
	

	
	
}


updateStoresToDatabase();

// $scraped_data = scrape_between($scraped_page, "<title>", "</title>");   // Scraping downloaded dara in $scraped_page for content between <title> and </title> tags
 
// echo $scraped_data; 


?>