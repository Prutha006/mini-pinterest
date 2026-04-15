<?php
$connect = new mysqli("localhost", "root", "", "mini_pinterest");

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$username = $_POST['username'];
$email = trim($_POST['email']);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format. Please re-enter your email.");
}
$password = $_POST['password'];

$sql = "INSERT INTO users (username, email, password) 
        VALUES ('$username', '$email', '$password')";

if ($connect->query($sql) === TRUE) {
    echo "You have succesfully signed up!!";
} else {
    echo "Error: " . $connect->error;
}
?>