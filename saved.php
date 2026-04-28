<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    die("Please login first");
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM boards WHERE user_id=$user_id");
?>

<!DOCTYPE html>

<html>
<head>
    <title>Saved</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="navbar">
    <a href="home_page.php">Home</a>
    <a href="upload.php">Upload</a>
    <a href="saved.php">Saved</a>
    <a href="profile.php">Profile</a>
</div>

<h2 style="text-align:center; margin-top:20px;">Your Boards</h2>

<div class="boards">

<?php
if ($result && $result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<div class='board' onclick=\"window.location.href='board.php?id=" . $row['id'] . "'\">
                " . $row['name'] . "
              </div>";
    }

} else {
    echo "<p style='text-align:center;'>No boards yet 🌸</p>";
}
?>

</div>

</body>
</html>
