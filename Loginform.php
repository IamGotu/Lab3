<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" href="Stylesheet.css">
    <!-- includes Bootstrap CSS library-->  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        
        <!-- Form for user login, submits data to LoginCode.php using POST method -->
        <form action="LoginCode.php" method="post" class="mt-5">

            <h2 class="mb-4">LOGIN</h2>

            <?php
                if (isset($_GET['success'])) {
                    // Display the success message
                    echo htmlspecialchars($_GET['success']);
                }
            ?>

            <!-- Check if the 'error' parameter is set in the URL and display error message-->
            <?php if (isset($_GET['error'])) { ?>
                <p class="text-danger"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <div class="form-group">
                <label>User Name</label>
                <input type="text" name="username" class="form-control" placeholder="User Name" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="form-group">
                <a href="CreateAccount.php" class="mr-2">Create Account</a>
                <button type="submit" class="btn btn-primary">Login</button>
            </div>

        </form>

    </div>

</body>
</html>
