
/****
Author & developer: Lauri Turunen 
Script loader setup for google analytics
features
- Asynchronius loading & dependency management
- Synchronius loading
- Uses a generic loader, which can be applied to most everything and is not applicaple to only this case
  
*/

(function(window,document){
    var p = this;
    window.safeAjax=true;
    var host=location.hostname;
    var localJsPath="";
    if(host=="localhost"){
    	localJsPath='http://localhost/js/';
    }else if(host=="something"){
        localJsPath='https://';
    }
    var st1 = (new Date()).getTime();

    // #### The callback functions. add and edit ####
    var fp1 = function() {
        var boostrap = function() {
        	// $('.sethidden').css("visibility", "visible");
        }
        ca(0, boostrap);
    };

    //#### (URL,callback,start to load after previous,async) ####
    var sl = [
        [localJsPath+'router.js', fp1, false, 1],
        [localJsPath+'binder.js', fp1, false, 1]
    ];
    var sll = sl.length;
    // EDIT THIS to match. Format: Index holder for the package (indexHolder, How many In package)
    var packages = [
        [0, sll]
        // [0, 2]
    ];
    var async = 1;
    var m;
    var s;
    var ix = 0;

//#### Base code. DO NOT TOUCH ####
var ca=function(t,e){function n(t,e){++packages[t][0]==packages[t][1]&&e&&e()}try{"number"!=typeof t||"function"!=typeof e&&0!=e||(s.readyState?s.onreadystatechange=function(){"loaded"!==s.readyState&&"complete"!==s.readyState||n(t,e)}:s.onload=function(){n(t,e)})}catch(t){}},itp=function(){s=document.createElement("script"),m=document.getElementsByTagName("script")[0],s.async=sl[ix][4],s.src=sl[ix][0],m.parentNode.insertBefore(s,m),sl[ix][2]?s.readyState?s.onreadystatechange=function(){"loaded"!==s.readyState&&"complete"!==s.readyState||("function"==typeof sl[ix][1]&&sl[ix][1](),ix++,ld())}:s.onload=function(){"function"==typeof sl[ix][1]&&sl[ix][1](),ix++,ld()}:0==sl[ix][2]&&("function"==typeof sl[ix][1]&&sl[ix][1](),ix++,ld())},ld=function(){ix<sll&&"string"==typeof sl[ix][0]&&(null==sl[ix][1]||"function"==typeof sl[ix][1]||0==sl[ix][2]||1==sl[ix][2])&&itp()};ld();
})(window,document);