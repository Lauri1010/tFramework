<?php
namespace tFramework;
use PDO;

class database
{
	private $dbh;
	private $error;

	private $stmt;

	public function __construct()
	{
	}
	
	public function conncect(){
		
		// Set DSN
		$dsn = 'mysql:host='.config::getConf('dbHost').';dbname='.config::getConf('dbName');
		// Set options
		$options = array(
				PDO::ATTR_PERSISTENT    => true,
				// PDO::ATTR_PERSISTENT    => false,
				PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
		
		);
		//Create a new PDO instance
		try {
			$this->dbh = new PDO($dsn, config::getConf('dbUser'), config::getConf('dbPass'), $options);
		}
		// Catch any errors
		catch(PDOException $e) {
			echo $e->getMessage();
		}
		
	}
	
	public function conncectWithData($dbHost,$dbName,$dbUser,$dbPass){

		// Set DSN
		$dsn = 'mysql:host='.$dbHost.';dbname='.$dbName;
		// Set options
		$options = array(
				PDO::ATTR_PERSISTENT    => true,
				// PDO::ATTR_PERSISTENT    => false,
				PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
	
		);
		//Create a new PDO instance
		try {
			$this->dbh = new PDO($dsn, $dbUser, $dbPass, $options);
		}
		// Catch any errors
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	
	}
	
	public function getPdo(){
		
		return $this->dbh;
		
	}

	public function prepare($statement)
	{
		$this->stmt = $this->dbh->prepare($statement);
		
	}
	

	public function bind($param, $value, $type = null)
	{
		if (is_null($type)) {
			switch (true) {
/* 				case is_float($value):
					$type = PDO::PARAM_STR;
					break; */
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);

	}

	public function execute()
	{
		try{

			return $this->stmt->execute();
		
		}catch(PDOException $e){
			
			echo $e->getMessage();
			print_r($e->getTrace());
			
		}

	}

	public function resultset()
	{		
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function single()
	{
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function rowCount()
	{
		return $this->stmt->rowCount();
	}

	public function lastInsertId()
	{
		return $this->dbh->lastInsertId();
	}

	/**
	 * Transactions allow multiple changes to a database all in one batch.
	 */
	public function beginTransaction()
	{
		return $this->dbh->beginTransaction();
	}
	 
	public function endTransaction()
	{
		return $this->dbh->commit();
	}

	public function cancelTransaction()
	{
		return $this->dbh->rollBack();
	}

	public function debugDumpParams()
	{
		return $this->stmt->debugDumpParams();
	}
	
	public function getErrorInfo(){
		
		return $this->stmt->errorInfo();
		
	}
}