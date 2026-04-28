<?php
session_start();
session_abort();
header("location:signup.html");
exit();
?>
