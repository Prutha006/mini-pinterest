<?php
$conn = new mysqli("localhost", "root", "", "mini_pinterest");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
