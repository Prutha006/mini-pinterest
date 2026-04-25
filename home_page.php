<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
    </head>

<body>
<section id="s1">
    <nav>
        <ul class="nav1">
            <li><a href="home_page.php" class="active">HOME</a></li>
            <li><a href="upload.php">+</a></li>
            <li><a href="saved.php">BOARDS</a></li>
            <li><a href="profile.php">PROFILE</a></li>
        </ul>
    </nav>
</section>
<section id="s2">
<form method="GET">
    <input type="text" name="query" placeholder="Search pins...">
    <button type="submit">Search</button>
</form>
</section>

<?php
session_start();
$user_id=$_SESSION['user_id'] ?? 1;

include "db.php";

if (isset($_GET['query']) && $_GET['query'] != "") {
    $search = $_GET['query'];

    // Search results
    $sql = "SELECT * FROM posts 
            WHERE genre LIKE '%$search%' 
            OR description LIKE '%$search%'";
} else {
    // Random homepage
    $sql = "SELECT * FROM posts ORDER BY RAND()";
}

$result = $connect->query($sql);
if($result->num_rows>0){
while ($row = $result->fetch_assoc()) {
echo "<a href='view.php?id=" . $row['id'] . "'>
        <img src='" . $row['image'] . "' width='200' alt='Image' style='margin:20px'>
      </a>";
  }
}
else{
    echo "Nothing here yet… try searching something  else 🌸";
}

?>

</body>
</html>
