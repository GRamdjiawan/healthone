<?php
    try{
        $db = new PDO("mysql:host=localhost;dbname=healthone", "root", "");
   
    } catch (PDOException $e) {
        die("Error!: " . $e->getMessage());

    }

?>