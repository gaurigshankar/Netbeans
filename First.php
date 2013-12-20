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
            $connection->getAreaCodes();
            $connection->closeConnection();
         
         
        