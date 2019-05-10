$(document).ready(function() {
	setInterval('updateClock()', 1000);
	$('#daritanggal,#sampaitanggal').datepick({dateFormat: 'yyyy-mm-dd'}); 
});

