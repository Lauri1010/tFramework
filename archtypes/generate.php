<?php
// select table_name from information_schema.tables;

/**
@author Lauri Turunen

*/
namespace tFramework;
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'database.php';

function generateHelpersAndModelsAndSqlService($generateProject=true,$generateHelpers=false,$generateSchemas=false,$generateSqlService=false,$databaseType='mysql',
$dbHost,$databaseName,$dbUser,$dbPass){
	try {
		if(is_string($dbHost) && is_string($databaseName) && is_string($dbUser) && is_string($dbPass)){
			$siteViewFolder=VIEWSFOLDER.'site'.DS;
			$siteWebContentFolder=ROOT.DS.BWEB.DS.SITES.DS.$databaseName.DS;
			$siteViewFile=$siteViewFolder.'index.php';
			$siteViewNextFile=$siteViewFolder.'nextfile.php';
			$siteViewFileNextFile=$siteViewFolder.'nextpage.php';
			$atNextViewFile=FRPATHATVS.'nextpage.php';
			$siteAcViewFile=FRPATHATVS.'index.php';
			$cfFile=CFFOLDER.'config.php';
			$sLogic=LGFOLDER.'siteLogic.php';
			$sPathFile=PATHSFOLDER.'site.php';
			$hStubFile=SNIPPLETS.'head.php';
			$menuStubFile=SNIPPLETS.'menu.php';
			$footerFile=SNIPPLETS.'footer.php';
			$bodyStart=SNIPPLETS.'bodyStart.php';
			$bottomFile=SNIPPLETS.'bottom.php';
	
			$db = new Database();
			$db->conncectWithData($dbHost,$databaseName,$dbUser,$dbPass);
			
			if($generateProject){
			
				echo 'Generating app folders and files. '.PHP_EOL.PHP_EOL;
		
				/* Generating the root folders, apps and folder with the site name
				 */
				if(!file_exists(APPROOT)){
					if(mkdir(APPROOT, 0777)){
						echo 'App root folder generated. '.PHP_EOL;
					}
				}
				
				if(!file_exists(APPFOLDER)){
					if(mkdir(APPFOLDER, 0777)){
						echo 'App '.SITE.' folder generated. '.PHP_EOL;
					}
				}
			
				/* Generating the folders for the site
				 */
				if (!file_exists(DBFOLDER)) {
					if(mkdir(DBFOLDER, 0777)){
						echo "The database directory was successfully created. ".PHP_EOL;
					}
				}
		
				if(!file_exists(CFFOLDER)){
					if(mkdir(CFFOLDER, 0777)){
						echo 'App configuration folder generated. '.PHP_EOL;
					}
				}
				
				if(!file_exists(LGFOLDER)){
					if(mkdir(LGFOLDER, 0777)){
						echo 'App business logic folder generated. '.PHP_EOL;
					}
				}
		
				if(!file_exists(PATHSFOLDER)){
					if(mkdir(PATHSFOLDER, 0777)){
						echo 'App paths folder generated. '.PHP_EOL;
					}
				}
				
				if(!file_exists(VIEWSFOLDER)){
					if(mkdir(VIEWSFOLDER, 0777)){
						echo 'App views folder generated. '.PHP_EOL;
						
						if(!file_exists(TEMPLATES)){
							if(mkdir(TEMPLATES, 0777)){
								echo 'App templates folder generated. '.PHP_EOL;
							}
						}
						
						if(!file_exists(SNIPPLETS)){
							if(mkdir(SNIPPLETS, 0777)){
								echo 'App snipplets folder generated. '.PHP_EOL;
							}
						}
						
						if(!file_exists(CMS)){
							if(mkdir(CMS, 0777)){
								echo 'App CMS folder generated. '.PHP_EOL;
							}
						}
						
						if(!file_exists($siteViewFolder)){
							if(mkdir($siteViewFolder, 0777)){
								echo 'App site view folder generated. '.PHP_EOL;
							}
						}
					}
				
				}
				
				if(!file_exists($cfFile)){
					if(copy(FRPATHATCF.DS.'config.php', $cfFile)){
						echo 'Config file created, remember to set correct database access settings! '.PHP_EOL;
					}else{
						die("Error in creating config file");
					}
				}
				
				if(!file_exists($sLogic)){
					if(copy(FRPATHATLG.DS.'siteLogic.php', $sLogic)){
						echo 'Site logic file created. '.PHP_EOL;
					}else{
						die("Error in creating site logic file");
					}
				}
				
				if(!file_exists($sPathFile)){
					if(copy(FRPATHATPS.DS.'site.php', $sPathFile)){
						echo 'Site path file created. '.PHP_EOL;
					}else{
						die("Error in creating site path file");
					}
				}
				
				if(!file_exists($siteViewFile)){
					if(copy($siteAcViewFile, $siteViewFile)){
						echo 'Site view index file created. '.PHP_EOL;
					}else{
						die("Error in creating site view file");
					}
				}
				
				if(!file_exists($siteViewNextFile)){
					if(copy($atNextViewFile, $siteViewFileNextFile)){
						echo 'Site view nextpage file created. '.PHP_EOL;
					}else{
						die("Error in creating site view file");
					}
				}
				
				if(!file_exists($hStubFile)){
					if(copy(FRPATHATVS.'head.php', $hStubFile)){
						echo 'Site snipplet head file created. '.PHP_EOL;
					}else{
						die("Error in creating head snipplet file");
					}
				}
				
				if(!file_exists($bodyStart)){
					if(copy(FRPATHATVS.'bodyStart.php', $bodyStart)){
						echo 'Site snipplet bodyStart file created. '.PHP_EOL;
					}else{
						die("Error in creating head snipplet file");
					}
				}
				
				
				if(!file_exists($menuStubFile)){
					if(copy(FRPATHATVS.'menu.php', $menuStubFile)){
						echo 'Site snipplet menu file created. '.PHP_EOL;
					}else{
						die("Error in creating menu snipplet file");
					}
				}
				
				if(!file_exists($footerFile)){
					if(copy(FRPATHATVS.'footer.php', $footerFile)){
						echo 'Site snipplet footer file created. '.PHP_EOL;
					}else{
						die("Error in creating footer snipplet file");
					}
				}
				
				if(!file_exists($bottomFile)){
					if(copy(FRPATHATVS.'bottom.php', $bottomFile)){
						echo 'Site snipplet bottom file created. '.PHP_EOL;
					}else{
						die("Error in creating bottom snipplet file");
					}
				}
				
				if(!file_exists($siteWebContentFolder)){
					if(mkdir($siteWebContentFolder, 0777)){
						mkdir($siteWebContentFolder.'js'.DS, 0777);
						mkdir($siteWebContentFolder.'css'.DS, 0777);
						mkdir($siteWebContentFolder.'fonts'.DS, 0777);
						mkdir($siteWebContentFolder.'img'.DS, 0777);
						echo 'Web content folders created. '.PHP_EOL;
					}
				}
				
				// Copying out of the box web content to correct folders
				recurseCopy(FRPATHATWEB, $siteWebContentFolder);
				
			}
	
			/*
			 * Choices:
			 * u  underscore separator
			 * up upper
			 * na no separator
			 * */
			$ts="u";
			
			/*
			 * Foreign key table reference name
			 *
			 */
			$fkRef='_ref';
			
			$sqlTableNames="select table_name from information_schema.tables where table_schema='$databaseName'";
			
			$db->prepare($sqlTableNames);
			
			$tables=$db->resultset();
			
			$taMap=array();
			
			$ic=0;
			
		
			$foreignKeyRelationsArray=array();
			
			foreach($tables as $table){
				
				$tableName1=$table['table_name'];
		
				$taAlias=generateIncrementalAlias($tableName1, $ts, $ic);
		
				$ic++;
				
				$taMap[$tableName1]=$taAlias;
						
			}
		
			foreach($tables as $table){
				
				$tableName2=$table['table_name'];
				$tableAlias=$taMap[$tableName2];
				
				$foreignKeyRelations="select
		  		TABLE_NAME,COLUMN_NAME,REFERENCED_COLUMN_NAME
				FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
				WHERE
		        REFERENCED_TABLE_NAME = :tableName
				AND table_schema = :databaseName";
				
				$db->prepare($foreignKeyRelations);
				
				$db->bind(':tableName', $tableName2);
				
				$db->bind(':databaseName', $databaseName);
				
				$relations=$db->resultset();
				
				// Generate simple JOIN,
				
				if(!empty($relations)){
				
					foreach($relations as $relation){
				
						$relatedTableName=$relation['TABLE_NAME'];
				
						// The foreign key column, which is referenced.
						$frcn=$relation['COLUMN_NAME'];
				
						// The column name in the current table
						$rcn=$relation['REFERENCED_COLUMN_NAME'];
				
						// Foreign key relation table alis
						$rta=$taMap[$relatedTableName];
				
						$foreignKeyRelationsArray[$tableName2][$relatedTableName]=" $relatedTableName $rta ON($tableAlias.$rcn=$rta.$frcn)";
				
						$foreignKeyRelationsReverseArray[$relatedTableName][$tableName2]=" $tableName2 $tableAlias ON($rta.$frcn=$tableAlias.$rcn)";
				
					}
				
				
				}
				
			}
			
			if($generateHelpers){
				
				$tableNamesForUpdateCommand;
				
				$ftnu=true;
			
				foreach($tables as $tableNameArray){
					
					$tableName=$tableNameArray['table_name'];
			
					if(isset($foreignKeyRelationsArray[$tableName])){
						$foreignKeyRelationsList=$foreignKeyRelationsArray[$tableName];
					}else{
						
						$foreignKeyRelationsList=null;
						
					}
			
					
					if(isset($foreignKeyRelationsReverseArray[$tableName])){
						// Used for reverse sql joins
						$foreignKeyRelationsReverseList=$foreignKeyRelationsReverseArray[$tableName];
						
					}else{
						
						$foreignKeyRelationsReverseList=null;
						
					}
			
					$tableAlias=$taMap[$tableName];
					
					// echo $table['table_name'];
					
					// https://davidwalsh.name/basic-php-file-handling-create-open-read-write-append-close-delete
					
					// unlink('');
			
					$sqlColumns="select group_concat(column_name order by ordinal_position) as columns
					from information_schema.columns
					where table_schema = :database_name and table_name = :table_name";
			
					$db->prepare($sqlColumns);
					
					$db->bind(':database_name', $databaseName);
					
					$db->bind(':table_name', $tableName);
					
					$columnsFDB=$db->resultset();
					
			
					$columns=explode(',', $columnsFDB[0]['columns']);
					
					// Get the foreign key relations
					
					
			/*  	echo $tableName;
					echo "";
					var_dump($foreignKeyRelations);
					echo "";  */
			
					// The columns with aliases
					$columnsWa=array();
					
					// Including aliases to columns names
					// Genenerating INSERT INTO statement
					// Creating update statements
					
					$insertInto="INSERT INTO $tableName VALUES (";
			
					// Used to generate the actual value bindings per column
					$updateRows=array();
					//Contains the value holders for binding
					$bindingNames=array();
			
					
					// Open the file to get existing content
					// Append a new person to the file
					$helpers = "<?php ".PHP_EOL."namespace tFramework; ".PHP_EOL.PHP_EOL; 
					$helpers .= "class helper_$tableName{".PHP_EOL.PHP_EOL;
					$helpers .= "public \$table_name='$tableName';".PHP_EOL.PHP_EOL; 
					$helpers .= "public \$table_alias='$tableAlias';".PHP_EOL.PHP_EOL;
					
					$fr=true;
					
					foreach($columns as $key=>$column){
							
						$columnsWa[$key]=$tableAlias.'.'.$column;
							
						// Add the individual row
						
						$helpers .= 'public $'.$column."_sql='".$tableAlias.'.'.$column."';".PHP_EOL.PHP_EOL;
						
						$bindingNames[$column]=":$column";
							
						$updateRows[$column]="$column=:$column";
							
						if($fr){
								
							$insertInto.=':'.$column;
							$fr=false;
								
						}else{
								
							$insertInto.=', :'.$column;
								
						}
					
					}
					
					
					$insertInto.=")";
					
					// String containing table columns with aliases for this table
					$columnsString=implode(',', $columnsWa);
					
					
					$helpers .= "public \$select_columns_sql='$columnsString';".PHP_EOL.PHP_EOL;
					
			
					
					if(!empty(($foreignKeyRelationsList)) ||  !empty($foreignKeyRelationsReverseList)){
						
							$fkRelationsNotEmpty=false;
						
							// $helpers .= "public \$onJoinRelations=array(".PHP_EOL;
							
							if(!empty(($foreignKeyRelationsList))){
							
								$fr=true;
								
								$fkRelationsNotEmpty=true;
						
								foreach($foreignKeyRelationsList as $joinTable => $joinSql){
										
									if($fr){
										$helpers.="public \${$joinTable}_join_sql='$joinSql';";
										$helpers.=PHP_EOL;
										$fr=false;
									}else{
										$helpers.="public \${$joinTable}_join_sql='$joinSql';";
										$helpers.=PHP_EOL;
									}
								
								}
							
							}
							
							if(!empty($foreignKeyRelationsReverseList)){
	 		
								foreach($foreignKeyRelationsReverseList as $joinTable2 => $joinSql2){
			
									$helpers.="public \${$joinTable2}_join_sql='$joinSql2';";
									$helpers.=PHP_EOL;
									
								}
		
							}
					
						
					}
			
					$helpers.=PHP_EOL;
						
					$updateBase="UPDATE $tableName SET ";
							
					$helpers.="public \$insert_into_sql='$insertInto';".PHP_EOL.PHP_EOL;
					$helpers.="public \$update_base_sql='$updateBase';".PHP_EOL.PHP_EOL;
					
					foreach($updateRows as $column => $bindStatement){
			
						$helpers.="public \$update_{$column}_sql='$bindStatement';".PHP_EOL.PHP_EOL;
			
					}
			
					$helpers.="}?>";
					
					$file = DBFOLDER.'helper_'.$tableName.'.php';
					
					if(file_exists($file)){
						unlink($file);
					}
					// Write the contents back to the file
					
					if(writeFile($file, $helpers)){
						echo 'Helper for '.$tableName.' created. '.PHP_EOL;
					}
	
					
					 
				}
				
	
				if($generateSqlService){
				
					$databaseSqlService="<?php ".PHP_EOL;
					$databaseSqlService.="namespace tFramework;".PHP_EOL.PHP_EOL;
					$databaseSqlService.="require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'Sql_service_base.php';".PHP_EOL.PHP_EOL;
					$databaseSqlService.="class Sql_service_$databaseName extends Sql_service_base{".PHP_EOL.PHP_EOL;;
					/*
					$functions='';
					
					foreach($tables as $tnArray){
						
						$tableName=$tnArray['table_name'];
						
						$databaseSqlService.="protected $$tableName;".PHP_EOL.PHP_EOL;
						
						$functions.="public function get_{$tableName}_model_value(\$value){".PHP_EOL.PHP_EOL;
						
						$functions.="if(!isset(\$this->$tableName)){".PHP_EOL;
								
							$functions.="require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'$databaseName'.DS.'model_$tableName.php';".PHP_EOL;
								
							$functions.="\$this->$tableName=new model_$tableName();".PHP_EOL;
								
						$functions.="}".PHP_EOL.PHP_EOL;
						
						// $functions.="if(\$return_model && \$value==null){".PHP_EOL;
						
						// $functions.="return \$this->$tableName;".PHP_EOL;
						
						// $functions.="}else{".PHP_EOL;
						
						$functions.="return \$this->$tableName->\$value;".PHP_EOL;
						
						// $functions.="}".PHP_EOL.PHP_EOL;
						$functions.="}".PHP_EOL.PHP_EOL;
					}
					
					$setters='';
					
					foreach($tables as $tnArray){
							
						$tableName=$tnArray['table_name'];
	
						$setters.="public function set_{$tableName}(\$column_name,\$column_value){".PHP_EOL.PHP_EOL;
						
						$setters.="if(!isset(\$this->$tableName)){".PHP_EOL;
							
						$setters.="require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'$databaseName'.DS.'model_$tableName.php';".PHP_EOL;
							
						$setters.="\$this->$tableName=new model_$tableName();".PHP_EOL;
							
						$setters.="}".PHP_EOL.PHP_EOL;
						
						$setters.="\$this->$tableName->\$column_name=\$column_value;".PHP_EOL;
							
						$setters.="}".PHP_EOL.PHP_EOL;
					}
				
					if(empty($functions)){
						
						trigger_error("Error in making sql service functions ", E_USER_ERROR);
						
					}
					
					$databaseSqlService.=$functions;
					
					$databaseSqlService.=$setters;
					
					*/
					
					$databaseSqlService.='}'.PHP_EOL.PHP_EOL;
					
					$databaseSqlService.="?>";
					
					$file2 = DBFOLDER.'Sql_service_'.$databaseName.'.php';
					
					if(file_exists($file2)){
						unlink($file2);
					}
					// Write the contents back to the file
					if(writeFile($file2, $databaseSqlService)){
						echo 'SQL service file created for database '.$databaseName.' '.PHP_EOL;
					}
		
				
				}
				
		
		}
		
		if($databaseType=='mysql' && $generateSchemas){
		
			// Now generate the model classes
			
			$tciSql="SELECT TABLE_NAME,COLUMN_NAME,IS_NULLABLE,DATA_TYPE,
			CHARACTER_MAXIMUM_LENGTH,COLUMN_KEY,NUMERIC_PRECISION,
			EXTRA, NUMERIC_SCALE from information_schema.columns
		    where table_schema = '$databaseName'
		    order by table_name,ordinal_position";
			
			/*
			 	select * from information_schema.columns
				where table_schema = 'projectdatabase'
				order by table_name,ordinal_position
				
			 * */
			
			$validationRulesArray=array();
			
			$previusTableName;
			
			$db->prepare($tciSql);
			
			$tableDefinitions=$db->resultset();
			
			$previousTable;
			
			$modelS;
			$cnames='';
			$acsa="public \$columns = array(";
	
			
			foreach($tableDefinitions as $column){
		
				// echo $tableName;
				
				$tableName=$column['TABLE_NAME'];
				
				$columnName=$column['COLUMN_NAME'];
				
				// $columnName=str_replace(' ', '', $columnName);
				
				$isNullable=$column['IS_NULLABLE'];
				
				$dataType=strtolower($column['DATA_TYPE']);
	
				$characterMaxLenght=$column['CHARACTER_MAXIMUM_LENGTH'];
				
				$columnKey=$column['COLUMN_KEY'];
				
				$numericPrecision=$column['NUMERIC_PRECISION'];
				
				$extra=$column['EXTRA'];
				
				$numericScale=$column['NUMERIC_SCALE'];
				
				
				if(empty($previousTable)){
				
					// set the first one
					
					$modelS = "<?php ".PHP_EOL."namespace tFramework; ".PHP_EOL.PHP_EOL;
					$modelS .= "require DBFOLDER.'helper_$tableName.php'; ".PHP_EOL.PHP_EOL;
					$modelS .= "class schema_$tableName extends helper_$tableName{".PHP_EOL.PHP_EOL;
					
					$cnames.="public $".$columnName.";".PHP_EOL.PHP_EOL;
					$acsa.="'$columnName'";
					
					generateColumnValidationAsArray($isNullable,$dataType,$characterMaxLenght,$columnKey,$numericPrecision,$extra,$numericScale,$columnName,$modelS);
	
	
				}else if($previousTable==$tableName){
					
					$cnames.="public $".$columnName.";".PHP_EOL.PHP_EOL;
					$acsa.=",'{$columnName}'";
					// Part of the same table
		
					generateColumnValidationAsArray($isNullable,$dataType,$characterMaxLenght,$columnKey,$numericPrecision,$extra,$numericScale,$columnName,$modelS);
					
					
				}else if($previousTable!=$tableName){
					
					// New table..
					
					// Save previous... move on.
	
					$acsa.=');'.PHP_EOL.PHP_EOL;
					
					$modelS .= "public \$insert_sql_statement;".PHP_EOL.PHP_EOL;
					$modelS .= "public \$update_sql_statement;".PHP_EOL.PHP_EOL;
					$modelS.=$cnames;
					$modelS.=$acsa;
					
					$modelS.="}?>";
					
					$modelFile = DBFOLDER.'schema_'.$previousTable.'.php';
					
	 				if(file_exists($modelFile)){
						unlink($modelFile);
					}
					// Write the contents back to the file
		
					if(writeFile($modelFile, $modelS)){
						echo 'Schema file created for '.$previousTable.' '.PHP_EOL;
					}
		
					
					// Start a new table
					
					$modelS = "<?php ".PHP_EOL."namespace tFramework; ".PHP_EOL;
					$modelS .= "require DBFOLDER.'helper_$tableName.php'; ".PHP_EOL.PHP_EOL;
					$modelS .= "class schema_$tableName extends helper_$tableName {".PHP_EOL.PHP_EOL;
					
					$cnames="public $".$columnName.";".PHP_EOL.PHP_EOL;
					$acsa="public \$columns = array('$columnName'";
					
					generateColumnValidationAsArray($isNullable,$dataType,$characterMaxLenght,$columnKey,$numericPrecision,$extra,$numericScale,$columnName,$modelS);
	
				}
				
				$previousTable=$tableName;
				
			}
			
			// var_dump($validations[0][0]); exit;
			
			// save the last one
			$acsa.=');'.PHP_EOL.PHP_EOL;
			$modelS.=$acsa;
			$modelS.=$cnames;
			$modelS.= "public \$insert_sql_statement;".PHP_EOL.PHP_EOL;
			$modelS.= "public \$update_sql_statement;".PHP_EOL.PHP_EOL;
			$modelS.="}?>".PHP_EOL.PHP_EOL;
			
			$modelFile = DBFOLDER.'schema_'.$tableName.'.php';
			
	 		if(file_exists($modelFile)){
				unlink($modelFile);
			}
	
			if(writeFile($modelFile, $modelS)){
				echo 'Schema file created for '.$tableName.' '.PHP_EOL;
			}
		
		}
		
	
		
		
	
	
		// Now generating the view helpers
		
	 	/* foreach($validationRulesArray as $tableName5=>$tableArray1){
		
	  		if(isset($foreignKeyRelationsArray[$tableName5])){
	 			$foreignKeyRelationsList2=$foreignKeyRelationsArray[$tableName5];
	 		}else{
	 				
	 			$foreignKeyRelationsList2=null;
	 				
	 		}
	 		
	 		
	 		if(isset($foreignKeyRelationsReverseArray[$tableName5])){
	 			// Used for reverse sql joins
	 			$foreignKeyRelationsReverseList2=$foreignKeyRelationsReverseArray[$tableName5];
	 				
	 		}else{
	 				
	 			$foreignKeyRelationsReverseList2=null;
	 				
	 		}
	 		
	 		
	 		$viewHelperContent="<?php ".PHP_EOL."namespace tFramework; ".PHP_EOL.PHP_EOL;
	 		$viewHelperContent="class viewhelper_$tableName5{";
	 		
	 		
			foreach($tableArray1 as $column){
				
				
				
				if(!empty($foreignKeyRelationsList2)){
					
					foreach($foreignKeyRelationsList2 as $tColumn){
						
						// The data needs to be fetched using sql
						
						$getRelationsSql="SELECT ";
						
						// $db->
						
						if($tColumn==$column){
							
							$viewHelperContent="<select></select>";
							
						}
						
					}
					
				}
				
				if(!empty($foreignKeyRelationsReverseList2)){
					
					foreach($foreignKeyRelationsReverseList2 as $t2Column){
							
						// The data needs to be fetched using sql
							
						if($t2Column==$column){
					
					
					
						}
							
					}
					
				}
				
				
				
			} 
			
			$viewHelperContent="}?>"; 
	
		} */
		
		}else{
			die("Database connection data has to be in the corect format");
		}
	
	} catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), " ".PHP_EOL;
	}
	

}

function writeFile( $filename, $data) {
	
	try{

		$fh = fopen($filename, "w");
		fwrite($fh, $data);
		fclose($fh);
		return true;
	
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), " ";
	}
}


/*
 * A simple function for column validation 
 * 
 * @param unknown $isNullable
 * @param unknown $dataType
 * @param unknown $characterMaxLenght
 * @param unknown $columnKey
 * @param unknown $numericPrecision
 * @param unknown $extra
 * @param unknown $numericScale
 * 
 * */

function generateColumnValidation($isNullable,$dataType,$characterMaxLenght,$columnKey,$numericPrecision,$extra,$numericScale){
	
	$validationRules="'";
	
	// Determining the validation rules
	
	if($isNullable=='NO' && $columnKey!='PRI'){
			
		
		
		
			
	}else if($columnKey=='PRI'){
			
		if($extra=='auto_increment'){
			// Auto increment columns are not required by default
			// $validationRules.=":required";
		}else{
	
			$validationRules.=":required";
	
		}
			
	
	}
	
	if($characterMaxLenght!=null){
			
		$validationRules.=":characterMaxLenght-$characterMaxLenght";
			
	}else if($numericPrecision!=null){
	
		if($numericScale>0){
	
			$validationRules.=":decimal:numericPrecision-$numericPrecision:numericScale-$numericScale";
	
		}else{
	
			$validationRules.=":intiger:numericPrecision-".$numericPrecision;
	
		}
			
			
	}else if($dataType=='date'){
			
		$validationRules.=":date";
			
	}
	
	$validationRules.="';";
	
	return $validationRules;
	
}

function generateColumnValidationAsArray($isNullable,$dataType,$characterMaxLenght,$columnKey,$numericPrecision,$extra,$numericScale,$columnName,&$modelStr){

	// Determining the validation rules
	// $validations=array(array('required'),array('character'),array('double'),array('intiger'),array('date'));
	
	// $modelStr.="public $".$columnName.";".PHP_EOL.PHP_EOL;
	$modelStr.='public $'.$columnName.'_validation = ';
	
	$modelStr.="array(";
	
	// determine if there is some previous settings
	$pExists=false;
	
	
	if($columnKey=='PRI'){
			
		if($extra=='auto_increment'){
			// Auto increment columns are not required by default
			// $validationRules.=":required";
			
			if($pExists){
			
				$modelStr.=",'primary'";
			
			}else{
			
				$modelStr.="'primary'";
				$pExists=true;
			
			}
			
		}else{

			if($pExists){

				$modelStr.=",'required'";

			}else{
				
				$modelStr.="'required'";
				$pExists=true;
				
			}

		}
			

	}else if($isNullable=='NO'){
			
		$modelStr.="'required'";
		$pExists=true;
					
	}
	
	if($characterMaxLenght!=null){
			
		$characterMaxLenght=(int)$characterMaxLenght;
		
		$characterMinLenght=1;
		
		if($pExists){

			$modelStr.=",'string','max'=>{$characterMaxLenght},'min'=>{$characterMinLenght}";
			
		}else{
			
			$modelStr.="'string','max'=>{$characterMaxLenght},'min'=>{$characterMinLenght}";
			$pExists=true;
		}

		
	}else if($numericPrecision!=null){

		if($numericScale>0){ // decimal type (max lenght, decimals)

			$decimalMax=(int)$numericPrecision;
			
			$decimalMin=1;
			
			$decimals=(int)$numericScale;
			
			if($pExists){

				$modelStr.=",'decimal','max'=>{$decimalMax},'min'=>{$decimalMin},'decmials'=>{$decimals}";
					
			}else{
					
				$modelStr.="'decimal','max'=>{$decimalMax},'min'=>{$decimalMin},'decmials'=>{$decimals}";
				$pExists=true;
			}
			
				 		
		}else{ // intiger type

			$intigerMax=(int)$numericPrecision;
				
			$intigerMin=1;
			
			if($pExists){
					

				$modelStr.=",'intiger','max'=>{$intigerMax},'min'=>{$intigerMin}";
					
			}else{
					
				$modelStr.="'intiger','max'=>{$intigerMax},'min'=>{$intigerMin}";
				$pExists=true;
			}

		}
			
			
	}else if($dataType=='date'){
			
		if($pExists){

			$modelStr.=",'date'";
				
		}else{
				
			$modelStr.="'date'";
			
		}
			
	}else if($dataType=='datetime'){
			
		if($pExists){

			$modelStr.=",'datetime'";
				
		}else{
				
			$modelStr.="'datetime'";
			
		}
			
	}else if($dataType=='year'){
			
		if($pExists){

			$modelStr.=",'year'";
				
		}else{
				
			$modelStr.="'year'";
			
		}
			
	}else if($dataType=='enum'){
			
		if($pExists){

			$modelStr.=",'enum'";
				
		}else{
				
			$modelStr.="'enum'";
			
		}
			
	}else if($dataType=='set'){
			
		if($pExists){

			$modelStr.=",'set'";
				
		}else{
				
			$modelStr.="'set'";
			
		}
			
	}else if($dataType=='timestamp'){
			
		if($pExists){

			$modelStr.=",'timestamp'";
				
		}else{
				
			$modelStr.="'timestamp'";
			
		}
			
	}else if($dataType=='blob'){
			
		if($pExists){

			$modelStr.=",'blob'";
				
		}else{
				
			$modelStr.="'blob'";
			
		}
			
	}
	
	$modelStr.=");";
	$modelStr.=PHP_EOL.PHP_EOL;

}

function generateValidationArrayPiece(&$vArray,$type,$category,$conditions=null,&$vString,&$fristRow){

	// Category: required, intiger etc..

	if($type==0){ // required

		foreach($vArray as $rItem){

			if($fristRow){
					
				// $rItem is the column
				$vString.="array('required'";
					
			}else{

				$vString.=",'required'";
					
			}

		}

	}else if($type==1){  // Multiple conditions


		
		
		if(!empty($conditions)){


			$moreThanOneColumn=false;
	
			// rItem is the array that contains the values in an array

			foreach($vArray[1] as $column=>$rules){
				
				if($moreThanOneColumn){

					// We need to add a dot because there are more columns with these types of conditions
					$vString.=",'$column'=>array(";

				}else{

					$vString.="'$column'=>array(";
				}

				$cfr=true;
				
				foreach($rules as $conditionKey=>$conditionValue){

					if($cfr){

						// For instance 0 , 1
						$vString.="'$conditions[$conditionKey]'=>$conditionValue";

						$cfr=false;

					}else{

						$vString.=",'$conditions[$conditionKey]'=>$conditionValue";

					}


					$moreThanOneColumn=true;

						
				}
					
			}
				
			$vString.=")";
				


			/* 					$a=array('product_name'=>array('maximumLenght'=>5,'minimumLenght'=>1),
			 'product_type'=>array('maximumLenght'=>5,'minimumLenght'=>1)
			); */

			/***
			 *
			 * array('product_name'=>array('maximumLenght'=>5,'minimumLenght'=>1));
			 *
			 * @var unknown
			 */

		}else{
				
			die('Conditions have to be set to character, intiger and decimal conditions');
				
		}


	}
		
	return $vString;


}


function generateIncrementalAlias($tableName,$ts,$aliasEnd){

	$tableAlias='';

	if($ts=="u"){

		$aArray=explode("_", $tableName);

		foreach($aArray as $a){

			$ae=substr($a, 0, 1);

			$tableAlias.=$ae;

		}


	}

	return $tableAlias.=$aliasEnd;

}

function recurseCopy($src,$dst) {
	$dir = opendir($src);
	@mkdir($dst);
	while(false !== ( $file = readdir($dir)) ) {
		if (( $file != '.' ) && ( $file != '..' )) {
			if ( is_dir($src . DS . $file) ) {
				recurseCopy($src . DS . $file,$dst . DS . $file);
			}
			else {
				copy($src . DS . $file,$dst . DS . $file);
			}
		}
	}
	closedir($dir);
}

function generateAlias($columns,$ts){

	// Used for dynamic alias creation.. more can be created, but i guess 26 is enough for now :)
	$numbers=array(1=>'a',2=>'b',3=>'c',4=>'d',5=>'e',6=>'f',7=>'g',8=>'h',9=>'i',10=>'j',11=>'k',12=>'l',13=>'m',14=>'n',15=>'o',16=>'p',17=>'q',18=>'r',19=>'s',20=>'t',21=>'u',22=>'v',23=>'w',24=>'x',25=>'y',26=>'z');
	
	$currentTableAlias='';
	
	if($ts=="u"){

		$aArray=explode("_", $tableName);

		foreach($aArray as $a){
				
			$ae=substr($a, 0, 1);
				
			$currentTableAlias.=$ae;
				
		}
		

	}
	
	$randKeys=array_rand($numbers, 2);
	
	$currentTableAlias.=$numbers[$randKeys[0]].$numbers[$randKeys[1]];
	
	return $currentTableAlias;

}

function startsWith($haystack, $needle) {
	// search backwards starting from haystack length characters from the end
	return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}
function endsWith($haystack, $needle) {
	// search forward starting from end minus needle length characters
	return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}





