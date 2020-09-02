<?php
session_start();
unset($_SESSION['session_email']);
session_destroy();
header("location:login.php");
?>