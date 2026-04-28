<?php
session_start();
$user_id = $_SESSION['user_id'] ?? 1;

$connect = new mysqli("localhost","root","","mini_pinterest");

$post_id = $_GET['id'];

$sql = "SELECT * FROM posts WHERE id=$post_id";
$result = $connect->query($sql);
$row = $result->fetch_assoc();

$board = $connect->query("SELECT * FROM boards WHERE user_id=$user_id");

if(isset($_POST['board'])){
    $board_id = $_POST['board'];

    $check = "SELECT * FROM saved_pins
              WHERE post_id=$post_id
              AND board_id=$board_id
              AND user_id=$user_id";

    $res = $connect->query($check);

    if($res->num_rows > 0){
        $msg = "Already saved 😄";
    } else {
        $insert = "INSERT INTO saved_pins(post_id,board_id,user_id)
                   VALUES($post_id,$board_id,$user_id)";
        $connect->query($insert);
        $msg = "Saved to board ⭐";
    }
}
?>

<!DOCTYPE html>

<html>
<head>
    <title>View</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="navbar">
    <a href="home_page.php">Home</a>
    <a href="upload.php">Upload</a>
    <a href="saved.php">Saved</a>
    <a href="profile.php">Profile</a>
</div>

<div class="form-box" style="text-align:center; width:350px;">


<?php if(isset($msg)) echo "<p>$msg</p>"; ?>

<form method="post">

    <!-- SAVE DROPDOWN -->
    <select name="board" onchange="this.form.submit()"
            style="width:100%; padding:10px; margin-bottom:15px; border-radius:5px;">

        <option selected>Save to board</option>

        <?php while($b = $board->fetch_assoc()){ ?>
            <option value="<?php echo $b['id']; ?>">
                <?php echo $b['name']; ?>
            </option>
        <?php } ?>

    </select>

    <!-- IMAGE -->
    <img src="<?php echo $row['image']; ?>"
         style="width:100%; border-radius:10px; margin-bottom:10px;">

    <!-- DESCRIPTION -->
    <p><?php echo $row['description']; ?></p>

</form>


</div>

</body>
</html>
