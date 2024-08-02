<?php
session_start();
unset($_SESSION['Loggedin']);
header("Location: index.html");
?>