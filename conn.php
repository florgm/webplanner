<?php
    $servidor = "mysql:dbname=calendario;host=localhost";

    try {
        $pdo = new PDO($servidor, 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    } catch(PDOException $e) {
        die("Connection failed");
    }
?>