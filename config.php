<?php
$host = "localhost";
$username = "root";
$password = ""; //ENTER YOUR PASSWORD
$dbname = "gymdb";
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
