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
	
	$proxies = array(); // Declaring an array to store the proxy list
	
	// Adding list of proxies to the $proxies array
	$proxies[] = 'user:password@173.234.11.134:54253';  // Some proxies require user, password, IP and port number
	$proxies[] = 'user:password@173.234.120.69:54253';
	$proxies[] = 'user:password@173.234.46.176:54253';
	$proxies[] = '173.234.92.107';  // Some proxies only require IP
	$proxies[] = '173.234.93.94';
	$proxies[] = '173.234.94.90:54253'; // Some proxies require IP and port number
	$proxies[] = '69.147.240.61:54253';
	$proxy = $proxies[array_rand($proxies)];
	
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_PROXY, $proxy);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_COOKIESESSION, TRUE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
	
	$data = curl_exec($ch);  // Execute a cURL request

	print_r(curl_getinfo($ch));
	
	if (!$data) {
		die(curl_error($ch));
	}

	curl_close($ch);    // Closing cURL
	return $data;   // Returning the data from the function
}


$scraped_page = curl("https://www.asko.fi");    // Downloading IMDB home page to variable $scraped_page
$scraped_data = scrape_between($scraped_page, "<title>", "</title>");   // Scraping downloaded dara in $scraped_page for content between <title> and </title> tags
 
echo $scraped_data; 


?>