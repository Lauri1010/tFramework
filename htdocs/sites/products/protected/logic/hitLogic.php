<?php
namespace tFramework;

require ROOT.DS.FRFOLDER.DS.'layerBusinessLogic'.DS.'backend.php';

class hitLogic extends Backend{
	
	public $hits;
	public $trustLevel;
	
	public function main(){
		$this->trustLevel=1;
	}
	

	/**
	 * This function sets the cookie to minize abuse
	 *
	 */
	public function processHit(){
	
		$trustLevel=1;
		
		if(!isset($_COOKIE['__ttsc']) && isset($_GET['callback']) && isset($_GET['a'])){
	
			$account=$_GET['a'];
			$callback=$_GET['callback'];
			$host=$this->getOrigin();
			$host=str_replace("http://","",$host);
			$host=str_replace("www.","",$host);
			// $remoteHost=$_SERVER['REMOTE_HOST'];
	
			$ip=$this->getClientIpAddress();
				
			$time=time();
			$rn=rand(10,99999);
			$rn2=rand(10,99999);
			$tr=-$rn;
			// $expire=$time+3600; // One hour
			// $rand=rand(10,9999);
			$rand=rand(10,9999);
				
			$id=$ip.$rand.$tr.$host;
	
			$ec=sha1($id);
			
			// save to database
			
/*  			$this->ds->pdo->prepare('INSERT INTO hit 
 					(hit_id, 
 					hit_account_id_ref, 
 					session_identity, 
 					visit_identity, 
 					visitor_identity, 
 					hit_segment_id_ref, 
 					page_id_ref, 
 					request_ip, 
 					browser_type, 
 					browser_version, 
 					is_mobile, is_tablet, 
 					domain, 
 					trust_level) 
					VALUES 
					(NULL,
					:account,
					:sessionIdentity,
 					:visitIdentity,
 					:visitorIdentity,
 					NULL,
 					[value-7],
 					[value-8],
 					[value-9],
 					[value-10],
 					[value-11],
 					[value-12],
 					[value-13],
 					[value-14])'); */
			
	 
			// Will expire when browser is closed
			setcookie("__ttsc",$ec , 0,"/",$host,false,true);
				
			echo "$callback({\"success\":\"true\",\"sessionCookie\":\"$ec\",\"timestamp\"=>$time,\"tk\"=>$rn2});";
	
		}else if(isset($_GET['callback']) && isset($_GET['a'])){
				
			$account=$_GET['a'];
			
			$visitCookie=$_COOKIE['__ttsc'];
				
			// Save hit data
				
			echo "$callback({\"success\":\"true\",\"sessionCookie\":\"$ec\",\"timestamp\"=>$time});";
		}
	
	
	
	
	}
	
	public function getOrigin(){
	
		$origin = '';
	
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			$origin = $_SERVER['HTTP_ORIGIN'];
		}
		elseif (isset($_SERVER['HTTP_REFERER'])) {
			$origin = $_SERVER['HTTP_REFERER'];
			// Data not as trustworthy
			$this->trustLevel++;
		}
	
		return $origin;
	
	}
	
	
	public function getClientIpAddress() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP'])){
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		}else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else if(isset($_SERVER['HTTP_X_FORWARDED'])){
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		}else if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		}else if(isset($_SERVER['HTTP_FORWARDED'])){
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		}else if(isset($_SERVER['REMOTE_ADDR'])){
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		}else{
			$ipaddress = false;
		}
	
		return $ipaddress;
	}
	
	
	public function getHitData(){
		
		// Note: select these in the right order. Do not jump over relations
		$this->ds->q('hit',null);
		$this->ds->q('analytics_account','hit',array('email'));
		$this->ds->q('segment','hit',array('segment_description'));
		$this->ds->q('hit_page','hit',array('page_title'));
		$this->ds->q('event','hit_page',array('event_description'));
		$this->ds->q('event_data','event',array('html_classes'));
		$this->ds->q('event_type','event_data',array('event_type_description'));
		
		/* 		$this->ds->setSqlStatement();
		 echo $this->ds->sqlQuery; exit; */
		
		
		$this->ds->where('analytics_account', 'email', '=' , "laupatrik@gmail.com");
		
		$this->ds->setLimitAndOffset(10);
		
		$this->hits=$this->ds->qd();
		
	}
	

}