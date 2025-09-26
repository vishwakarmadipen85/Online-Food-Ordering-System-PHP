<?php
include '../includes/connect.php';

function number($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password hashing
$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$role = $_POST['role'];
$verified = $_POST['verified'];
$deleted = $_POST['deleted'];

// Use prepared statement for security
$stmt = $con->prepare("INSERT INTO users (username, password, name, email, contact, address, role, verified, deleted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssissii", $username, $password, $name, $email, $contact, $address, $role, $verified, $deleted);
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
header("location: ../users.php");
exit();
?>