<?php
namespace tFramework;
/***
 * Do not remove or change this class
 * This class provided basic functionality for calls from the frontend
 */

require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'baseFunctions.php';

class wApi extends baseFunctions{
	
	/**
	 * This is only used for the Widgets
	 * 
	 */
	public function processWidgetCall(){

		$rm=$_SERVER['REQUEST_METHOD'];
		
		if($rm=='GET'){
			

			if(isset($_GET['table']) 
			   && isset($_GET['columns']) 
			   && isset($_GET['items'])
			   && isset($_GET['page'])){
				
				$table=$_GET['table'];
				$columnsS=$_GET['columns'];
				$columns=explode(',', $columnsS);
				$page=$_GET['page'];
				$items=$_GET['items'];
				$q=null;
				$qc=null; // query columns
				$class=null;
				$headings=null;
				
				if(isset($_GET['q']) && isset($_GET['qc'])){
					$q=$_GET['q'];
					$qc=explode(',', $_GET['qc']);
				}
				
				// Class
				if(isset($_GET['cs'])){
					$class=$_GET['cs'];
				}
				
				// Headings
				if(isset($_GET['hs']) && !empty($_GET['hs'])){

					$headings=explode(',', $_GET['hs']);
		
				}
				
/* 				foreach($columns as $column){
					
					
				}
 */
				
				$mt=false;
				
				// Check if there are multiple columns
				// Will proceed in the order: 0: first table, 1 the second one, 2 the third etc..
				
				$tableNames=explode(',', $table);
				
				$tablesSize=sizeof($tableNames);
				
				$columnsSize=sizeof($columns);
				
				if($columnsSize<2){
					
					die('There has to be atleast two columns selected!');
					
				}

				$tableMappings=array();
				
				if(is_array($tableNames)){
					// Multiple tables selected
					$mt=true;
	
					$tSize=sizeof($tableNames);

					foreach($columns as $column){
							

								$scColumn=explode(':', $column);
								
								$tableName=$scColumn[0];
								
								$scName=$scColumn[1];
								
								// echo "Column added $scName For table $currentTable <br/>";
								
								array_push($tableMappings, array($tableName,$scName));

					}
					
				}

				// Generate aliases
				$aliases=array();
				$c=0;
				$aa=array('a','b','c','d','e','f','g');
				$aliasList=array();
				
				while($c<$tablesSize){
					$aliasList[]=$c.$aa[$c];
					$c++;
				}
				
				if($page==1){
					$offset=1;
				}else{
					$offset=$page*$items;
				}
			
				$queriedSql="SELECT ";
				$sqlJoin=" FROM ";
				
				if($mt){
					
					$fromSet=false;
					
					$fRow=true;
					
					$previousTable=null;
					
					// we go though based on each depth, NOTE: first table has to be correcly set
					foreach($tableNames as $depth => $tName){

						$rHelper=ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.DB_NAME.DS.'helper_'.$tName.'.php';
							
						$helperClass;
							
						if(is_file($rHelper)){
							
							require $rHelper;
								
							$helperClass='tFramework\\'.'helper_'.$tName;
								
							$helper=new $helperClass();
							
							$tAlias=$helper->table_alias;
							
							$jrCreated=false;
						
							foreach($tableMappings as $tArray){
									
								$tNameRow=$tArray[0];
			
								$cNameRow=$tArray[1];
									
								if($tName==$tNameRow){
									
									if($fRow){
										$queriedSql.=$tAlias.'.'.$cNameRow;
										$fRow=false;
									}else{
										$queriedSql.=','.$tAlias.'.'.$cNameRow;
									}
									
								}else{
				
									// die('Here '.$tName);
									// Generate the join relations
									
									if(!$jrCreated && $previousTable!=$tNameRow){
										
										// echo $tNameRow.'<br/>'; 
										
										$toJoinRelation=$tNameRow.'_join';
										
										if(isset($helper->$toJoinRelation)){
								
											// This is the first time join is set. 
											if(!$fromSet){
				
												$joinSql=$helper->$toJoinRelation;
												
												$sqlJoin.=$tName." ".$tAlias." JOIN ".$joinSql." ";
												
												$fromSet=true;
												
												$previousTable=$tName;
			
												// The join relation has been craeted
												$jrCreated=true;
												
											}else{
												
												$joinSql=$helper->$toJoinRelation;
												
												$sqlJoin.=" JOIN ".$joinSql." ";
												
												$previousTable=$tName;
												
												// The join relation has been craeted
												$jrCreated=true;
							
											}
					
			
										}else{
											
										}
										
									}
								}
								
							}
							
							if(!empty($qc) && !empty($q)){
								
								$sqlBindList=array();
								$sqlCondition='WHERE';
								
								$conditions=explode(',', q);
								
								foreach($qc as $index=>$queryRow){
									
									$qca=explode(':', $queryRow);
									
									$condition=$conditions[$index];
	
									$binded=":".strip_tags($qca[1]);
										
									$sqlCondition.=" :".$binded."= ".$condition."";
										
									$sqlBindList[]=array($condition,$binded);

								}
								
								
								$sql=$queriedSql.$sqlJoin.$sqlCondition;
								
							}else{
								
								$sql=$queriedSql.$sqlJoin;
								
							}


							
							
								
						}else{
						
							trigger_error('Helper class failed to load! ', E_USER_ERROR);
						
						
						}
						
					}
							
				}else{
					
					// Easy version: all columns are from the same table
					
					
					
				}

				$this->ds->pdo->prepare($sql);
				
				if(!empty($sqlBindList)){
					
					foreach($sqlBindList as $ba){
						$cn=$ba[0];
						$bv=$ba[1];
						
						$this->ds->pdo->bind($cn, $bv);
						
					}
					
				}
	
				$data=$this->ds->pdo->resultset();
				
				
				$sizeOfColumns=sizeof($columns);
				

				// echo the data table
				
				$table="<table class=\"pure-table\" data-model=".$columnsS." data-page=".$page." data-items=".$items.">
				        ";
				
				if(!empty($headings)){
					$table.='<thead>';
					foreach($headings as $heading){
						$table.='<th>'.$heading.'</th>';
					}
					$table.='</thead>';
				}
				
				$table.'<tbody>';
				
				$firstRow=true;
				
				$pId=null;
				
				$dCounter=0;
				
				foreach($data as $dataArray){
					
					$columnRow=explode(':', $columns[0]);

					$id=$dataArray[$columnRow[1]];
	
					foreach($dataArray as $key => $value){
						
						if($pId!=$id){
							// Beginning
							if($firstRow){
								$firstRow=false;
								$table.="<tr>";
							}else{
								$table.="</tr><tr>";
							}
						}
							
						
						$table.="<td data-column=\"{$columns[$dCounter]}\">{$value}</td>";
							
						$pId=$id;
						
						$dCounter++;
						
					}
					
					$dCounter=0;

				}
				
				$table.="</tr></tbody></table>";
				
				echo $table;
			}
	
		}else{
			
			die('api: Error or unsupported request method.');
			
		}
		
	}
	
	// Used to process a get command
	public function getProcess(){
		
		
		
	}
	
	// Used to process a post: update, create or delete
	public function postProcess(){
		
		
	}
	
	
}