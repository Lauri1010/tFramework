<?php
namespace tFramework;
require FRPATH.'layerPages'.DS.'baseFunctions.php';

class site extends BaseFunctions{
	
	private $calledAction;

	function __construct() {
		$this->type='site';
	
	}

	public function site($language=null){
		// $this->getLogic($this->type,__FUNCTION__);
		require $this->getView($this->type,'index');

	}
	
	public function data($language=null){
		// $this->getLogic($this->type,__FUNCTION__);
		require $this->getView($this->type,'nextpage');
	
	}
	
}