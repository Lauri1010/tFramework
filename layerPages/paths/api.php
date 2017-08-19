<?php
namespace tFramework;

/***
 * The start of a path
 * Every capital letter means a new / in the URL path
 */

require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'baseFunctions.php';

class api extends baseFunctions{
	
	private $calledAction;

	function __construct() {
		$this->type='api';

	}
	
	public function Index($language=null){
		
		$this->getLogic($this->type,__FUNCTION__);


	}
	
	
	
	
}