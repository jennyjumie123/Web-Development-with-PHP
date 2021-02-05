<?php
require_once('includes/connection.php');
include 'includes/sessions.php';

$query = $_GET['patientid'];
$delete = $_GET['delete'];

if (isset($query) && $delete=='true') {
    $sql_query = "DELETE FROM patients WHERE card_id=$query";
    $dbconnect;
    $stmt = $dbconnect->query($sql_query);

    $Execute = $stmt->execute();
    if ($Execute) {
        $_SESSION['SuccessMessage'] = 'Patient records successfully deleted';
        header('Location:patients.php');
    }
}
?>