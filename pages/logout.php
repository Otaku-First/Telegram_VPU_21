<?php
/*
Author: Otaku-First
GitHub: https://github.com/Otaku-First
Date: 30.09.20
*/
session_start();
unset($_SESSION['session_email']);
session_destroy();
header("location:login.php");
