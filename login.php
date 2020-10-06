<?php
// Database connection
include('config/db.php');
// Error & Success msgs
global $credentialError, $passwordError, $success_msg;
global $username;

if (isset($_GET['signup'])) {
    echo "sign";
    header("Location: signup.php");
}

if (isset($_GET['forgot'])) {
    echo "forgot";
    header("Location: forgot.php");
}

if (isset($_POST["submit"])) {
    $username = $credential;
    $credential  = $_POST["userlogin"];
    $password   = $_POST["password"];
    $remember   = $_POST["remember"];

    // PHP validation
    if (!empty($credential) && !empty($password)) {

        // credential checks
        if (filter_var($credential, FILTER_VALIDATE_EMAIL)) {  // check "email" for login

            // verify if email exists
            $emailCheck = $connection->query("SELECT * FROM users WHERE email = '{$credential}' ");
            $rowCount = $emailCheck->rowCount();
            if ($rowCount == 0) {
                $credentialError = '
                        <div class="alert alert-danger" role="alert">
                            User with that email does not exist!
                        </div>
                    ';
                    
            } else { // user exists (email)

                // fetch hashed password from DB
                $fetch_password = $connection->query("SELECT password FROM users WHERE email = '{$credential}' ");
                $hashed_password = $fetch_password->fetchColumn();

                // Password verify (plaintext - [salted] hashed)
                $password_verify = password_verify($password, $hashed_password);

                if ($password_verify) {
                    header('Location: /welcome.php');
                    $success_msg = '<div class="alert alert-success">
                        User logged-in successfully!
                        </div>';
                } else {
                    $passwordError = '
                        <div class="alert alert-danger" role="alert">
                            User password is wrong!
                        </div>
                    ';
                }
            }
        } else { // check "username" for login
            // verify if username exists
            $userCheck = $connection->query("SELECT * FROM users WHERE username = '{$credential}' ");
            $rowCount = $userCheck->rowCount();
            if ($rowCount == 0) {
                $credentialError = '
                        <div class="alert alert-danger" role="alert">
                            User with that username does not exist!
                        </div>
                    ';
            } else { // user exists

                // fetch hashed password from DB
                $fetch_password = $connection->query("SELECT password FROM users WHERE username = '{$credential}' ");
                $hashed_password = $fetch_password->fetchColumn();

                // Password verify (plaintext v [salted] hash)
                $password_verify = password_verify($password, $hashed_password);

                if ($password_verify) {
                    header('Location: /welcome.php');
                    $success_msg = '<div class="alert alert-success">
                        User logged-in successfully!
                        </div>';
                } else { // password is wrong (username)
                    $passwordError = '
                        <div class="alert alert-danger" role="alert">
                            User password is wrong!
                        </div>
                    ';
                }
            }
        }
    } else {
        if (empty($credential)) {
            $emptyError1 = '<div class="alert alert-danger">
                    Email or username cannot be empty.
                </div>';
        }
        if (empty($password)) {
            $emptyError2 = '<div class="alert alert-danger">
                    Password field cannot be empty.
                </div>';
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Login</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        if(!document.getElementById("userlogin") || !document.getElementById("password")  ){
            document.getElementById("submit").disabled = true;
        }else{
            document.getElementById("submit").disabled = false;
        }
    </script>
</head>

<body>
    <div class="container mt-5" style="max-width: 500px">
        <form action="" method="post">
            <h3 class="text-center mb-5">Login to your Account</h3>
            <?php echo $success_msg; ?>
            <?php echo $credentialError; ?>
            <?php echo $passwordError; ?>


            <div class="form-group">
                <label>Enter your username or email:</label>
                <input type="text" class="form-control" name="userlogin" id="userlogin" />

                <?php echo $emptyError1; ?>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password" />

                <?php echo $emptyError2; ?>
            </div>


            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg btn-block">
                Login
            </button>
        </form>

        <br>
        <p><a href="forgot.php" name="forgot">Forgot your password?</a></p>

        <br>
        <p>Do not have an account?<a href="signup.php" name="signup"> Sign Up</a></p>
    </div>
</body>

</html>