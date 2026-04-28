<!DOCTYPE html>

<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css">


<style>
    /* SEARCH */
    .search-box {
        text-align: center;
        margin: 30px 0 10px;
    }

    .search-box form {
        display: inline-flex;
        gap: 10px;
    }

    .search-box input {
        width: 260px;
        padding: 10px;
        border-radius: 6px;
        border: none;
    }

    .search-box button {
        padding: 10px 16px;
        border-radius: 6px;
        border: none;
        background: #f6b17a;
        cursor: pointer;
    }

    /* SEPARATOR */
    .divider {
        width: 80%;
        height: 1px;
        background: #424769;
        margin: 20px auto;
    }

    /* GRID */
    .pin-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, 200px);
        justify-content: center;
        gap: 25px;
        padding: 20px;
    }

    /* CARD */
    .pin {
        background: #424769;
        border-radius: 14px;
        padding: 10px;
        transition: 0.3s;
    }

    .pin:hover {
        transform: translateY(-5px);
    }

    /* IMAGE */
    .pin img {
        width: 100%;
        border-radius: 10px;
        display: block;
    }
</style>

</head>

<body>

<div class="navbar">
    <a href="home_page.php">Home</a>
    <a href="upload.php">Upload</a>
    <a href="saved.php">Saved</a>
    <a href="profile.php">Profile</a>
</div>

<!-- SEARCH -->

<div class="search-box">
    <form method="GET">
        <input type="text" name="query" placeholder="Search pins...">
        <button type="submit">Search</button>
    </form>
</div>

<div class="divider"></div>

<!-- PINS -->

<div class="pin-container">

<?php
session_start();
$user_id = $_SESSION['user_id'] ?? 1;

include "db.php";

// Search or random
if (isset($_GET['query']) && $_GET['query'] != "") {
    $search = $_GET['query'];

    $sql = "SELECT * FROM posts
            WHERE genre LIKE '%$search%'
            OR description LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM posts ORDER BY RAND()";
}

// SAME LOGIC
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        echo "<div class='pin'>
                <a href='view.php?id=" . $row['id'] . "'>
                    <img src='" . $row['image'] . "' alt='Image'>
                </a>
              </div>";
    }
} else {
    echo "<p style='text-align:center;'>Nothing here yet 🌸</p>";
}
?>

</div>

</body>
</html>
