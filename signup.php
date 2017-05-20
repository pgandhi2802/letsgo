<?php
include "connections.php";
if($_SERVER["REQUEST_METHOD"]=="GET")
{
    if(isset($_GET['user'],$_GET['pass']))
    {
        $fname=$_GET['first_name'];
        $lname=$_GET['last_name'];
        $email=$_GET['email'];
        $contact=$_GET['contact'];
        $user=$_GET['user'];
        $pass=$_GET['pass'];
        $query=mysqli_query($con,"insert into user
            (user,pass,fname,lname,email,contact)
            values
            ('$user','$pass','$fname','$lname','$email','$contact')");
        if($query)
        {
            $query=mysqli_query($con,"select * from user where user= '$user'");
            $row =  mysqli_fetch_array($query);
            if($_GET['pass']==$row['pass'])
            {
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['user_id']=$row['user_id'];
                $_SESSION['user']=$row['user'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            LetsGo!
        </title>
    </head>
    <body>
        <div id="message">
            Your Registration have been Done
        </div>
        <div id="back">
            <a href="home.php">Go To Home</a>
        </div>
    </body>
</html>
<?php
            }
            else
            {
                header('location:index.php');
            }
        }
        else
        {
            header('location:index.php');
        }
    }
    else
    {
        header('location:index.php');
    }
}
else
{
    header("location:index.php");
}
?>