<?php
// Database connection
$host = 'localhost';
$dbname = 'charamidis_database';
$username = 'root';
$password = '';


$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");


?>