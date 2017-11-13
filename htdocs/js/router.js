/**
 * 
 */

(function ($,window, document) {
	
	var lf=function(){
		
		this.host=window.location.hostname;
		this.pathName=window.location.pathname.toString();
		this.fPathName='';
		this.renderPartial=false;
		this.notFp=false;
		this.aCalls=0;
		this.cIndex=0;
		this.hIndex=0;
		this.hSteps=0;
		this.fSteps=0;
		this.pHistory=[];
		this.dHistory=[];
		this.previousUrl='';
		this.previousPath;
		this.previousLs='';
		this.protocol='http://';
		if(window.location.hostname!='localhost'){
			this.protocol='https://';
		}
		this.homepage=this.protocol+this.host+'/?p=site';
		
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
	
	lf.prototype.ajaxCall=function(url,method){

		if(typeof url === 'string' && typeof method === 'string'){
			
			var self=this;
			$.ajax({
			  async:true,
			  method: method,
			  url: url
			}).done(function(html) {
				$("div#mContainer").html(html);
			});
			
			
		}

	}

	
	lf.prototype.get=function get(name){
		   if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
		      return decodeURIComponent(name[1]);
	}
	
	lf.prototype.pageCall=function(path,ls,a,h){

		if(path){
			var self=this;
			var pp;
			if(h==false){
				var dPath=path;
				if(ls){
					// ls = ls.substr(0, 0) + '&' + ls.substr(0 + 1);
					if (ls.indexOf("&") >= 0){
						ls = ls.substr(0, 0) + '&' + ls.substr(0 + 1);
					}else if(ls.indexOf("?") >= 0){
						ls=ls.replace("?","&");
					}else{
						ls='&'+ls;
					}
					dPath+='?'+ls;
					
				}else{
					ls="";
					
				}
				
				if(path=='/'){
					pp=self.protocol+self.host+"/?p=site"+ls;
				}else{
					var cpn=self.parsePath(path).replace('/',',');
					pp=self.protocol+self.host+"/?p="+cpn+ls;
				}
				pp+='&a=1';
				self.pHistory.push(pp);
				self.dHistory.push(dPath);
				self.cIndex++;
			}else if(h==true){
				pp=path;
				var dPath=self.dHistory[self.hIndex];
			}
			
			
			if(a){
				self.ajaxCall(pp,"GET");
				if(pp == self.homepage){
					history.pushState(null, '', '/');
				}else{
					if(dPath){
						history.pushState(null, '', dPath);
					}
				}
				
			}

		}
		
	}

	lf.prototype.previous=function(){
		var self=this;
		self.hSteps++;
		if(self.pHistory.length>0 && (self.hSteps>0 && self.hSteps < self.pHistory.length)){
			self.hIndex=self.pHistory.length-(self.hSteps+1);
			if(self.pHistory[self.hIndex] !== undefined && self.pHistory[self.hIndex] !== null){
				self.pageCall(self.pHistory[self.hIndex],null,true,true);
			}
		}
	}
	
/*	lf.prototype.next=function(){
		var self=this;
		var nIndex=self.cIndex+1;
		if(self.pHistory[nIndex] !== undefined && self.pHistory[nIndex] !== null){
			self.pageCall(self.pHistory[ni],null,true,true);
		}
	}*/
	
	
	lf.prototype.loadPage=function(){
		var self=this;
		var hf=document.location.href;
		var ln=location.pathname;
		var params=hf.split('?')[1];
		self.pageCall(ln,params,false,false);
	}
		
	// Setting the library on window
	window.lf=lf;
	window.fRun=new lf();
	window.fRun.loadPage();
	
	
})(jQuery,window,document);

//Catch clicks on the root-level element.
window.addEventListener('click', function(event) {
	var tag = event.target;
	// //console.log('Tag name '+tag.tagName);

	
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
	    
	 	//console.log(newPath);
	 	
	 	var qParams=tag.href.split('?')[1];
	 	var pPath=newPath;
	 	if(qParams){pPath+='?'+qParams;}
	 	
	 	if(pPath && newPath){
	 		window.fRun.pageCall(newPath,qParams,true,false);
	 	}


	   // }
	  }
	}
	
});

//Also transition when the user navigates back.
window.onpopstate = function(event) {
	window.fRun.previous();
	event.preventDefault();
};

window.onbeforeunload = function() {
    
}