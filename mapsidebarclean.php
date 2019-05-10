<!-- RMV: added module header -->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD-vAuglNANoACqPI6uQcWcCIbDTgtbaAw&sensor=false&v=3&libraries=adsense"></script>
<script type="text/javascript" code="maps_code">
var stationList = [
  {"latlng":[35.681382,139.766084],name:"Lubu Toreh"},
  {"latlng":[35.630152,139.74044],name:"Lubu Satu"},
  {"latlng":[35.507456,139.617585],name:"Lubu Dua"},
  {"latlng":[35.25642,139.154904],name:"Talu Satu"},
  {"latlng":[35.103217,139.07776],name:"Talu Dua"}
];
var infoWnd, mapCanvas;
function initialize() {
  //Creates a map object.
  var mapDiv = document.getElementById("map_canvas");
  mapCanvas = new google.maps.Map(mapDiv);
  mapCanvas.setMapTypeId(google.maps.MapTypeId.ROADMAP);
  
  //Creates a infowindow object.
  infoWnd = new google.maps.InfoWindow();
  
  //Mapping markers on the map
  var bounds = new google.maps.LatLngBounds();
  var station, i, latlng;
  for (i in stationList) {
    //Creates a marker
    station = stationList[i];
    latlng = new google.maps.LatLng(station.latlng[0], station.latlng[1]);
    bounds.extend(latlng);
    var marker = createMarker(
      mapCanvas, latlng, station.name
    );
    
    //Creates a sidebar button for the marker
    createMarkerButton(marker);
  }
  //Fits the map bounds
  mapCanvas.fitBounds(bounds);
}

image = "img/marker-green.png";

function createMarker(map, latlng, title) {
  //Creates a marker
  var marker = new google.maps.Marker({
    position : latlng,
    map : map,
	icon:image,
    title : title
  });
  
  //The infoWindow is opened when the sidebar button is clicked
  google.maps.event.addListener(marker, "click", function(){
    infoWnd.setContent("<strong>" + title + "</title>");
    infoWnd.open(map, marker);
  });
  return marker;
}
function createMarkerButton(marker) {
  //Creates a sidebar button
  var ul = document.getElementById("marker_list");
  var li = document.createElement("li");
  var title = marker.getTitle();
  li.innerHTML = title;
  ul.appendChild(li);
  
  //Trigger a click event to marker when the button is clicked.
  google.maps.event.addDomListener(li, "click", function(){
    google.maps.event.trigger(marker, "click");
  });
}
google.maps.event.addDomListener(window, "load", initialize);
</script>
<script type="text/javascript" src="common_maps_code.js"></script>
<style type="text/css">
		#map_canvas {
			width: 75%;
			height: 500px;
			float: left;
		}
		ul#marker_list {
			padding:0;
			margin: 0;
			width: 23%;
			height: 500px;
			float: right;
		}
		ul#marker_list li {
			list-style: none;
			border: 1px solid #ccc;
			cursor: pointer;
			background-color: #eeeeee;
		} 
</style>

<!-- wraps contents begins from /var/www/vhosts/googlemaps.googlermania.com/httpdocs/xoops_trust_path/wraps/google_maps_api_v3/map_example_sidebar.html file.-->
	<div id="map_canvas" style="width:75%; height:500px;float: left"></div>
	<ul id="marker_list" style="width:23%;float: right"></ul>
	
<!-- wraps contents ends -->


	






  

  

  



  



