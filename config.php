<?php
$servername = "sql309.infinityfree.com";
$username = "if0_37380638"; // Your MySQL username
$password = "Yf819ucCPgLbDfP"; // Your MySQL password
$dbname = "if0_37380638_olasmuqaqos"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
