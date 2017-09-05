<?php
namespace tFramework;

require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'baseFunctions.php';

class actor extends baseFunctions{
	
	private $calledAction;
	private $type='site';

	public function actor($language=null){

		$this->getLogic($this->type,__FUNCTION__);

		// $this->af->getRecentPosts();
		
		$this->af->getActors();

		require $this->getInternalPath(array('layerPages','views','site','index.php'));
		
		
	}
	
	
	
	
}