<?php
// Database connection
include('config/db.php');

global $fullname, $username1, $fever, $cough, $pain, $tired;
$username1 = $username;
$myquery = $connection->query("SELECT * FROM users WHERE username = '{$username1}' ");
foreach ($myquery as $row) {
    $fullname = $row['fullname'];
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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
</head>

<body>
    <div class="container mt-5" style="max-width: 500px">
        <h3 class="text-center mb-5">Welcome, Hello <?php echo $fullname ?></h3>
        <hr>
        <div class="alert alert-danger" style = "display:none" id="errmsg">
            Symptomps not looking good.
        </div>
        <div class="alert alert-success" style = "display:none" id="confmsg">
            It's great!
        </div>
        <div class="alert alert-warning" style = "display:block" id="dispmsg">
            Please fill-up your symptomps.
        </div>
        <br>
        <div class="form-group">
            <h4>What are your symptomps for today?</h4>
        </div>

        <br>
        <br>
        <div class="form-group">
            <span>&nbsp&nbsp&nbsp&nbsp&nbsp</span>
            <input class="form-check-input" type="checkbox" value="1" id="cough">
            <label class="form-check-label" for="defaultCheck1">
                &nbsp<i class="fas fa-notes-medical fa-lg"></i>&nbsp&nbspDry Cough
            </label>
        </div>
        <br>
        <div class="form-group">
            <span>&nbsp&nbsp&nbsp&nbsp&nbsp</span>
            <input class="form-check-input" type="checkbox" value="1" id="tired">
            <label class="form-check-label" for="defaultCheck1">
                <i class="fas fa-bed fa-lg"></i>&nbspTiredness
            </label>
        </div>
        <br>
        <div class="form-group">
            <span>&nbsp&nbsp&nbsp&nbsp&nbsp</span>
            <input class="form-check-input" type="checkbox" value="1" id="pain">
            <label class="form-check-label" for="defaultCheck1">
                <i class="fas fa-pills fa-lg"></i>&nbspPain
            </label>
        </div>
        <br>
        <div class="form-group">
            <span>&nbsp&nbsp&nbsp&nbsp&nbsp</span>
            <input class="form-check-input" type="checkbox" value="1" id="fever">
            <label><i class="fas fa-temperature-high fa-lg"></i>&nbspFever</label>
        </div>
        <br>
        <button type="submit" name="submit1" id="submit1" class="btn btn-primary btn-lg btn-block">
            Submit
        </button>
        <br>
        <br>
        <p><a href="login.php" name="logout">Logout</a></p>
    </div>
    <script>
        document.getElementById("submit1").addEventListener("click", () => {
            var fevercheck = document.getElementById("fever");
            var paincheck = document.getElementById("pain");
            var tiredcheck = document.getElementById("tired");
            var coughcheck = document.getElementById("cough");
            console.log("pressed");
            if (fevercheck.checked == true || paincheck.checked == true || tiredcheck.checked == true || coughcheck.checked == true) {
                console.log("bad");
                document.getElementById("errmsg").style.display = "block";
                document.getElementById("dispmsg").style.display = "none";
                document.getElementById("confmsg").style.display = "none";

            } else {
                document.getElementById("errmsg").style.display = "none";
                document.getElementById("dispmsg").style.display = "none";
                document.getElementById("confmsg").style.display = "block";
            }
        });
    </script>

</body>

</html>