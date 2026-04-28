<!DOCTYPE html>

<html>
<head>
    <title>Upload Pins</title>
    <link rel="stylesheet" href="style.css">


<style>
    .form-box {
        width: 350px;
        margin: 60px auto;
        text-align: center;
    }

    label {
        display: block;
        margin-top: 10px;
        text-align: left;
    }

    input, textarea {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border-radius: 5px;
        border: none;
        box-sizing: border-box;
    }

    textarea {
        height: 80px;
        resize: none;
    }

    button {
        margin-top: 15px;
    }

    .or {
        margin: 15px 0;
        font-weight: bold;
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

<div class="form-box">


<h2>Upload Pin</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Upload Image:</label>
    <input type="file" name="image">

    <div class="or">OR</div>

    <label>Image URL:</label>
    <input type="text" name="image_url" placeholder="Paste image URL">

    <label>Genre:</label>
    <input type="text" name="genre" placeholder="Enter genre">

    <label>Description:</label>
    <textarea name="description" placeholder="Enter description"></textarea>

    <button type="submit">Upload</button>

</form>


</div>

</body>
</html>

<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    die("Please login first");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $genre = trim($_POST['genre']);
    $desc = trim($_POST['description']);

    if ($genre == "" || $desc == "") {
        echo "Please fill all fields";
        exit;
    }

    //  ensure uploads folder exists
    if (!is_dir("uploads")) {
        mkdir("uploads", 0777, true);
    }

    //  handle image
    if (!empty($_FILES['image']['name'])) {

        $name = time() . "_" . basename($_FILES['image']['name']);
        $tmp = $_FILES['image']['tmp_name'];

        $path = "uploads/" . $name;

        if (!move_uploaded_file($tmp, $path)) {
            echo "Upload failed";
            exit;
        }

    } else {
        $path = trim($_POST['image_url']);

        if ($path == "") {
            echo "Provide image or URL";
            exit;
        }
    }

    //  insert into DB
    $stmt = $conn->prepare("INSERT INTO posts (image, genre, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $path, $genre, $desc);

    if ($stmt->execute()) {
        echo "Uploaded ✨";
    } else {
        echo "Error uploading";
    }
}
?>

</div>
</body>
</html>
