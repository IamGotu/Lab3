<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: Loginform.php");
    exit();
}

// Check if success message is set and display it
if (isset($_SESSION['success_message'])) {
    echo $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>WELCOME</title>
    <link rel="stylesheet" href="Stylesheet.css">
    <!-- Includes Bootstrap CSS library -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <form method="post" class="mt-5">
            <h2 class="mb-4"><?php echo $_SESSION['username']; ?>, welcome to the website.</h2>
            <!-- Add a logout button -->
            <a href="Logout.php" class="btn btn-primary">Logout</a>
        </form>
    </div>
</body>
</html>
