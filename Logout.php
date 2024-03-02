<?php
session_start();

// include file for database connection
include "db_conn.php";

// Update Active status to "Not Active" for the logged-out user
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $update_sql = "UPDATE user SET Active='Not Active' WHERE username='$username'";
    mysqli_query($conn, $update_sql);
}

// Unset all of the session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: Loginform.php");
exit();
?>
