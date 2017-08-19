<?php
namespace tFramework;


class view{
	
	public function render($view,$data=null){
		
		if(is_array($data) && $data!=null){
			
			$viewFile=ROOT.DS.FRFOLDER.DS.'layerPages'.DS.$view.DS.$view.'.php';
			
			if(is_file($viewFile)){
				
				require $viewFile;
				require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'baseview'.DS.'getHtmlElements.php';
					
				generateHead($pageTitle);
				
			}else{

				trigger_error("View does not exist! ", E_USER_ERROR);
			}
			
			
			
		}
		
	}
	

	
}