<?php include('scripts/register.php'); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Sign Up</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container mt-5" style="max-width: 500px">
        <form action="" method="post">
            <h3 class="text-center mb-5">Sign Up For Free Stuff</h3>

            <?php echo $success_msg; ?>
            <?php echo $email_exist; ?>
            <?php echo $user_exist; ?>


            <div class="form-group">
                <label>Enter Your User Name</label>
                <input type="text" class="form-control" name="username" id="username" />

                <?php echo $emptyError4; ?>
            </div>

            <div class="form-group">
                <label>Enter Your Email</label>
                <input type="email" class="form-control" name="email" id="email" />

                <?php echo $emptyError3; ?>
            </div>

            <div class="form-group">
                <label>Verify Your Email</label>
                <input type="v-email" class="form-control" name="v-email" id="v-email" />

                <?php echo $emptyError6; ?>
                <?php echo $emailError; ?>
            </div>

            <div class="form-group">
                <label>Enter your Full Name</label>
                <input type="v-email" class="form-control" name="fullname" id="fullname" />

                <?php echo $emptyError7; ?>
            </div>


            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password" />

                <?php echo $emptyError5; ?>
            </div>

            <div class="form-group">
                <label>Select your birthday: </label>
                <input type="date" id="birthday" name="birthday" value="2020-01-20" min="1900-01-01">
            </div>
            
            <div class="form-group">
                <label>Select your gender: </label>
                <input type="radio" name="gender" value="FEMALE"> Female
                <input type="radio" name="gender" value="MALE"> Male 
                <input type="radio" name="gender" value="OTHER" checked> Other
            </div>

            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg btn-block">
                Register
            </button>
        </form>
            <br>
            <p> Already have an account? <a href="login.php" name="login">Login</a></p>
    </div>

</body>

</html>