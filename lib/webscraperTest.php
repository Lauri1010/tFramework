<?php

function scrape_between($data, $start, $end){
	$data = stristr($data, $start); // Stripping all data from before $start
	$data = substr($data, strlen($start));  // Stripping $start
	$stop = stripos($data, $end);   // Getting the position of the $end of the data to scrape
	$data = substr($data, 0, $stop);    // Stripping all data from after and including the $end of the data to scrape
	return $data;   // Returning the scraped data from the function
}


// Defining the basic cURL function
function curl($url) {
	
	// $proxies = array(); // Declaring an array to store the proxy list
	
	// Adding list of proxies to the $proxies array

/* 	$proxies[] = '173.234.92.107:9018';  // Some proxies only require IP
	$proxies[] = '177.294.93.99:9018';
	$proxies[] = '194.334.43.54:9018';
	$proxies[] = '164.134.53.94:9018'; */
	
	// $proxy = $proxies[array_rand($proxies)];
	
	// Assigning cURL options to an array
	$options = Array(
			CURLOPT_RETURNTRANSFER => TRUE,  // Setting cURL's option to return the webpage data
			CURLOPT_FOLLOWLOCATION => TRUE,  // Setting cURL to follow 'location' HTTP headers
			CURLOPT_AUTOREFERER => TRUE, // Automatically set the referer where following 'location' HTTP headers
			CURLOPT_CONNECTTIMEOUT => 120,   // Setting the amount of time (in seconds) before the request times out
			CURLOPT_TIMEOUT => 120,  // Setting the maximum amount of time for cURL to execute queries
			CURLOPT_MAXREDIRS => 10, // Setting the maximum number of redirections to follow
			CURLOPT_USERAGENT => "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1a2pre) Gecko/2008073000 Shredder/3.0a2pre ThunderBrowse/3.2.1.8",  // Setting the useragent
			CURLOPT_URL => $url, // Setting cURL's URL option with the $url variable passed into the function
			CURLOPT_SSL_CIPHER_LIST => 'TLSv1',
/* 			CURLOPT_HTTPPROXYTUNNEL => true,
			CURLOPT_PROXY => $proxy, */
/* 			CURLOPT_FOLLOWLOCATION => 1,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_HEADER => 1, */
/* 			CURLOPT_SSL_VERIFYPEER => FALSE,
			CURLOPT_COOKIESESSION => TRUE,
			CURLOPT_HEADER => FALSE, */
			
	);
	 
	$ch = curl_init();  // Initialising cURL
	curl_setopt_array($ch, $options);   // Setting cURL's options using the previously assigned array data in $options
	$data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
	
	if (!$data) {
		die(curl_error($ch));
	}
	// print_r(curl_getinfo($ch));
	curl_close($ch);    // Closing cURL
	return $data;   // Returning the data from the function
}


$rawData = curl("http://www.ponkes.com");    // Downloading IMDB home page to variable $scraped_page

require 'C:/nginx/framework/lib/simplePhpDom/simple_html_dom.php';

$dom = new simple_html_dom();

$dom->load($rawData);

foreach($dom->find('.ponkes-categories a') as $e){
	
	echo $e."<br/><br/>";
	
}



// $scraped_data = scrape_between($scraped_page, "<title>", "</title>");   // Scraping downloaded dara in $scraped_page for content between <title> and </title> tags
 
// echo $scraped_data; 


?>