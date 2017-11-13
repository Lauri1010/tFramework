<?php
namespace tFramework;

/**
 * You can set your config variables here
 *
 */
class config {
	
	static private $conf = array(
			'snipplets'=>SNIPPLETS,
			'js'=>'http://localhost/products/js'
	);
	
	static function init(){
		
		if(DEVELOPMENT_ENVIRONMENT){
			self::$conf['dbHost']='localhost';
			self::$conf['dbUser']='application';
			self::$conf['dbPass']='JnDdZm0IqJkpM2K1';
			self::$conf['dbName']='products_database';
		}else{
			self::$conf['dbHost']='localhost';
			self::$conf['dbUser']='diimofi_main';
			self::$conf['dbPass']='aS=.&la%MU&C';
			self::$conf['dbName']='diimofi_products_database';
		}
		
	}

	static function getConf($index) {
		return self::$conf[$index];
	}
	

}
?>