<?php
namespace tFramework;

require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'baseFunctions.php';

class site extends BaseFunctions{
	
	private $calledAction;

	function __construct() {
		$this->type='site';
	
	}

	public function site($language=null){

/* 		$this->getLogic($this->type,__FUNCTION__);

		// $this->af->getRecentPosts();
		
		$this->af->getActors();

		require $this->getInternalPath(array('layerPages','views','site','index.php')); */
		
		$this->getLogic($this->type,__FUNCTION__);
		
		require $this->getInternalPath(array('layerPages','views','site','test.php'));
		
		
	}
	
	
  	public function siteLogin($language=null){
		
/* 		$this->getLogic($this->type,__FUNCTION__);
		
		$this->af->login(); */
		
	}
	
	/*
	
	public function ActionRead($language=null){
		
		$this->getLogic($this->type,__FUNCTION__);
		
		$this->loggedIn=$this->af->bGetAuthentication();
		
		echo $this->loggedIn;
		
		require $this->getInternalPath(array('layerPages','views','site','test.php'));
		
	}
	
	
	public function ActionJson($language=null){
	
		// $this->insertInternal('');
	
		echo 'Hello';
		
	}
	
	public function ActionInsert($language=null){
		
		// $this->insertInternal('');
		
	} */
	
/* 	public function ActionOnePageApp(){
		
		$this->getLogic($this->type,__FUNCTION__);
		
		require $this->getInternalPath(array('layerPages','views','site','index.php'));
		
	} */
	
	
	
	
}