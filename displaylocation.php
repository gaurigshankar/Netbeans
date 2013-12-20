    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script>
    $( document ).ready(function() {
	var lat = $.getUrlVar('lat');
	var lng = $.getUrlVar('lng');
    //document.getElementById("lat").innerHTML = lat+""+lng;
   // document.getElementById("lng").innerHTML = lng;
var coords = new google.maps.LatLng(lat,lng);

   var mapOptions = { zoom:15,
                      center:coords,
                      mapTypeControl:false,
                      navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL},
                      mapTypeId:google.maps.MapTypeId.ROADMAP
                    };

  map = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);

  var marker = new google.maps.Marker({ position:coords,
                                map:map,
                                        title:"Your current location!"
   
});                                    });
$.extend({
  getUrlVars: function(){
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
      hash = hashes[i].split('=');
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    return vars;
  },
  getUrlVar: function(name){
    return $.getUrlVars()[name];
  }
});
</script>

<body>
<div id="lat" ><div>
<div id="lng" ></div>
<div id="map_canvas" style="width:600px;height:400px;"></div>
</body>
<?php
$center_lat = $_GET["lat"];
$center_lng = $_GET["lng"];
$radius = $_GET["radius"];

echo "Latitude:";
echo $center_lat+"<br/>";
echo "</br/>Longitude:";
echo $center_lng;
?>
<?PHP
 include ("mysqlclass.php");
 ?>