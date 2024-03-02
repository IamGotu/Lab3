<!DOCTYPE html>

<html>
    <head>

        <title>Create Account</title>
        <link rel="stylesheet" href="Stylesheet.css">
        <!-- Check if the 'error' parameter is set in the URL and display error message-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    </head>
    <body>  
        <div class="container">
            <!-- Form for user login, submits data to home.php using POST method -->
            <form action="home.php" method="post" class="mt-5">

                <h2 class="mb-4">Create Account</h2>

                <!-- Check if the 'error' parameter is set in the URL and display message-->
                <?php if (isset($_GET['error'])) { ?>
                    <p class="text-danger"><?php echo $_GET['error']; ?></p>
                    <?php } elseif (isset($_GET['message'])) { ?>
                    <p><?php echo htmlspecialchars($_GET['message']); ?></p>
                <?php } ?>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="Lastname" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="First_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Middle Name</label>
                    <input type="text" name="Middle_name" class="form-control">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="Email" class="form-control" required>
                </div>

                <div class="form-group">
                    <input type="hidden" name="Status" class="form-control">
                    <input type="hidden" name="Active" class="form-control">
                </div>

                <div class="form-group">
                    <a href="Loginform.php" class="mr-2">Login Account</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>

        </div>

    </body>

</html>