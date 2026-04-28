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
    <a href="saved.php" class="active">Boards</a>
    <a href="profile.php">Profile</a>
</div>

<div class="content">
<?php
session_start();
$user_id=$_SESSION['user_id'] ?? 1;
include "db.php";


$sql = "SELECT * FROM boards WHERE user_id = $user_id";
$result = $connect->query($sql);
?>

<h1>Your Boards</h1>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<a href='board.php?id=" . $row['id'] . "'>" . $row['name'] . "</a><br>";
    }
} else {
    echo "You haven't created any boards yet! Please create one ..!🌸 ";
}
?>
</div>

</body>
</html>
