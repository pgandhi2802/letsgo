<?php
include 'connections.php';
if($_SERVER["REQUEST_METHOD"]=="GET")
{
    if(!isset($_GET['user'],$_GET['pass']))
    {
        header('location.index.php');
    }
    else
    {
        $user=$_GET['user'];
        $pass=$_GET['pass'];
        $query=mysqli_query($con,"select * from user where user= '$user'");
        $row =  mysqli_fetch_array($query);
        if($_GET['pass']==$row['pass'])
        {
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['user_id']=$row['user_id'];
            $_SESSION['user']=$row['user'];
            header('location:home.php');
        }
        else
        {
            header('location:index.php');
        }
    }
}   
else
{
    header('location:index.php');
}
?>
