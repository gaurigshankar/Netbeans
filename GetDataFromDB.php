<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GetDataFromDB
 *
 * @author gshanka
 */
include ("ApplicationConstants.php");

//Init::init();
class GetDataFromDB {
    //put your code here
//var  $mySQLDBHost="localhost:8889";
    

    
    function getConnection(){
        echo envName,mySQLDBHost;
        try{
            $conn = @mysql_connect(mySQLDBHost,mySQLDBUserName,mySQLDBPassword);
            if(!$conn){
                throw new Exception('MySQL Connection Database Error: ' . mysql_error());
                exit();
                die (basename(__FILE__)." Cannot connect to DB");
                logToFile(basename(__FILE__)."Cannot connect to DB");
            }
            else{
                $this->mySQLConn = $conn;
              //  echo("");
              logToFile(basename(__FILE__)." Connection Established to DB");

            }
        }
    catch(Exception $e){
        echo $e->getMessage();
    }
        return $this->mySQLConn;
    }
    
     function selectDatabase() // selecting the database.
    {
        mysql_select_db(mySQLDBName);  //use php inbuild functions for select database

        if(mysql_error()) // if error occured display the error message
        {

            logToFile(basename(__FILE__)." Cannot find the database ".mySQLDBName);

        }
        logToFile(basename(__FILE__)." Database selected..");
    }
    
    function closeConnection(){
        mysql_close($this->mySQLConn);
       logToFile(basename(__FILE__)." Connection closed");
    }
    
    function insertNewStore(){
        
    }
    
    function approveStore(){
        
    }
    
    function getCurrentStoreStatus(){
        
    }

    
    function getStoreTypes(){
        try{
        $storeTypes = array();
        $query = "select StoreTypeCode,StoreTypeName from StoreTypeMapping";
      
        
        $result = mysql_query($query);
       echo "the results are new gg <br/> ".$result  . " results over";
        while($row = mysql_fetch_array($result))
        {
           array_push($storeTypes[$row['StoreTypeCode']] = $row['StoreTypeName']);
        }
        
         }
        catch(Exception $e){
            
            logToFile(basename(__FILE__)." Exception in getStoreTypes ".$e->getMessage());
        }
        function getAreaCodes(){
        try{
        $storeTypes = array();
        $query = "select * from `AreaCodeMapping`";
      
        
        $result = mysql_query($query);
       echo "the results are new gg <br/> ".$result  . " results over";
        while($row = mysql_fetch_array($result))
        {
            print_r($row);
           array_push($storeTypes[$row['StoreTypeCode']] = $row['StoreTypeName']);
        }
        
         }
        catch(Exception $e){
            
            logToFile(basename(__FILE__)." Exception in getStoreTypes ".$e->getMessage());
        }
        
        }
    }
    function insertNewCustomer($phoneNo,$firstName,$lastName,$userId,$address){
       logToFile(basename(__FILE__)." Start insert to new customer ");
        try{
            $insertQuery = "INSERT INTO `customer_details`(`phone_number`, `first_name`, `last_name`, `user_id`, `address`) 
                VALUES ($phoneNo,'$firstName','$lastName','$userId','$address')";
             logToFile(basename(__FILE__)." The Query is" .$insertQuery);
            mysql_query($insertQuery);
            mysqli_query($insertQuery);
             mysqli_query("commit");
            logToFile(basename(__FILE__)." end insert to new customer ");
        }
        catch (Exception $e){
            logToFile(basename(__FILE__)." Exception in inserting New Customer ".$e->getMessage());
        }
    }
    
    function insertNewOrder($phoneNo,$orderText,$imageLocation){
        try{
            logToFile(basename(__FILE__)." Start insert to new order ");
             $insertQuery = "INSERT INTO `orderTable`( `phone_number`, `order_text`, `image_location`)
                 VALUES ($phoneNo,'$orderText','$imageLocation')";
             
             logToFile(basename(__FILE__)." The Query is" .$insertQuery);
             mysql_query($insertQuery);
             mysql_query("commit");
             $orderId = mysql_insert_id();logToFile(basename(__FILE__)." end insert to new order ");
             return $orderId;
        }
        catch (Exception $e){
            logToFile(basename(__FILE__)." Exception in inserting New Order ".$e->getMessage());
        }
    }
       function getStoresCloseToGivenCoord($center_lat,$center_lng){


        if(!is_null($center_lat) && !is_null($center_lng) ){
         $this->getConnection();
         $this->selectDatabase();
         $radius="2500";

        $query = sprintf("SELECT address, StoreName, latitude, longitude, ( 3959 * acos( cos( radians('%s') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('%s') ) + sin( radians('%s') ) * sin(radians( latitude ) ) ) ) AS distance FROM StoreDetails HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
        mysql_real_escape_string($center_lat),
        mysql_real_escape_string($center_lng),
        mysql_real_escape_string($center_lat),
        mysql_real_escape_string($radius));
        $result = mysql_query($query);

        if (!$result) {
            die("Invalid query: " . mysql_error());
        }
        $this->closeConnection();
        return $result;
        }
       }
}
