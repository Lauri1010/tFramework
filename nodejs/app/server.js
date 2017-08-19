var express = require('express')
var cookieParser = require('cookie-parser')
var app = express()
app.use(cookieParser())
fs = require("fs")
var mysql      = require('mysql');

var pool = mysql.createPool({
	  host     : '127.0.0.1',
	  port	   : '3307',
	  user     : 'root',
	  password : 'password',
	  database : 'tt_analytics',
	  debug    :  false
});

var executeSql = function(sql,data,callback) {
	// console.log(sql+' '+data);
	if(sql && data){
		// console.log(sql+' '+data);
	    pool.getConnection(function(err, connection) {
		    if(connection){
			    connection.query(sql, data, function (error, results, fields) {
			    	
			    	  // console.log(sql);
			    	
				      if (error) {
				        return connection.rollback(function() {
				        
				          throw error;
				        });
				      }
				      if(callback){
					    	callback(results);
					  }

				      connection.release();
				});
			    
			    
		    }else{
		    	if(err){
			    	console.log(err);
		    	}else{
			    	console.log('No connection');
		    	}
		    }
	    });
	 };
};

app.get('/', function (req, res) {

   if(req.connection.encrypted){
	   
   }
   
   var s=req.query.s;
   var ttid=0;
   if(req.query.t){
		ttid=req.query.t;
   }
	
   console.log('tid: '+ttid);
	
   if (req.url === '/favicon.ico') {
	    res.writeHead(200, {'Content-Type': 'image/x-icon'} );
	    res.end();
	    console.log('favicon requested');
	    return;
  }

   if(req.method=='GET') {
      
		if(s=='td'){

			  fs.readFile(__dirname+'/tracker_standalone.js', function(err, data) {
				  res.statusCode = 200;
				  res.setHeader('Content-Type', 'application/javascript');
				  res.write(data);
				  res.end();
			  });

		}else if(s=='ta'){

			  fs.readFile(__dirname+'/targeting_standalone.js', function(err, data) {
				  res.statusCode = 200;
				  res.setHeader('Content-Type', 'application/javascript');
				  res.write(data);
				  res.end();
			  });

		}else if(s=='c'){
			  pCall();
			  console.log('c requested');
			  res.statusCode = 204;
			  res.setHeader('Content-Type', 'image/jpg');
			  // res.json({p0: 0 })
			  // res.setHeader('Content-Type', 'text/plain');
			  res.end();
			
		}else if(s=='c2'){
			
			pCall();
			res.statusCode = 200;
			res.setHeader('Content-Type', 'application/javascript');
			res.write("");
			res.end();
			
		}
		
   }
   
   		function isNumber(n) {
   				return !isNaN(parseFloat(n)) && isFinite(n);
   		}
		
		
		function pCall(){
			  
			  if(ttid){
				  try {
					  
					  var a;
					  var a1;
					  var a2;
					  var a3;
					  var amC=51;
					  var a1mC=51;
					  var a2mC=51;
					  var a3mC=51;
					  var tt_vid;
					  var tt_uvid;
					  var tt_time_c;
					  var pageName;
					  var pagePath='undefined';
					  var pageTitle;
					  var pageId;
					  var ipService = require('ip');
					  var ip = req.headers['x-forwarded-for'] || req.connection.remoteAddress;
					  console.log(ip);
					  var sIp;
					  if(ipService.isV4Format() && ip){
						  sIp=ipService.toLong(cIp);
					  }else{
						  sIp=null;
					  }
					  
					  var referrer='not defined';
					  
					  if(req.query.r){
						  referrer=req.query.r;
					  }else if(req.header('Referer')){
						  referrer=req.header('Referer');
					  }
					  
					  if(req.query.p2){
						  pagePath=req.query.p2;
					  }
					  
					  var hostname=req.headers.host;
					  var lang=req.headers["accept-language"];
					  var path=req.path;
					  
				
					  function makeid()
					  {
						    var text = "";
						    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			
						    for( var i=0; i < 5; i++ )
						        text += possible.charAt(Math.floor(Math.random() * possible.length));
			
						    return text;
					  }
					
	
					  if(req.query.p1){
						  pageName=req.query.p1;
					  }
					  
					  if(req.query.p2){
						  pageName=req.query.p2;
					  }
			
					  if(req.cookies.tt_vid){
						  tt_vid=req.cookies.tt_vid;
						// console.log('tt_vid '+tt_vid);
					  }
					  
					  if(req.cookies.tt_uvid){
						  tt_uvid=req.cookies.tt_uvid;
						// console.log('tt_uvid '+tt_uvid);
					  }
					  
					  if(req.cookies.tt_time_c){
						  tt_time_c=req.cookies.tt_time_c;
						// console.log('tt_time_c '+tt_time_c);
					  }
	
					  if(req.query.a){
						  a=req.query.a;
						  console.log(a);
						  if(req.query.a1){
							  a1=req.query.a1;console.log(a1);
							  if(req.query.a2){
								  a2=req.query.a2;
								  console.log(a2);
								  if(req.query.a3){
									 a3=req.query.a3; 
									 console.log(a3);
								  }
							  }
						  }
					  }
					  
					  
					  // console.log(a1+' '+a2+' '+a3);
					  
							  if(tt_vid && tt_uvid && ttid && pageName){
								  
								  console.log(tt_vid+' '+tt_uvid+' '+ttid);
					
								  
									  var accountData = {website_identity_token: ttid};
									  var cb=function(results){
										  // console.log('Results '+results[0].website_identity_token);
										  
										  if(results[0]){
											  var ctid=results[0].website_identity_token;
											  if(ctid==ttid){
												  console.log('website_identity_token '+results[0].website_identity_token);
												  saveVisit();
											  }
										  }
									  }
									  executeSql('SELECT website_identity_token FROM analytics_account WHERE website_identity_token = ? LIMIT 1',accountData,cb);
						
							  }
									  
							  function saveVisit(){
										  
										  // Insert visitor data
										  var visitorData = {visitor_ipv4: sIp,visitor_identity_hash: tt_uvid};
										  var iv=function(results){
											  console.log(results);
										  }
										  executeSql('INSERT IGNORE INTO visitor SET ?',visitorData,iv);
										  
										  // Insert visit data
										  var visitData = {visitor_hash_ref: tt_uvid,visit_identity_hash:tt_vid};
										  var ivi=function(results){
											  console.log(results);
										  }
										  executeSql('INSERT IGNORE INTO visit SET ?',visitData,iv);
										  
										  // Insert page data
										  // var pageData = {page_name: pageName};
				
										  /*var ipage=function(results){
						
												  if(!results.insertId || results.insertId==0){
													  
													 var pic=function(){
														 if(results[0] && results[0].page_id){
															 pageId=results[0].page_id;
															 console.log('page Id '+pageId);
														 }
													 }
													  
													 executeSql('SELECT page_id FROM hit_page WHERE page_name = ? LIMIT 1',{page_name: pageName},pic);
													  
												  }else{
													  if(results.insertId){
														  pageId=results.insertId;  
													  }else{
														  console.log('Insert Id '+results.insertId);
													  }
									
												  } 
												  console.log('page Id '+pageId);
												  
												  if(pageId){
													  
													// Insert hit data
													  var hitData = {visitor_id_ref: tt_uvid, hit_account_id_ref: ttid,page_id_ref:pageId,domain:hostname,referrer:referrer};
													  
													  for(var attributename in hitData){
														    console.log('h-data '+attributename+": "+hitData[attributename]);
													  }
													  
													  if(hitData.visitor_id_ref
													  && hitData.hit_account_id_ref
													  && hitData.page_id_ref){
														  
														  executeSql('INSERT INTO hit WHERE hit_account_id_ref = ? LIMIT 1', hitData,null);
													  }
											       }
								
										  }*/
										  
										  // executeSql('INSERT IGNORE INTO hit_page SET ?',pageData,ipage);
										  
										  if(!hostname){
											  hostname='unavailable';
										  }
										  
										  if(a){
												  if(a.length < amC){
													  var eventData={visit_id_hash_ref:tt_vid,category:a};
														  if(a1){
															  if(a1.length < a1mC){
																  eventData.action=a1;
																	  if(a2){
																		  if(a2.length < a2mC){
																			  eventData.path=a2;
																		  }
																	  }
																	  if(a3){
																		  if(a3.length < a3mC){
																			  eventData.label=a3;
																		  }
																	  }
																	  
																	  if(tt_time_c){
																		  eventData.time_since_page_view_load=tt_time_c;
																	  }
																	  
																	  var ec=function(results){
																		  if(results){
																			  
																		  }
																	  }
									
																	  executeSql('INSERT INTO event SET ?',eventData,ec);
																	  
															  }
														  }
												  
											  }
										  }else{
											  var hitData = {visitor_id_ref: tt_uvid, hit_account_id_ref: ttid, domain:hostname,referrer:referrer,page_name:pageName,page_path:pagePath};
											  
											  for(var attributename in hitData){
												    console.log('h-data '+attributename+": "+hitData[attributename]);
											  }
											  
											  var iHit=function(results){
											  }
											  executeSql('INSERT INTO hit SET ?',hitData,iHit);
											  
										  }
										  
										  
						}
	 
				  
				  }catch(err) {
				      console.log(err);
				  }
			
			  }
		
		}	
   
    
})
 
app.listen(3000)