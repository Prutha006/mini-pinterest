<?php
session_start();
include "db.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
    die("Please login first");
}

$user_id = $_SESSION['user_id'];
// Fetch user
$userQuery = $conn->query("SELECT * FROM users WHERE id=$user_id");

if (!$userQuery || $userQuery->num_rows == 0) {
    die("User not found");
}

$user = $userQuery->fetch_assoc();

// Fetch boards
$boardsQuery = $conn->query("SELECT * FROM boards WHERE user_id=$user_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>

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
        .top {
            text-align: center;
            padding: 30px;
            background: #f5f5f5;
        }

        .profile-pic {
            width: 100px;
            border-radius: 50%;
        }

        .boards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            padding: 20px;
        }

        .board {
            padding: 30px;
            background: #eee;
            border-radius: 15px;
            text-align: center;
            cursor: pointer;
        }

        .create {
            background: #ddd;
            font-weight: bold;
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


<div class="top">
    <img src="<?= $user['profile_pic'] ?>" class="profile-pic">
    <h2><?= $user['username'] ?></h2>
    <p><?= $user['email'] ?></p>
</div>

<div class="boards">

<?php
if ($boardsQuery && $boardsQuery->num_rows > 0) {
    while($b = $boardsQuery->fetch_assoc()) {
        echo "<div class='board'>" . htmlspecialchars($b['name']) . "</div>";
    }
} else {
    echo "<p style='padding:20px;'>No boards yet</p>";
}
?>

<div class="board create" onclick="createBoard()">+ Create Board</div>

</div>

<script>
function createBoard() {
    let name = prompt("Enter board name:");
    if (!name) return;

    fetch("create_board.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "name=" + encodeURIComponent(name)
    })
    .then(res => res.text())
    .then(data => {
        console.log(data); // DEBUG
        location.reload();
    })
    .catch(err => {
        alert("Error creating board");
        console.log(err);
    });
}
</script>

</body>
</html>
