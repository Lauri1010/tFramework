/**
 * setupEventBindingHere
 */

var testClick=function(){
	console.log('Clicked');
	

}

$.bindEvent('click','#test',testClick);