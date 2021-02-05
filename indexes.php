<?php 
session_start();
$uname= 'Geekyshow1';
$_SESSION['username']= $uname;
$_SESSION['password']= '123456';
echo $_SESSION['username'].'<br>';
echo $_SESSION['password'].'<br>';

unset($_SESSION['username']);
?>