<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoloader
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Include file for database connection
include "db_conn.php";

// Check if the request method is POST
if (
    isset($_POST['username']) && isset($_POST['password']) && isset($_POST['Lastname']) && isset($_POST['First_name'])
    && isset($_POST['Middle_name']) && isset($_POST['Email']) && isset($_POST['Status']) && isset($_POST['Active'])
) {

    // Function to sanitize and validate input data
    function validate($data)
    {
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

    // Set default values for Status and Active
    $Status = 'Not Verified';
    $Active = 'Not Active';

    // Validate email format
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        header("Location: CreateAccount.php?error=Invalid email format");
        exit();
    }

    // Check if the email already exists in the database
    $sql_check_email = "SELECT * FROM user WHERE Email='$Email'";
    $result_check_email = mysqli_query($conn, $sql_check_email);
    if (mysqli_num_rows($result_check_email) > 0) {
        header("Location: CreateAccount.php?error=Email already exists");
        exit();
    }

    // Check if the username already exists in the database
    $sql_check_username = "SELECT * FROM user WHERE username='$username'";
    $result_check_username = mysqli_query($conn, $sql_check_username);
    if (mysqli_num_rows($result_check_username) > 0) {
        header("Location: CreateAccount.php?error=Username already exists");
        exit();
    }

    // Generate a unique verification token
    $verify_token = bin2hex(random_bytes(16));

    // SQL query to insert user data into the database with verification token
    $sql = "INSERT INTO user (username, password, Lastname, First_name, Middle_name, Email, Status, Active, verify_token)
            VALUES ('$username', '$password', '$Lastname', '$First_name', '$Middle_name', '$Email', '$Status', '$Active', '$verify_token')";

    if (mysqli_query($conn, $sql)) {
        
        // Send verification email
        $subject = "Email Verification";
        $message = "Hello, $username. Your verification code is: $verify_token";

        // Create a PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'cocnambawan@gmail.com'; // Your gmail
            $mail->Password = 'bkvm sirf keww nswm'; // Your gmail app password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Sender and recipient
            $mail->setFrom('cocnambawan@gmail.com', 'Email Verification');
            $mail->addAddress($Email);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;

            // Send email
            $mail->send();

            // Redirect with a success message
            header("Location: VerifyEmail.php?email=$Email");
            exit();
        } catch (Exception $e) {
            // Display an error message if the verification email could not be sent
            header("Location: CreateAccount.php?error=Verification email could not be sent. Please try again later.");
            exit();
        }
    } else {
        // Display an error message if the query fails
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
