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
    <a href="index.php">Home</a>
    <a href="search.php">Search</a>
    <a href="saved.php">Saved</a>
    <a href="profile.php">Profile</a>
</div>

<div class="content">
<?php
include "db.php";

$board_id = $_GET['id'];

echo "<h1>Board ID: " . $board_id . "</h1>";

$sql = "SELECT * FROM saved_pins WHERE board_id = $board_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>Pin ID: " . $row['pin_id'] . "</p>";
    }
} else {
    echo "No pins yet";
}
?>
</div>
</body>
</html>