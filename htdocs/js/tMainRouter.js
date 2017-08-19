/**
 * 
 */

(function (window, document) {

	var lf=function(){
		
		this.host=window.location.hostname;
		this.pathName=window.location.pathname.toString();
		this.fPathName;
		
	};

	lf.prototype.parsePath=function(path){
		
		var newPath='';
		var pl=path.length;
		var plMinus=pl-1;
		
		if (typeof path === 'string') {
	
			for (var i = 0, len = pl; i < len; i++) {
	
				if(!((i==0 && path[i]=='/') || (i==plMinus && path[i]=='/'))){
					
					if(path[i]=='/'){
						newPath+=',';
					}else{
						newPath+=path[i];
					}
					
			
				}
				  
			}
	
		}
	
		return newPath;

	}
	
	lf.prototype.ajaxCall=function(url,type){
		var self=this;
	    var call = new XMLHttpRequest();
		
	    call.onreadystatechange = function() {
	        if (call.readyState == XMLHttpRequest.DONE ) {
	           if (call.status == 200) {
	        	   self.trackPageview();
	               document.getElementById("mContainer").innerHTML = call.responseText;
	           }
	           else if (call.status == 400) {
	              // alert('There was an error 400');
	           }
	           else {
	               // alert('something else other than 200 was returned');
	           }
	        }
	    };
	
	    call.open(type, url, true);
	    call.send();
		
		
	}
	
	lf.prototype.trackPageview=function (){
		if(window.tRun.i){
            if (typeof window.tRun.i === "function" 
            	&& typeof window.tRun.ttime === "function") {
	        		var st1 = (new Date()).getTime();
	        		window.tRun.sTime=st1;
	        		window.tRun.i(false, true,true, false, null,false);
	            } else {
	                return;  
	            }
		}else {
	            return;
		}
		
	}
	
	lf.prototype.get=function get(name){
		   if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
		      return decodeURIComponent(name[1]);
	}
	
	lf.prototype.fAjaxCall=function(path,ls){
		
		var self=this;
		
		if(ls){

			ls = ls.substr(0, 0) + '&' + ls.substr(0 + 1);
		
		}else{
			
			ls="";
			
		}
		
		if(path=='/'){
			
			console.log('sub path '+path);
			
			self.fPathName="http://"+self.host+"/?p=site"+ls;
			
			self.ajaxCall(self.fPathName,"GET");
			
		}else{
			
			var cpn=self.parsePath(path).replace('/',',');
			self.fPathName="http://"+self.host+"/?p="+cpn+ls;
			
			console.log('sub path'+self.fPathName);
			
			self.ajaxCall(self.fPathName);
			
		}
		
		

	}
	
	lf.prototype.loadPage=function(){
		
		var self=this;
		
		var ls=location.search;

		self.fAjaxCall(self.pathName,ls);

	}
	
			
	// Setting the library on window
	window.lf=lf;
	window.fRun=new lf();
	window.fRun.loadPage();
	
	
})(window,window.document);

//Catch clicks on the root-level element.
window.addEventListener('click', function(event) {
	var tag = event.target;
	// console.log('Tag name '+tag.tagName);

	
	if (tag.tagName == 'A' && tag.href && event.button == 0) {
	 // It's a left click on an <a href=...>.
	 if (tag.origin == document.location.origin) {
	   // It's a same-origin navigation: a link within the site.

	   // Now check that the the app is capable of doing a
	   // within-page update.  (You might also take .query into
	   // account.)
	   var oldPath = document.location.pathname;
	   var newPath = tag.pathname;
	   
	   // if (app.capableOfRendering(newPath)) {
	     // Prevent the browser from doing the navigation.
	    event.preventDefault();
	     // Let the app handle it.
	     
	    window.fRun.pathName=newPath;
	    
	 	console.log(newPath);
	 	
	 	var qParams=tag.href.split('?')[1];

	 	console.log(qParams);
	 	
	 	window.fRun.fAjaxCall(newPath,qParams);
	
		history.pushState(null, '', newPath);


	   // }
	  }
	}
	
});

//Also transition when the user navigates back.
window.onpopstate = function(event) {

	var path=document.location.pathname.toString();

	window.fRun.pathName=path;
	
	window.fRun.fAjaxCall(path);
	
	event.preventDefault();
};

