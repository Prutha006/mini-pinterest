<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    echo "User not logged in";
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['name'])) {
    $name = trim($_POST['name']);

    if ($name == "") {
        echo "Board name cannot be empty";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO boards (user_id, name) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $name);

    if ($stmt->execute()) {
        echo "Board created";
    } else {
        echo "Error";
    }

    $stmt->close();
} else {
    echo "No data";
}
?>
