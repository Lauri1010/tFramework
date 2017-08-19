<?php
namespace tFramework;

/**
 * Note: you need to edit this for whatever you want to be shown for which pages
 * To compress the CSS for production use a compressor
 */

function getMainPagesCss(){
	
	$basePath=BASE_PATH;
	
	return "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$basePath}pure.css\">";
	
}

function getFormCss(){

	$basePath=BASE_PATH;
	
	return "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$basePath}pure.css\">";

}


?>