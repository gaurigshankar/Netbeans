<?PHP
 include ("GetDataFromDB.php");
$dbconnect = NEW GetDataFromDB();
$center_lat = $_GET["lat"];
$center_lng = $_GET["lng"];
$result = $dbconnect->getStoresCloseToGivenCoord($center_lat,$center_lng);

while ($row = @mysql_fetch_assoc($result)){
  //$node = $dom->createElement("marker");
  //$newnode = $parnode->appendChild($node);
  echo $row['name'];
  echo $row['address'];
  echo " lat: ", $row['lat'];
  echo " lng: ", $row['lng'];
  echo "distance:";echo $row['distance'];echo "<br/>";
}
echo $result;
 
?> 