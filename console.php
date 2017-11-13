<?php
namespace tFramework;
/**
 * @author Lauri Turunen
 * Set proper command in php client
 * Create web application
 * php console.php build <hostname> <dbName> <dbUser> <dbPass>
 * Update database schema
 * php console.php update <hostname> <dbName> <dbUser> <dbPass>
 * 
 * Use for other console functions can be set here aswell. You can comment out the build and update functions in production environments if you wish
 * 
 */
if(isset($argv) && is_array($argv)){
	
	if(isset($argv[1])){
		$command=$argv[1];
	}
	
	if($command=='build' || $command=='update'){
		
		if(isset($argv[2]) 
		&& isset($argv[3])
		&& isset($argv[4])
		&& isset($argv[5])
		&& isset($argv[6])){
			$projectName=$argv[2];
			$dbHost=$argv[3];
			$dbName=$argv[4];
			$dbUser=$argv[5];
			$dbPass=$argv[6];
			require 'project.php';
			if($command=='build'){
				generateHelpersAndModelsAndSqlService(true,true,true,true,'mysql',$dbHost,$dbName,$dbUser,$dbPass);
			}else if($command=='update'){
				generateHelpersAndModelsAndSqlService(false,true,true,false,'mysql',$dbHost,$dbName,$dbUser,$dbPass);
			}
			
		}else{
			die("You need to set proper database connection");
		}

	}
	
	

	
}