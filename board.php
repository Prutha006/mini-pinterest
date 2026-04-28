<!DOCTYPE html>
<html>
<head>
    <title>Saved</title>
    <style>
        body {
            font-family: Arial;
            margin: 0;
        }
        .navbar {
            background-color: #333;
            padding: 10px;
        }
        .navbar a {
            color: white;
            margin: 10px;
            text-decoration: none;
            font-weight: bold;
        }
        .navbar a:hover {
            color: yellow;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="home_page.php">Home</a>
    <a href="search.php">Search</a>
    <a href="saved.php">Saved</a>
    <a href="profile.php">Profile</a>
</div>

<div class="content">
<?php
session_start();
$user_id=$_SESSION['user_id'] ?? 1;
include "db.php";

$board_id = $_GET['id'] ?? 0;
$board_sql = "SELECT name FROM boards WHERE id = $board_id AND user_id = $user_id";
$board_res = $connect->query($board_sql);


if ($board_res && $board_res->num_rows > 0) {
    $board_row = $board_res->fetch_assoc();
    echo "<h1>" . $board_row['name'] . "</h1>";
} else {
    echo "<h1>No board found !</h1>";
}

$sql = "SELECT posts.image FROM saved_pins JOIN posts ON saved_pins.post_id = posts.id WHERE board_id = $board_id AND user_id = $user_id";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<img src='" . $row['image'] . "' alt='Pin Image'width='200' style='margin:10px'> ";
    }
} else {
    echo "No pins yet";
}
?>
</div>
</body>
</html>
