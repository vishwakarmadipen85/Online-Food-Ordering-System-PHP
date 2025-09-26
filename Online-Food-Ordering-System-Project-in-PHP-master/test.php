<?php
echo "PHP is working!<br>";
echo "Current time: " . date('Y-m-d H:i:s') . "<br>";

// Test database connection
$servername = "localhost";
$server_user = "root";
$server_pass = "";
$dbname = "food";

$con = new mysqli($servername, $server_user, $server_pass, $dbname);

if ($con->connect_error) {
    echo "Database connection failed: " . $con->connect_error;
} else {
    echo "Database connection successful!<br>";
    
    // Test if users table exists
    $result = $con->query("SELECT COUNT(*) as count FROM users");
    if ($result) {
        $row = $result->fetch_assoc();
        echo "Users table has " . $row['count'] . " records";
    } else {
        echo "Error accessing users table: " . $con->error;
    }
}
?>
