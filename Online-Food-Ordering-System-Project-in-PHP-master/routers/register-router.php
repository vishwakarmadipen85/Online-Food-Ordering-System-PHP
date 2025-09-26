<?php
include '../includes/connect.php';

$name = htmlspecialchars($_POST['name']);
$username = htmlspecialchars($_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password hashing
$phone = $_POST['phone'];

function number($length) {
    $result = '';
    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }
    return $result;
}

// Use prepared statement for security
$stmt = $con->prepare("INSERT INTO users (name, username, password, contact) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $username, $password, $phone);
if($stmt->execute()){
    $user_id = $stmt->insert_id;
    $stmt->close();

    $stmt2 = $con->prepare("INSERT INTO wallet(customer_id) VALUES (?)");
    $stmt2->bind_param("i", $user_id);
    if($stmt2->execute()){
        $wallet_id = $stmt2->insert_id;
        $stmt2->close();

        $cc_number = number(16);
        $cvv_number = number(3);

        $stmt3 = $con->prepare("INSERT INTO wallet_details(wallet_id, number, cvv) VALUES (?, ?, ?)");
        $stmt3->bind_param("iss", $wallet_id, $cc_number, $cvv_number);
        $stmt3->execute();
        $stmt3->close();
    }
}
header("location: ../login.php");
exit();
?>