<?php
$servername = "26.216.193.84";
$username = "root";
$password = "";
$dbname = "st29";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
