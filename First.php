<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include ('GetDataFromDB.php');
 
            $connection = new GetDataFromDB(); //i created a new object

            $connection->getConnection(); // connected to the database

            echo "<br />"; // putting a html break


            $connection->selectDatabase();// closed connection
//            $phoneNo="9790902028";
//            $firstName="Gauri";
//            $lastName="Shankar";
//            $userId ="gauri.gshankar";
//            $address ="Address Value";
//            $orderText = "turmeric powder 1 packet";
//            $imageLocation = "na";
            
            $connection->insertNewCustomer($_POST[phoneNo],$_POST[firstName],$_POST[lastName],$_POST[userId],$_POST[address]);
            $connection->insertNewOrder($_POST[phoneNo],$_POST[orderText],$_POST[imageLocation]);
            $connection->closeConnection();
         
         
        