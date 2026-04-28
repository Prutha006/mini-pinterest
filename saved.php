<?php
// Start session (important for user login)
session_start();

// Database connection
$connect = new mysqli("localhost", "root", "", "mini_pinterest");

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in";
    exit();
}

$user_id = $_SESSION['user_id'];

// Get board name from POST
if (isset($_POST['name'])) {
    $name = trim($_POST['name']);

    if ($name == "") {
        echo "Board name cannot be empty";
        exit();
    }

    // Insert into database
    $stmt = $connect->prepare("INSERT INTO boards (user_id, name) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $name);

    if ($stmt->execute()) {
        echo "Board created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No data received";
}

$connect->close();
?>
