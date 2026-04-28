<?php
session_start();
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
  $check = "SELECT * FROM users WHERE email='$email' AND username='$username'";
    $res = $connect->query($check);
 if($res->num_rows > 0){
        echo "Account already exist!";
 }
else{

$sql = "INSERT INTO users (username, email, password)
        VALUES ('$username', '$email', '$password')";


if ($connect->query($sql) === TRUE) {
    $user_id=$connect->insert_id;
    $_SESSION['user_id'] = $user_id;
    header("location:home_page.php");
    exit();

} else {
     echo "Error: " . $connect->error;
  }
}

?>
