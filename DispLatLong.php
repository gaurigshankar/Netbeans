<html>
    <head>
        <?php include 'Header.php'; ?>
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
  document.getElementById("lat").innerHTML = latitude;
  document.getElementById("lng").innerHTML = longitude;
    
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
</script>
</head>
<body onload="init()">
    <div id="support"></div>
    Latitude <div id="lat"></div>
    Longitude <div id="lng"></div>
</body>
</html>

