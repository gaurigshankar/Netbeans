<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 $radius="1000";
 define("envName", "prod");
//if ($envName == 'dev') {
//    define("mySQLDBHost", "localhost:8889");
//    define("mySQLDBUserName","root");
//    define("mySQLDBPassword","root");
//    define("mySQLDBName","kosmixenterpris");
//}
//elseif ($envName == 'prod') {
    define("mySQLDBHost", "kosmixenterprises.com.mysql");
    define("mySQLDBUserName","kosmixenterpris");
    define("mySQLDBPassword","G3GYt3RZ");
    define("mySQLDBName","kosmixenterpris");
//}
    
function logToFile($msg)
   { 
    $logFileName="current.log";
    
    if (file_exists($logFileName)) {
        $fh = fopen($logFileName, 'a');
    } else {
        $fh = fopen($logFileName, 'w');
    } 
  
   // append date/time to message
   $str = "[" . date("Y/m/d h:i:s", mktime()) . "] " . $msg; 
   // write string
   fwrite($fh, $str . "\n");
   // close file
   fclose($fh);
   }
