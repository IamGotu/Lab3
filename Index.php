<?php
session_start();

// include file for database connection
include "db_conn.php";

// Check if user is not logged in, redirect to login page
if (isset($_SESSION['success_message'])) {
    header("Location: welcome.php");
    exit();
}

// check if the both username are set in the POST
if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // sanitize both username and password from POST request
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    // check if username or password is empty
    if (empty($username)) {
        header("Location: Loginform.php?error=User Name are required");
        exit();
    } else if (empty($password)) {
        header("Location: Loginform.php?error=Password are required");
        exit();    
    } else {
        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            // Fetch user data
            $row = mysqli_fetch_assoc($result);

            // storing in session variable
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['success_message'] = "Logged in!";
            header("Location: welcome.php");
            exit();
        } else {
            header("Location: Loginform.php?error=Incorrect User name or password");
            exit();
        }
    }
} else {
    header("Location: Loginform.php");
    exit();
}
?>
