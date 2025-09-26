<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$servername = "localhost";
$server_user = "root";
$server_pass = "";
$dbname = "food";

// Create connection
$con = new mysqli($servername, $server_user, $server_pass, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Safely get session variables
$name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>