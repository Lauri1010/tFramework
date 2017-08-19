<?php
namespace tFramework;

require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'baseFunctions.php';

class hit extends BaseFunctions{
	
	private $calledAction;

	function __construct() {
		$this->type='hit';
	
	}

	public function hit($language=null){

		$this->getLogic($this->type,__FUNCTION__);
		
		$this->af->processHit();
		
		
	}
	
	
	public function getHits($language=null){
		

		$this->getLogic($this->type,__FUNCTION__);
		
		require $this->getInternalPath(array('layerPages','views','hit','index.php'));
		

		
	}

	
	
	
}