<?php
session_start();
include "db.php";

// check board id
if (!isset($_GET['id'])) {
    echo "No board selected";
    exit();
}

$board_id = intval($_GET['id']); // safe

?>

<!DOCTYPE html>

<html>
<head>
    <title>Board</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="navbar">
    <a href="home_page.php">Home</a>
    <a href="upload.php">Upload</a>
    <a href="saved.php">Saved</a>
    <a href="profile.php">Profile</a>
</div>

<h2 style="text-align:center; margin-top:20px;">Board</h2>

<div class="pin-container">

<?php
// get posts of this board
$sql = "SELECT * FROM posts WHERE board_id = $board_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo "<div class='pin'>
                <img src='" . $row['image'] . "' alt='image'>
              </div>";
    }

} else {
    echo "<p style='text-align:center;'>No images in this board 🌸</p>";
}
?>

</div>

</body>
</html>
