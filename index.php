<?php
session_start();

// connect database
$connect = new mysqli("localhost", "root", "", "mini_pinterest");

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// if form is submitted
if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // check user
    $sql = "SELECT * FROM users
            WHERE username='$username'
            AND email='$email'
            AND password='$password'";

    $result = $connect->query($sql);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $_SESSION['user_id'] = $user['id'];

        // go to homepage
        header("Location: home_page.php");
        exit();
    } else {
        $error = "Wrong details";
    }
}
?>

<!DOCTYPE html>

<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-box">
    <h2 style="text-align:center;">Login</h2>

<?php if (isset($error)) { echo "<p style='color:red; text-align:center;'>$error</p>"; } ?>

<form method="POST">
    <label>Username:</label>
    <input type="text" name="username" required style="max-width : 279px">

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <button type="submit" name="login">Login</button>
</form>

<p style="text-align:center; margin-top:10px;">
    Not a user? <a href="signup.html" style="color:#f6b17a;">Sign up here</a>
</p>

</div>

</body>
</html>
