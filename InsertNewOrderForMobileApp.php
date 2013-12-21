<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include ('GetDataFromDB.php');
 if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $phoneNo=$_POST[phoneNo];
            $firstName=$_POST[firstName];
            $lastName=$_POST[lastName];
            $userId =$_POST[userId];
            $address =$_POST[address];
            $orderText = $_POST[orderText];
            $imageLocation = $_POST[imageLocation];
     $error_status = FALSE;
     if (empty($phoneNo) || empty($firstName) | empty($lastName) | empty($userId) | empty($address)  ){
         $error_status = TRUE;
          logToFile(basename(__FILE__)."One of the mandatory value was empty so redirection happened ");
          header('Location: http://kosmixenterprises.com');
     }
     
     if(empty($orderText) | empty($imageLocation)){
         $error_status = TRUE;
         logToFile(basename(__FILE__)."One of the mandatory value was empty so redirection happened ");
         header('Location: http://kosmixenterprises.com');
     }
     
     
     if(!$error_status){
            $connection = new GetDataFromDB(); //i created a new object

            $connection->getConnection(); // connected to the database

            echo "<br />"; // putting a html break

          

            $connection->selectDatabase();
            logToFile(basename(__FILE__)."About to insert into customer table with data ".$_POST[phoneNo] . $_POST[firstName]. $_POST[lastName]. $_POST[userId]. $_POST[address]);
            
            $connection->insertNewCustomer($_POST[phoneNo],$_POST[firstName],$_POST[lastName],$_POST[userId],$_POST[address]);
            logToFile(basename(__FILE__)."Data inserted into customer table sucessfully ");
            logToFile(basename(__FILE__)."About to insert into order table with data ".$_POST[phoneNo],$_POST[orderText],$_POST[imageLocation]);
            $connection->insertNewOrder($_POST[phoneNo],$_POST[orderText],$_POST[imageLocation]);
            logToFile(basename(__FILE__)."Inserted into Order table ");
            
            $connection->closeConnection();
     }
         
 }    
        