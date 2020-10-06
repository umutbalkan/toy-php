<?php
    // Database connection
    include('config/db.php');

    // Error & success messages
    global $email_msg, $emptyError1, $success_msg;


    if (isset($_GET['signup'])) {
        echo "sign";
        header("Location: signup.php");
    }

    if (isset($_GET['forgot'])) {
        echo "forgot";
        header("Location: forgot.php");
    }

    if(isset($_POST["submit"])) {
        $email         = $_POST["forgot"];
        if(!empty($email)){
            if(filter_var( $email ,FILTER_VALIDATE_EMAIL)){
            // verify if email exists
            $emailCheck = $connection->query( "SELECT * FROM users WHERE email = '{$email}' ");
            $rowCount = $emailCheck->rowCount();
                if($rowCount == 0) {
                    $email_msg = '
                        <div class="alert alert-danger" role="alert">
                            User with that email does not exist!
                        </div>';
                } else {
                    $success_msg = '
                        <div class="alert alert-success">
                            Email has been sent.
                        </div>';
                }
            } else {
                $email_msg = '
                <div class="alert alert-danger" role="alert">
                    Please enter a valid email adress!
                </div>';
            }
        } else {
            if(empty($email)){
                    $emptyError1 = '
                    <div class="alert alert-danger">
                        Email cannot be empty.
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
</head>

<body>
    <div class="container mt-5" style="max-width: 500px">   
        <form action="" method="post">
            <h3 class="text-center mb-5">Forgot Password</h3>
            <?php echo $email_msg; ?>
            <?php echo $success_msg; ?>

            <div class="form-group">
                    <label>Enter your email:</label>
                    <input type="email" class="form-control" name="forgot" id="forgot" />

                    <?php echo $emptyError1; ?>
            </div>

            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg btn-block">
                Send
            </button>
        </form>
        <br>
        <br>
        <p><a href="signup.php" name="signup"> Sign Up</a> or <a href="login.php" name="login"> Log in</a></p>
        <p></p>
    </div>
</body>

</html>