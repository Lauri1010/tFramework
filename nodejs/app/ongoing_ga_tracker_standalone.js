(function(window,document,$){

		if($){
	
			/***
			Tracker
			*/	
				
			var tr=function(){
	
				this.cm=false;
				this.pageName;
				this.pathNameV=window.location.pathname;
				this.pathNameE=encodeURIComponent(window.location.pathname);
				this.pageTitle=encodeURIComponent(document.title);
				this.ePath = this.pathNameV.split("/").pop();
				this.ePathE = encodeURIComponent(this.ePath);
				this.referrer = document.referrer;
				this.referrerE=encodeURIComponent(this.referrer);
				this.domain = window.location.hostname;
				this.pDomain= this.domain.replace('www.','.');
				this.rDomain = this.domain.replace('www.','');
				this.lHref=window.location.href;
				this.dc=true;
				this.fVtracked=false;
				this.visitId;
				this.sTime;
				this.lTime;
				this.tTime=false;
				this.hn=window.location.hostname;
				this.chn=this.hn.replace('www','');
				this.ttid;
				this.aMaxLenghtC=41;
				this.lMaxLenghtC=41;
				this.pnMaxLenght=110;
				this.AoptOut=false;
				this.ToptOut=false;
				this.protocol=(location.protocol == "https:" ? "https://" : "http://");
				
				this.pageNameF=function() {
					
					var pathName=window.location.pathname;
					if(pathName){
						if(pathName!=="/"){
							if(pathName.charAt(0)==='/'){
								var end=pathName.length;
								pathName=pathName.substring(1, end);
							}
							// return pathName.replace('/(?!^)\//g', ':').toLowerCase();
						}
						return pathName.replace('/',':').toLowerCase();
					}
				};
				

			};
			
			// true, 1,1,true
			tr.prototype.i=function(cm,fd,pageName,action){
					var self=this;
					if(self.ttid && typeof self.ttid === 'string'){
						self.cm=cm;	
						self.bust=bust;
						
						var aOptOut=self.rc('aOptOut');
						var tOptOut=self.rc('tOptOut');
	
						if(aOptOut && typeof aOptOut === 'string'){
							if(aOptOut=='true'){
								self.aOptOut=true;
							}
						}
						
						if(tOptOut && typeof tOptOut === 'string'){
							if(tOptOut=='true'){
								self.aOptOut=true;
							}
						}
	
						if(!self.aOptOut){
			
							if(!pageName && typeof pageName !== 'string'){
								pageName=self.pageNameF();
							}
					
							if(fd){
								self.t('hit',self.ttid,pageName,action,bust);
							}
						
						}
					}else{
						if(cm==true){console.log("Malformed parameter settings. ");}
					}
			}
		
			tr.prototype.t=function(c,ttid,pageName,action,bust){
				var self=this;
				try{
					if(ttid && typeof ttid === 'string' 
						&& typeof pageName === 'string' && pageName
						&& !self.aOptOut){
							if(pageName.length<self.pnMaxLenght){
								if(c=='hit'){
									
									if(!pageName && typeof pageName !== 'string'){
										pageName=self.pageNameF();
									}
									
									var st='c';
									var md=1;
									
									var p={
										t:ttid
									};
									
									if(action){
										if(action['category'] && typeof action['category'] === 'string' 
											&&  action['action'] && typeof action['action'] === 'string'
											){
												p.a=action['category'];
												p.a1=action['action'];
												
												if(action['path'] && typeof action['path'] === 'string'){
													p.a2=action['path'];
												}
												
												if(action['label'] && typeof action['label'] === 'string'){
													p.a3=action['label'];
												}
												st='c2';
												md=2;
											}								
										}
								    }
									
									p.s=st;
											
									if(typeof self.referrerE === 'string' && self.referrerE){
										p.r=self.referrerE;
									}
									
									/*
									if(typeof self.pageTitle === 'string' && self.pageTitle){
										p.p=self.pageTitle;
									} */
									if(typeof pageName === 'string' && pageName){
										p.p1=pageName;
									}

									
									
							}
					}else if(self.cm){
						console.log("ttid needs to be set");
					}
				
				}catch(e){
					if(self.cm){console.log(e);};
				}
				
			}
			
			tr.prototype.cTrack=function(pageName){
					var self=this;
					
					$(function() {
			                $(document).on("click touchstart", "a", function(e) {
			                	
									if(!pageName && typeof pageName !== 'string'){
										pageName=self.pageNameF();
									}
									
									var href=$(this).attr('href');
				
									if(href && typeof href === 'string'){
									
										var pathName=encodeURIComponent(href.replace("http://","").replace("https://","").replace(self.hn,""));
										
										if(self.cm){ 
											console.log('href '+href);
											console.log('pathname '+pathName);
										}
										
										label=$(this).text();
										
										if(label.length<self.lMaxLenghtC){
											if(href.indexOf(self.rDomain) !== -1){
												self.t('hit',ttid,pageName,{'category':'Click','action':'Internal','path':pathName,'label': label},bust);
											}else{
												self.t('hit',ttid,pageName,{'category':'Click','action':'External','path':pathName,'label': label},bust);
											}
										}
									}
			            });
		
				});
			
			}
				
			// Initialize targeting (separate library)
	/*		tr.prototype.it=function() {
			    
				if (typeof window.taRun.i === "function") {
	                
	            } else {
	                return;
	            }
				
			}*/
			
			// days*24*60*60*1000
			tr.prototype.cc=function(name,value,seconds,domain,isSession) {
			    if (seconds) {
			        var date = new Date();
			        date.setTime(date.getTime()+(seconds*1000));
			        var expires = "; expires="+date.toGMTString();
			    }
			    if(domain){document.cookie = name+"="+value+expires+";domain="+domain+";path=/";}
				else{document.cookie = name+"="+value+expires+";path=/";};
			}
			
			tr.prototype.rc=function(name) {
			    var nameEQ = name + "=";
			    var ca = document.cookie.split(';');
			    for(var i=0;i < ca.length;i++) {
			        var c = ca[i];
			        while (c.charAt(0)==' ') c = c.substring(1,c.length);
			        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
			    }
			    return false;
			}
			
			tr.prototype.gcv=function(field){
			    var re = new RegExp(field + "=([^;]+)");
			    var value = re.exec(document.cookie);
			    return (value != null) ? unescape(value[1]) : null;
			}
			
			tr.prototype.ec=function(name) {
			    createCookie(name,"",-1);
			}
		
			window.tr=tr;
			window.tRun=new tr();
		
		}

})(window,document,$);
