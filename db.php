<?php
$connect= new mysqli("127.0.0.1", "root", "", "mini_pinterest");

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>
