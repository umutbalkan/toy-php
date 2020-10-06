<?php
    // Database connection
    include('config/db.php');

    

    // Error & success messages
    global  $email_exist2, $success_msg, $email_exist, $user_exist,  $emptyError6,$emptyError1, $emptyError2, $emptyError3, $emptyError4, $emptyError5,$emptyError7;
    
    if(isset($_POST["submit"])) {
        $email         = $_POST["email"];
        $vemail        = $_POST["v-email"];
        $username      = $_POST["username"];
        $password      = $_POST["password"];
        $gender        = $_POST["gender"];
        $birthday      = $_POST["birthday"];
        $fullname      = $_POST["fullname"];

        if(filter_var( $email ,FILTER_VALIDATE_EMAIL)){
            // verify if email exists
            $emailCheck = $connection->query( "SELECT * FROM users WHERE email = '{$email}' ");
            $rowCount = $emailCheck->rowCount();

            // verify if username exists
            $userCheck = $connection->query( "SELECT * FROM users WHERE username = '{$username}' ");
            $rowCount_1 = $userCheck->rowCount();

            echo $rowCount;
            echo $rowCount_1;
            
            if($rowCount != 0) { // check if user email already exist
                $email_exist2 = '
                    <div class="alert alert-danger" role="alert">
                        User with that email already exist!
                    </div>
                ';
            }if ($rowCount_1 != 0){  // check if username already exist
                $user_exist = '
                    <div class="alert alert-danger" role="alert">
                        User with that username already exist!
                    </div>';
            }else{
                // PHP validation
            if(!empty($email) && !empty($username) && !empty($password) && !empty($vemail) && !empty($fullname)){
                
                // check if emails are matching
                if(strcmp($email,$vemail) != 0){ // strcomp returns 0 when equal
                    $email_exist = '
                    <div class="alert alert-danger">
                        Emails do not match!
                    </div>
                ';
                } else {
                // Password hash
                $password_hash = password_hash($password, PASSWORD_BCRYPT);

                $sql = $connection->query("INSERT INTO users (username, password, email, fullname, gender, birthday) 
                VALUES ('{$username}', '{$password_hash}', '{$email}', '{$fullname}',  '{$gender}', '{$birthday}')");
                
                    if(!$sql){
                        die("MySQL query failed!" . mysqli_error($connection));
                    } else {
                        $success_msg = '<div class="alert alert-success">
                            User registered successfully!
                        </div>';
                    }
                }
            } else {
                if(empty($email)){
                    $emptyError3 = '<div class="alert alert-danger">
                        Email is required.
                    </div>';
                }
                if(empty($username)){
                    $emptyError4 = '<div class="alert alert-danger">
                        Username is required.
                    </div>';
                }
                if(empty($fullname)){
                    $emptyError7 = '<div class="alert alert-danger">
                        Full Name is required.
                    </div>';
                }
                if(empty($password)){
                    $emptyError5 = '<div class="alert alert-danger">
                        Password is required.
                    </div>';
                }   
                if(empty($vemail)){
                    $emptyError6 = '<div class="alert alert-danger">
                        Email needs to be re-typed.
                    </div>';
                }         
            }
            }
        }else {
        $email_exist = '<div class="alert alert-danger" role="alert">
                            Please enter a valid email!
                        </div>';
        }
    }
?>