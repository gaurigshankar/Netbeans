<!DOCTYPE html>
<html>
<head>
<title>GeoLocation Demo</title>
<meta charset="utf-8"/>
<style type="text/css">
table { margin: 1em; border-collapse: collapse; }
td, th { padding: .3em; border: 1px #ccc solid; }
thead { background: #fc9; }
tbody { background: #9cf; }
#highlight tr.hilight { background: #c9f; }
</style>
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
  var startPos;
  var map;

  function init()
  {
    if(navigator.geolocation)
    {
  document.getElementById("support").innerHTML = "<p style='color:green'>Great! This browser supports HTML5 Geolocation</p>";
      navigator.geolocation.getCurrentPosition(updateLocation,handleLocationError,{timeout:50000});
  //navigator.geolocation.watchPosition(updateCurrPosition,handleLocationError);

    }
    else
    {
      document.getElementById("support").innerHTML = "<p style='color:red'>Oops! This browser does not support HTML5 Geolocation</p>";
    }
  }

 function updateLocation(position)
 {
   startPos = position;
   var latitude = position.coords.latitude;
   var longitude = position.coords.longitude;
  document.getElementById("lat").value = latitude;
  document.getElementById("lng").value = longitude;
  var requestLocation= $.ajax({
     type: "GET",
     url: "/mysqlclass.php",
     async: false,
     data: {lat: latitude , lng :longitude},
     dataType: "html",
});//alert(requestLocation.responseText);
$('#nearstores').html(requestLocation.responseText);
  
    //$( "#lng" ).html("Longitude:"+longitude );

   //document.getElementById("startLat").innerHTML = latitude;
   //document.getElementById("startLon").innerHTML = longitude;
/*
   var coords = new google.maps.LatLng(latitude,longitude);

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
                                       });
*/
 }

 function handleLocationError(error)
 {
   switch(error.code)
   {
     case 0:
      updateStatus("There was an error while retrieving your location: " + error.message);
     break;

     case 1:
      updateStatus("The user prevented this page from retrieving the location.");
      break;

     case 2:
      updateStatus("The browser was unable to determine your location: " + error.message);

      break;

     case 3:

      updateStatus("The browser timed out before retrieving the location.");

      break;
   }
 }

 function updateStatus(msg)
 {
  document.getElementById("divStatus").innerHTML = msg;
 }

</script>
<?php
require("phpsqlsearch_dbinfo.php");
if(isset($_POST['Submit']))
{
//$db = new mysqli ('phpmyadmin01.local.one.com','***','***','***');//connect to db  
$connection=mysql_connect ('kosmixenterprises.com.mysql', $username, $password);
if (!$connection) {
  die("Not connected : " . mysql_error());
}

// Set the active mySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ("Can\'t use db : " . mysql_error());
}
if ($db_selected) {
  echo("DB Selected");
}
$storename = $_POST['storename'];
$storeaddress = $_POST['storeaddress'];
$storephone = $_POST['storephone'];
$storetype = $_POST['storetype'];
$latitude = $_POST['lat'];
$longitude = $_POST['lng'];
$storecontactname=$_POST['storecontactname'];
echo($latitude);
//$results4 = $db->query("UPDATE images SET title='$title' WHERE pkey='$counter'");
$db->close();
}

?>
</head>

<body onload="init()">  
  
<div id="support"></div>
<div id="divStatus"></div>
<!--<div id="map_canvas" style="width:600px;height:400px;"></div> -->
<form name="geolocation" method="post" enctype="multipart/form-data"  action="">
<table class="hilite" id="highlight">
<thead>
<tr>
  <th>Lattitude</th>
  <th>Longitude</th>
  <th>Store Name</th>
  <th>Contact Name</th>
  <th>Address</th>
  <th>Area Code</th>
  <th>PinCode</th>
  <th>StoreType</th>
  <th>Phone</th>
  <th>Comments</th>
  <th>Submit</th></tr>
</thead>
<tbody>
<tr>
    <td><input id="lat" name="lat" type="text"></td>
    <td><input id="lng" name="lng" type="text"></td>
    <td><input name="storename" type=text></td>
    <td><input name="storecontactname" type=text></td>
    <td><input name="storeaddress" type=text></td>
    <td><input name="storeareacode" type=text></td>
    <td><input name="storepincode" type=text></td>
    <td><input name="storetype"type=text></td>
    <td><input name="storephone" type=text></td>
    <td><input name="storecomments"type=text></td>
    <td><input type="submit" name="Submit" /></td></tr>
</tbody>
</table>
</form>
<div id="nearstores" ></div>
</body>
</html>