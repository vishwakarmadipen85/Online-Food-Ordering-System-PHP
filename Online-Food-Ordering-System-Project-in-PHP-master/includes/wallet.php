<?php
// Ensure session and database connection are available
if (!isset($_SESSION['user_id'])) {
    die('User not logged in.');
}

$user_id = intval($_SESSION['user_id']);

// Get wallet id for the user
$wallet_id = null;
$sql = mysqli_query($con, "SELECT id FROM wallet WHERE customer_id = $user_id LIMIT 1");
if ($row = mysqli_fetch_assoc($sql)) {
    $wallet_id = $row['id'];
}

$balance = 0.0;
if ($wallet_id !== null) {
    $sql = mysqli_query($con, "SELECT balance FROM wallet_details WHERE wallet_id = $wallet_id ORDER BY id DESC LIMIT 1");
    if ($row = mysqli_fetch_assoc($sql)) {
        $balance = $row['balance'];
    }
}
?>