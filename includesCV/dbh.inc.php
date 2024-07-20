<?php

 $host = 'localhost';
 $dbname = 'cvbuilderdb';
 $dbusername = 'root';
 $dbpassword = '';

 try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 } catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
 }
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");

    $pdo->exec("CREATE TABLE IF NOT EXISTS cv_data (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        user_id INT(11) NOT NULL,
        cvname VARCHAR(255) NOT NULL,
        fullname VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        gender VARCHAR(255) NOT NULL,
        age INT(2) NOT NULL,
        phone VARCHAR(15) NOT NULL,
        job_title VARCHAR(255) NOT NULL,
        company VARCHAR(255) NOT NULL,
        start_date DATE NOT NULL,
        end_date DATE NOT NULL,
        degree VARCHAR(255) NOT NULL,
        university VARCHAR(255) NOT NULL,
        graduation_year INT(4) NOT NULL,
        about_me VARCHAR(512) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL,
        pwd VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");