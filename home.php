<?php

session_start();

// include file for database connection
include "db_conn.php";

// Check if the request method is POST
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['Lastname']) && isset($_POST['First_name'])
    && isset($_POST['Middle_name']) && isset($_POST['Email']) && isset($_POST['Status']) && isset($_POST['Active'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Sanitize input data obtained from the POST request
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $Lastname = validate($_POST['Lastname']);
    $First_name = validate($_POST['First_name']);
    $Middle_name = validate($_POST['Middle_name']);
    $Email = validate($_POST['Email']);
    $Status = validate($_POST['Status']);
    $Active = validate($_POST['Active']);

    // Validate email format
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        header("Location: Account_Info.php?error=Invalid email format") ;
        exit();
    }

    // Check if username already exists in the database (NOT WORKING)
    $username_check_query = "SELECT * FROM user WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $username_check_query);
    $user = mysqli_fetch_assoc($result);

    // Check if email already exists in the database
    $email_check_query = "SELECT * FROM user WHERE Email='$Email' LIMIT 1";
    $result = mysqli_query($conn, $email_check_query);
    $user = mysqli_fetch_assoc($result);

    // If email already exists
    if ($user) {
        header("Location: Account_Info.php?error=Email already exists");
        exit();
    }

    // SQL query to insert user data into the database
    $sql = "INSERT INTO user (username, password, Lastname, First_name, Middle_name, Email, Status, Active)
            VALUES ('$username', '$password', '$Lastname', '$First_name', '$Middle_name', '$Email', '$Status', '$Active')";
        
    if (mysqli_query($conn, $sql)) {
        // Redirect with a success message
        header("Location: Account_Info.php?message=Account%20info%20submitted%20successfully!");
    } else {
        // Display an error message if the query fails
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

        mysqli_close($conn);
    }
?>