<!DOCTYPE html>
<html>
    <head>
    <title>Upload Pins</title>
    </head>
    <body>
    <section id="s1">
         <nav>
        <ul class="nav1">
            <li><a href="home_page.php">HOME</a></li>
            <li><a href="upload.php" class="active">UPLOAD</a></li>
            <li><a href="board.php">BOARDS</a></li>
        </ul>
    </nav>
</section>
<section id="s2">
<form method="POST" enctype="multipart/form-data">

<input type="file" name="image"><br><br>

OR <br><br>

<input type="text" name="image_url" placeholder="Paste image URL"><br><br>

<input type="text" name="genre" placeholder="Enter genre"><br><br>

<textarea name="description" placeholder="Description of your pin" rows="5" column="15"></textarea><br><br>

<button type="submit">Upload</button>

</form>

</section>
    </body>
</html>

<?php
$connect = new mysqli("localhost","root","","mini_pinterest");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $genre = $_POST['genre'];
    $desc = $_POST['description'];

    // check if file uploaded
    if (!empty($_FILES['image']['name'])) {

        $name = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        $path = "uploads/" . $name;

        move_uploaded_file($tmp, $path);

    } 
    else {
        // use URL
        $path = $_POST['image_url'];
    }

    $sql = "INSERT INTO posts (image, genre, description)
            VALUES ('$path', '$genre', '$desc')";

    $connect->query($sql);
     echo "Uploaded ✨"; 

 
}
?>
