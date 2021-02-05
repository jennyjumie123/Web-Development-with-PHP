<?php
require_once('includes/connection.php');
include 'includes/sessions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Patients</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php include 'includes/nav.php'; ?>
        <?php 
        echo session_success();
        echo session_error()
        ?>
        
        <h3>Registered Patients</h3>
        <form class="form-inline my-2 my-lg-0" action="patients.php" method="GET">
            <input class="form-control mr-sm-2" type="text" name="query" placeholder="Card or phone number">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">
            Search
            </button>
        </form>
        <?php
            //search --- begins here
            if (isset($_GET['search'])) {
                $search_query = $_GET['query']; 

                $dbconnect;
                $sql_search = "SELECT * FROM patients WHERE card_id=:iD OR phone=:phonE";
                $stmt = $dbconnect->prepare($sql_search);
                $stmt->bindvalue(':iD',$search_query);
                $stmt->bindvalue(':phonE',$search_query);
                $stmt->execute();

                while ($DataRows = $stmt->fetch()) {
                    $CardId = $DataRows['card_id'];
                    $FirstName = $DataRows['first_name'];
                    $LastName = $DataRows['last_name'];
                    $Email = $DataRows['email'];
                    $Phone = $DataRows['phone'];
                    $Address = $DataRows['address'];
                    $DateRegistered = $DataRows['date_registered']; 
            ?>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Card number</th>
                        <th scope="col">First name</th>
                        <th scope="col">Last name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Date registered</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td><?php echo $CardId;?></td>
                        <td><?php echo $FirstName;?></td>
                        <td><?php echo $LastName;?></td>
                        <td><?php echo $Email;?></td>
                        <td><?php echo $Phone;?></td>
                        <td><?php echo $Address;?></td>
                        <td><?php echo $DateRegistered;?></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <!-- Search code ends here -->

        <table class="table table-responsive">
        <thead>
            <tr>
                <th scope="col">Card number</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Date registered</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql_query = "SELECT * FROM patients ORDER BY card_id DESC LIMIT 1,3";
            $dbconnect;
            $stmt = $dbconnect->query($sql_query);

            while($DataRow = $stmt->fetch()) {
                $CardId = $DataRow['card_id'];
                $FirstName = $DataRow['first_name'];
                $LastName = $DataRow['last_name'];
                $Email = $DataRow['email'];
                $Phone = $DataRow['phone'];
                $Address = $DataRow['address'];
                $DateRegistered = $DataRow['date_registered'];
        ?>      
            <tr>
                <td><?php echo $CardId;?></td>
                <td><?php echo $FirstName;?></td>
                <td><?php echo $LastName;?></td>
                <td><?php echo $Email;?></td>
                <td><?php echo $Phone;?></td>
                <td><?php echo $Address;?></td>
                <td><?php echo $DateRegistered;?></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" 
                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" 
                        aria-expanded="false">
                            ..
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <!-- Button trigger modal -->
                            <a class="dropdown-item" href="#" data-toggle="modal" 
                            data-target="#deleteModal<?php echo $CardId; ?>">Delete
                            </a>
                            <a class="dropdown-item" href="update-patient.php?patientid=<?php echo $CardId;?>">Update</a>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal<?php echo $CardId; ?>" tabindex="-1" role="dialog" 
                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete patient</h5>
                                    <button type="button" class="close" data-dismiss="modal" 
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <a type="button" class="btn btn-danger" 
                                    href="delete-patients.php?patientid=<?php echo $CardId;?>&delete=true">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- Modal //end -->
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>