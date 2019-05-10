$(document).ready(function () {
	var option = $("#AgentType");
	var loading = $("#loading");
	var params = $("#params");
	
	var selOpt = $("option:selected", this).val();
	var AgentName = $('#AgentName').val().toLowerCase();
	var AgentID = $('form#adminForm input[name="AgentID"]:hidden').val();
	
	option.bind("change", function() {
		showLoading();
		var selVal = $(this).val(); 
		
		if( selVal == 0 ) {
			params.slideUp("fast");
			params.load("/lokasi/params/id/"+AgentID+"/jenislokasi/"+selVal+"/namalokasi/"+AgentName, hideLoading);
			params.slideDown("fast");
		} else if ( selVal == 1 ) {
			params.slideUp("fast");
			params.load("/lokasi/params/id/"+AgentID+"/jenislokasi/"+selVal+"/namalokasi/"+AgentName, hideLoading);
			params.slideDown("fast");
		} else if ( selVal == 2 ) {
			params.slideUp("fast");
			params.load("/lokasi/params/id/"+AgentID+"/jenislokasi/"+selVal+"/namalokasi/"+AgentName, hideLoading);
			params.slideDown("fast");
		} else {
			hideLoading();
		}
	});
	
	if ( selOpt == 0 ) {
		params.load("/lokasi/params/id/"+AgentID+"/jenislokasi/"+selOpt+"/namalokasi/"+AgentName, hideLoading);
		params.slideDown("fast");
	} else if ( selOpt == 1 ) {
		params.load("/lokasi/params/id/"+AgentID+"/jenislokasi/"+selOpt+"/namalokasi/"+AgentName, hideLoading);
		params.slideDown("fast");
	} else if ( selOpt == 2 ) {
		params.load("/lokasi/params/id/"+AgentID+"/jenislokasi/"+selOpt+"/namalokasi/"+AgentName, hideLoading);
		params.slideDown("fast");
	}
	
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
