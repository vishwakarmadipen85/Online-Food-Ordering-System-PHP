<?php
include '../includes/connect.php';

$username = $_POST['username'];
$password = $_POST['password'];

session_start();

$stmt = $con->prepare("SELECT id, name, password, role FROM users WHERE username = ? AND NOT deleted");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($user_id, $name, $hashed_password, $role);
    $stmt->fetch();

    if ($password === $hashed_password) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $role;
        $_SESSION['name'] = $name;

        if ($role == 'Administrator') {
            $_SESSION['admin_sid'] = session_id();
            header("location: ../admin-page.php");
        } else if ($role == 'Customer') {
            $_SESSION['customer_sid'] = session_id();
            header("location: ../index.php");
        } else {
            header("location: ../login.php");
        }
        exit();
    }
}
header("location: ../login.php");
exit();
?>