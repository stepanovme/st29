<?php
$servername = "192.168.1.34";
$username = "root";
$password = "";
$dbname = "st29";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
