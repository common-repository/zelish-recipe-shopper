( function() {
	jQuery.ajax({
	    url: sZelishObj.ajaxUrl,
	    type: 'GET',
	    async: true,
	    crossDomain: true,
	    cache: false,
	    headers: {
	        "Accept": "application/json",
	        "Access-Control-Allow-Origin": "*"
	    },
	    success: function(response) {
	    	console.log(response.data);      
	    }
	});
	setTimeout(function(){ 
		jQuery(document).find('.shopnow_button').on('click',function(e) {
	    	e.preventDefault();
	    	let url = jQuery(this).attr('href');
	    	window.open(sZelishObj.rdrUrl + url); 
		});
	},400);
})();