<?php
/**
 * Configuration for database connection
 *
 */
$host = "localhost";
$username = "root";
$password = "Dave@MySQL1"; //ENTER YOUR PASSWORD
$dbname = "gymdb";
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
