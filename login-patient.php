<?php
require_once('includes/connection.php');
require_once('includes/functions.php');
include 'includes/sessions.php';

if (isset($_POST['login'])) {
    $user = $_POST['email'];
    $pass = $_POST['password'];

    $LoginAttempt = PatientLoginAttempt($user,$pass);
    if ($LoginAttempt) {
        $_SESSION['card_id'] = $LoginAttempt['card_id'];
        $_SESSION['last_name'] = $LoginAttempt['last_name'];

        $_SESSION['SuccessMessage'] = 'Welcome'.$_SESSION['last_name'];
    }
    else {
        $_SESSION['ErrorMessage'] = 'Incorrect username or password';
    }
}
//add a new columns in patients table - assign_doctor
//add a new columns in patients table - symptoms
//add a new columns in patients table - diagnosis
//add a new columns in patients table - next_app_date
//add a new columns in patients table - bill

//create a page(user.php), design it to show patient details(card ID, last name, first name,assigned doctor,
//logged symptoms, diagnosis,next app date and bill)
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Patients</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <style>
            .login-design{width:100px;margin:0 auto;text-align:center;margin-top:60px;}
            .login-design input[type="email"]{
                background-color: #A9CCE3;
                /* width: 50%; */
                border-radius:4px;
                border: 1px solid #5499C7;
                padding: 15px 40px;
                margin-bottom: 15px;
            }
            .login-design input[type="password"]{
                background-color: #A9CCE3;
                /* width: 50%; */
                border-radius:4px;
                border: 1px solid #5499C7;
                padding: 15px 40px;
                margin-bottom: 15px;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
        <?php 
        echo session_success();
        echo session_error()
        ?>
            <h3 style="text-align:center">Login to your patient account</h3>
            <div class="login-design">
                <form action="login-patient.php" method="POST">
                    <input type="email" name="email" placeholder="email" required><br>
                    <input type="password" name="password" placeholder="password" required><br>
                    <button class="btn btn-success" type="submit" name="login">login</button>
                </form>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>