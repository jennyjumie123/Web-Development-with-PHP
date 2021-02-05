<?php
require_once('includes/connection.php');
include 'includes/sessions.php';

if (isset($_GET['patientid'])) {
    $query = $_GET['patientid'];
    $_SESSION['key'] = $query;
}
$key = $_SESSION['key'];

if (isset($_POST['update'])) {
    $Lname = $_POST['lname'];
    $Fname = $_POST['fname'];
    $Email = $_POST['email'];
    $Phone = $_POST['phone'];
    $Address = $_POST['address'];

    $update = "UPDATE patients SET first_name='$Fname',last_name='$Lname',email='$Email',phone='$Phone',
    address='$Address',password=password,date_registered=date_registered WHERE card_id=$key";
    $dbconnect;
    $Ex = $dbconnect->query($update);
    
    if($Ex) {
        $_SESSION['SuccessMessage'] = 'Patients records successfully updated';
        header('Location:patients.php');
    }
    else {
        var_dump($Ex);
        // $_SESSION['ErrorMessage'] = 'Update failed';
        // header("Location:update-patient.php");
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Patients Update</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php include 'includes/nav.php'; ?>

        <div class="container">
            <?php
                echo session_error();
                echo session_success();
            ?>
            <div class="jumbotron" style="margin-top:60px">

                <?php 
                /////////RETREIVE PATIENTS RECORDS FRO DB/////////
                $sql_query = "SELECT * FROM patients WHERE card_id=$query";
                $dbconnect;
                $stmt = $dbconnect->query($sql_query);
                $DataRow = $stmt->fetch();
                $CardId = $DataRow['card_id'];
                $FirstName = $DataRow['first_name'];
                $LastName = $DataRow['last_name'];
                $Email = $DataRow['email'];
                $Phone = $DataRow['phone'];
                $Pass = $DataRow['password'];
                $Dreg = $DataRow['date_registered'];
                $Address = $DataRow['address'];
                ?>      

                <form action="update-patient.php" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo "Card ID: ".$CardId; ?>" readonly>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <input type="text" name="lname" class="form-control" value="<?php echo $LastName; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="fname" class="form-control"  value="<?php echo $FirstName; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <input type="email" name="email" class="form-control" value="<?php echo $Email; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="phone" class="form-control" value="<?php echo $Phone; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <input type="text" name="address" class="form-control" value="<?php echo $Address; ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning btn-lg btn-block" name="update">
                    Update records
                    </button>
                </form>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>