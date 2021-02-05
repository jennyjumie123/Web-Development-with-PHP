<?php
require_once('includes/connection.php');
include 'includes/sessions.php';

/* Date configuration -- starts-- */
date_default_timezone_set('Africa/Lagos');
$Date = date('l, d M Y');
/* Date configuration -- starts-- */

// where dept = Dentist, limit 1

if (isset($_POST['register'])) {//process only if the 'register' button was clicked
    if ($_POST['fname']==null || $_POST['lname']==null) {
        $_SESSION['ErrorMessage'] = 'First name and last name are required';
    }//for fname and lname empty check
    elseif($_POST['email']==null || $_POST['pass1']==null){
        $_SESSION['ErrorMessage'] = 'Email and password are required';
    }//for email and password empty check
    elseif(strlen($_POST['pass1'])<8 || $_POST['pass_confirm']!=$_POST['pass1']){
        $_SESSION['ErrorMessage'] = 'Password must be up to 8 characters and must match';
    }//for checking correctness of password
    else {
        $Fname = $_POST['fname'];
        $Lname = $_POST['lname'];
        $Email = $_POST['email'];
        $Password = password_hash($_POST['pass1'],PASSWORD_DEFAULT);
        $Phone = $_POST['phone'];
        $Address = $_POST['address'];
        $Department = $_POST['department'];
        $Symptom = $_POST['symptom'];
        $Details = $_POST['details'];
        

        $dbconnect;//establish connection to db
        $sql = "INSERT INTO patients (first_name,last_name,email,phone,address,password,date_registered)";
        $sql .= "VALUES(:fnamE,:lnamE,:emaiL,:phonE,:addresS,:pasS,:datE)";
        $stmt = $dbconnect->prepare($sql);//creates the prepare object - for insertion
        $stmt->bindValue(':fnamE',$Fname);
        $stmt->bindValue(':lnamE',$Lname);
        $stmt->bindValue(':emaiL',$Email);
        $stmt->bindValue(':phonE',$Phone);
        $stmt->bindValue(':addresS',$Address);
        $stmt->bindValue(':pasS',$Password);
        $stmt->bindValue(':datE',$Date);
        $stmt->bindValue(':assignedD',$AssignedDoctor);
        
        $Execute = $stmt->execute();
        if ($Execute) {
            $_SESSION['SuccessMessage'] = 'Registration successful';
        }
    }//block for inserting to db
}//for 'register' button
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Patients Registration</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php include 'includes/nav.php'; ?>
        <div class="container"><!-- for responsive layout --->
            <?php
             echo session_error();
             echo session_success();
            ?>
            <!-- registration form starts --->
            <div class="jumbotron">
                <h3>New patients registration</h3>
                <form action="registration.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="fname" class="form-control" placeholder="First name">
                    </div>
                    <div class="form-group">
                        <input type="text" name="lname" class="form-control" placeholder="Last name">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Valid email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass1" class="form-control" placeholder="Create password">
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass_confirm" class="form-control" placeholder="Confirm password">
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" class="form-control" placeholder="Phone number">
                    </div>
                    <div class="form-group">
                        <label for="address">Residential address</label>
                        <textarea name="address" class="form-control" id="address" rows="3"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <select name="department" class="form-control">
                                <option>Select the kind of doctor</option>
                                <option>Psychiatrist</option>
                                <option>Dentist</option>
                                <option>Optician</option>
                                <option>Surgeon</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <select name="symptom" class="form-control">
                                <option>Most common symptom</option>
                                <option>Pain</option>
                                <option>Sleeplessness</option>
                                <option>High temperature</option>
                                <option>Loss of appetite</option>
                                <option>Difficulty in breathing</option>
                                <option>I can't explain</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Please provide full details of your case</label>
                        <textarea name="details" class="form-control" id="address" rows="3"></textarea>
                    </div>    
                </div>
                    <button name="register" class="btn btn-warning btn-block">Submit registration</button>
                </form>
            </div>
            <!-- registration form starts --->

        </div><!-- parent container --->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>