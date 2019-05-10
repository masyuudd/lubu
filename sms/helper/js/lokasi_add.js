$(document).ready(function () {
	var option = $("#AgentType");
	var loading = $("#loading");
	var params_add = $("#params");
	
	var AgentName = $('#AgentName').val().toLowerCase();
	
	option.bind("change", function() {
		showLoading();
		var selVal = $(this).val(); 
		
		if( selVal == 0 ) {
			params_add.slideUp("fast");
			params_add.load("/lokasi/params_add/jenislokasi/"+selVal, hideLoading);
			params_add.slideDown("fast");
		} else if ( selVal == 1 ) {
			params_add.slideUp("fast");
			params_add.load("/lokasi/params_add/jenislokasi/"+selVal, hideLoading);
			params_add.slideDown("fast");
		} else if ( selVal == 2 ) {
			params_add.slideUp("fast");
			params_add.load("/lokasi/params_add/jenislokasi/"+selVal, hideLoading);
			params_add.slideDown("fast");
		} else  {
			params_add.slideUp("fast");
			hideLoading();
		}
	});
	
	function showLoading(){
		loading
			.css({visibility:"visible"})
			.css({opacity:"1"})
			.css({display:"block"})
		;
	}
	
	function hideLoading(){
		loading.fadeTo(1000, 0);
	};
});
