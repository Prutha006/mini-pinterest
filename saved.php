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
    <a href="upload.php">upload</a>
    <a href="saved.php">Saved</a>
    <a href="profile.php">Profile</a>
</div>



<div class="content">
<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    die("Please login first");
}

$user_id = $_SESSION['user_id'];

// ✅ THIS WAS MISSING
$sql = "SELECT * FROM boards WHERE user_id = $user_id";
$result = $conn->query($sql);
?>

<h1>Your Boards</h1>

<?php
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<a href='board.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</a><br>";
    }
} else {
    echo "No boards found";
}
?>
</div>

</body>
</html>
