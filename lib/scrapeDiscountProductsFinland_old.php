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
				 su.store_url, su.store_discount_url_start, su.store_url_category_html_container
				 FROM store s JOIN store_url su ON(s.store_id=su.store_url_store_ref)
			     su.store_url_language='fi'");
	
	$rows = $db->resultset();
	
	// Delete old categories
	
	$deleteOldcategories="DELETE FROM store_product_categorylinks WHERE store_product_categories_store_ref IN( ";
	
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
	
	var_dump($oldDeleted); exit;

	if($oldDeleted){

		// Get the product categories and product data. If product data html container does not contain # it is a class or other selector
		
		foreach($rows as $storeDataRow){
		
			require 'C:/nginx/framework/lib/simplePhpDom/simple_html_dom.php';
			
			$dom = new simple_html_dom();
			
			$storeId=$storeDataRow['store_id'];
			
			$toBefetchedUrl=$storeDataRow['store_url'];
			
			$toBeFetchedCategory=$storeDataRow['store_url_category_html_container'];
			
			
			require 'C:/nginx/framework/lib/curlFunctions.php';
	
			$rawData = curl($toBefetchedUrl);
		
			$dom->load($rawData);
			
			$iStoreProductCat="INSERT INTO store_product_categorylinks (store_category_link_id,store_product_categories_store_ref,store_category_link) VALUES ";
	
			// Note that for simplicity (and to save time) the statement has not been bind. This however should not be an issue, because the data comes from our own scraper
			// However if you need to purify the data you can do it for each statement
			
			$firstRow=true;
			
			foreach($dom->find(".{$toBeFetchedCategory} a") as $linkHtml){
			
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
	
	// Get the product
	
/* 	foreach($rows as $array){

		$toBefetchedUrl=$array['store_url'];
		
  		$rawData = curl("http://www.ponkes.com");    // Downloading IMDB home page to variable $scraped_page
		
		require 'C:/nginx/framework/lib/simplePhpDom/simple_html_dom.php';
		
		$dom = new simple_html_dom();
		
		$dom->load($rawData);
		
		foreach($dom->find('.ponkes-categories a') as $e){
		
			echo $e."<br/><br/>";
		
		}
		 
	} */
	
	

	
	
}


updateStoresToDatabase();

// $scraped_data = scrape_between($scraped_page, "<title>", "</title>");   // Scraping downloaded dara in $scraped_page for content between <title> and </title> tags
 
// echo $scraped_data; 


?>