

<!DOCTYPE html>
<html>
    <head>
        <title>Email Verification</title>
        <link rel="stylesheet" href="Stylesheet.css">
        <!-- Check if the 'error' parameter is set in the URL and display error message-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <form action="verification_process.php" method="post" class="mt-5">

                <h2 class="mb-4">Email Verification</h2>
    
                <?php
                    if (isset($_GET['error'])) {
                        echo htmlspecialchars($_GET['error']);
                    }
                ?>

                <div class="form-group">
                    <p>Please enter the verification code sent to your email:</p>
                </div>

                <div class="form-group">
                    <input type="text" name="verification_code" class="form-control" placeholder="Verification Code" required>
                    <input type="hidden" name="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>">
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Verify</button>
                </div>
            </form>
        </div>
    </body>
</html>

<?php include('footer.php') ?>