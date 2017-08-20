
/****
Author & developer: Lauri Turunen 
Script loader setup for google analytics
features
- Asynchronius loading & dependency management
- Synchronius loading
- Page naming for GA
- Uses a generic loader, which can be applied to most everything and is not applicaple to only this case
  
*/

(function(window,document){
    var p = this;
    window.safeAjax=true;
    var st1 = (new Date()).getTime();

    // #### The callback functions. add and edit ####
    var fp1 = function() {
        var boostrap = function() {
                console.log('Package loaded');
            }
            // Package index, callback after package has been loaded
        ca(0, boostrap);
    };
    var fp2 = function() {
        var boostrap = function() {
        		if(window.tRun){
	                if (typeof window.tRun.i === "function") {
	                    window.tRun.i(ttid, true,true, false, null,false);
	                    window.tRun.ttime(ttid,2,false,st1,false);
	                }
                }
            }
            // Package index, callback after package has been loaded
        ca(1, boostrap);
    };
    
    //#### (URL,callback,start to load after previous,async) ####
    var sl = [
        ['http://localhost/js/tMainRouter.js', fp1, false, 1],
        ['http://localhost/js/jquery-3.1.0.min.js', fp1, false, 1],
        ['http://localhost/js/jsMainBinder.js', fp1, false, 1],
        ['http://localhost/js/jsEvents.js', fp1, false, 1],
        ['http://localhost:3000/?s=td', fp2, false, 1],
        ['http://localhost:3000/?s=ta', fp2, false, 1]
    ];

    // EDIT THIS to match. Format: Index holder for the package (indexHolder, How many In package)
    var packages = [
        [0, 4],
        [0, 2]
    ];
    var ttid = "1";
    var sll = sl.length;
    var async = 1;
    var m;
    var s;
    var ix = 0;

//#### Base code. DO NOT TOUCH ####
var ca=function(t,e){function n(t,e){++packages[t][0]==packages[t][1]&&e&&e()}try{"number"!=typeof t||"function"!=typeof e&&0!=e||(s.readyState?s.onreadystatechange=function(){"loaded"!==s.readyState&&"complete"!==s.readyState||n(t,e)}:s.onload=function(){n(t,e)})}catch(t){}},itp=function(){s=document.createElement("script"),m=document.getElementsByTagName("script")[0],s.async=sl[ix][4],s.src=sl[ix][0],m.parentNode.insertBefore(s,m),sl[ix][2]?s.readyState?s.onreadystatechange=function(){"loaded"!==s.readyState&&"complete"!==s.readyState||("function"==typeof sl[ix][1]&&sl[ix][1](),ix++,ld())}:s.onload=function(){"function"==typeof sl[ix][1]&&sl[ix][1](),ix++,ld()}:0==sl[ix][2]&&("function"==typeof sl[ix][1]&&sl[ix][1](),ix++,ld())},ld=function(){ix<sll&&"string"==typeof sl[ix][0]&&(null==sl[ix][1]||"function"==typeof sl[ix][1]||0==sl[ix][2]||1==sl[ix][2])&&itp()};ld();
})(window,document);