<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD-vAuglNANoACqPI6uQcWcCIbDTgtbaAw&sensor=false&v=3&libraries=adsense"></script>

<script type="text/javascript"> 
//<![CDATA[
      // this variable will collect the html which will eventually be placed in the side_bar 
      var side_bar_html = ""; 
    
      // arrays to hold copies of the markers and html used by the side_bar 
      // because the function closure trick doesnt work there 
      var gmarkers = []; 
      var map = null;

function initialize() {
  // create the map
  var myOptions = {
    mapTypeControl: true,
    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map = new google.maps.Map(document.getElementById("map_canvas"),
                                myOptions);
 
  google.maps.event.addListener(map, 'click', function() {
        infowindow.close();
        });
	google.maps.event.addDomListener(window, "resize", function() {
    var center = map.getCenter();
    google.maps.event.trigger(map, "resize");
    map.setCenter(center);
});

  // Add markers to the map
  // Set up three markers with info windows 
  // add the points    
  
  
  bounds  = new google.maps.LatLngBounds();
 
  
  point = new google.maps.LatLng(0.818952778,99.85300556);
  var marker = createMarker(point,"Lubu Toreh","Lubu Toreh")
  bounds.extend(point);
  
  
  point = new google.maps.LatLng(0.828952778,99.86300556);
  var marker = createMarker(point,"Lubu Satu","Lubu Satu")
  bounds.extend(point);

  point = new google.maps.LatLng(0.804866667,99.87851389);
  var marker = createMarker(point,"Lubu Dua","Lubu Dua")
  bounds.extend(point);
	
  point = new google.maps.LatLng(0.206941667,99.98317778);
  var marker = createMarker(point,"Talu Satu","Talu Satu")
  bounds.extend(point);
  
  point = new google.maps.LatLng(0.178827778,99.96306389);
  var marker = createMarker(point,"Talu Dua","Talu Dua")
  bounds.extend(point);
  
  point = new google.maps.LatLng(3.061160,98.200362);
  var marker = createMarker(point,"Simolap","Simolap")
  bounds.extend(point);
  
  
  // put the assembled side_bar_html contents into the side_bar div
  
  map.fitBounds(bounds);      
  map.panToBounds(bounds);

  document.getElementById("side_bar").innerHTML = side_bar_html; 
}
 
var infowindow = new google.maps.InfoWindow(
  { 
    size: new google.maps.Size(150,50)
  });
    
// This function picks up the click and opens the corresponding info window
function myclick(i) {
  google.maps.event.trigger(gmarkers[i], "click");
  map.setCenter(marker.getPosition())
}

// A function to create the marker and set up the event window function 
function createMarker(latlng, name, html) {
	var image = "img/marker-green.png";
    var contentString = html;
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
		icon:image
        });

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(contentString); 
        infowindow.open(map,marker);
        });
    // save the info we need to use later for the side_bar
    gmarkers.push(marker);
    // add a line to the side_bar html
    side_bar_html += '<a href="javascript:myclick(' + (gmarkers.length-1) + ')">' + name + '<\/a> | ';
}
 

    // This Javascript is based on code provided by the
    // Community Church Javascript Team
    // http://www.bisphamchurch.org.uk/   
    // http://econym.org.uk/gmap/
    // from the v2 tutorial page at:
    // http://econym.org.uk/gmap/basic2.htm 
//]]>
</script> 


<body style="margin:0px; padding:0px;" onload="initialize()"> 
	<div id="side_bar"></div> 
	<div id="map_canvas" style="width: 100%; height: 50vh"></div> 
</body> 
