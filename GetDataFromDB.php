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

    function getStoresCloseToGivenCoord(){
        
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
    function 
}
