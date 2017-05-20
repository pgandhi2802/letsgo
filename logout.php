<?php
include 'connections.php';
session_start();
if($_SESSION['loggedin'])
{
    session_destroy();
    $_SESSION['loggedin']=false;
}
header('location:index.php');
?>
