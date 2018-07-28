<?php

// This page updates the user password
require("includes/common.php");
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

$old_pass1 = $_POST['old-password'];
$old_pass2 = mysqli_real_escape_string($con, $old_pass1);
$old_pass = MD5($old_pass);

$new_pass1 = $_POST['password'];
$new_pass2 = mysqli_real_escape_string($con, $new_pass1);
$new_pass = MD5($new_pass);

$new_pass3 = $_POST['password1'];
$new_pass4 = mysqli_real_escape_string($con, $new_pass3);
$new_pass5 = MD5($new_pass4);

$query = "SELECT email, password FROM users WHERE email ='" . $_SESSION['email'] . "'";
$result = mysqli_query($con, $query)or die($mysqli_error($con));
$row = mysqli_fetch_array($result);
$orig_pass = $row['password'];

if ($new_pass != $new_pass1) {
    header('location: settings.php?error=The two passwords don\'t match');
} else {
    if ($old_pass == $orig_pass) {
        $query = "UPDATE  users SET password = '" . $new_pass . "' WHERE email = '" . $_SESSION['email'] . "'";
        mysqli_query($con, $query) or die($mysqli_error($con));
        header('location: settings.php?error=Password Updated');
    } else
    {
        header('location: settings.php');
}
}
?>