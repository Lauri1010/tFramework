<?php
namespace tFramework;

require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'baseFunctions.php';

class tt extends BaseFunctions{
	
	private $calledAction;

	function __construct() {
		$this->type='tt';
	
	}

	public function tt($language=null){
	
		$this->getLogic($this->type);
		
		

	}
	
	
}