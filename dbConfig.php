<?php
$dbHost     = "localhost:3306";
$dbUsername = "root";
$dbPassword = "root";
$dbName     = "image";

$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>