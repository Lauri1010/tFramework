/**
 * Biding jquery calls after an ajax call
 */

(function ($) {
	

	$('body').on('submit','form', function(e) {
	
	    e.preventDefault();
	    console.log('fPath name in fRun '+window.fRun.fPathName);
	    
	    if(window.fRun.fPathName){
	    
		    var data = $(this).serialize();
		    
			$.ajax({
				  method: "POST",
				  url: window.fRun.fPathName,
				  data: data
			}).done(function(data) {
				  $("#mContainer").html(data);
	
			});
		
	    }

	});	

    $.extend({
    	bindEvent: function (action,selector,pAction) {
            
        	$("body").on(action,selector, function() {
        		pAction();
        	});

        }

    });

})(jQuery);