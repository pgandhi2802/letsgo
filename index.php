<?php
include 'connections.php';
session_start();
if(!isset($_SESSION['loggedin']))
{
    $errfname=$errlname=$erremail=$errcontact=$erruser=$errpass=$errconpass=$log_user=$log_pass="";
    $check=0;
    if(isset($_POST['sign_up']))
    {
        if(!empty($_POST['first_name']))
        {
            $fname =$_POST["first_name"];
            if(!preg_match("/^[a-zA-Z ]*$/",$fname))
            {
                $errfname = "Only letters allowed"; 
                $check=1;
            }
        }
        else
        {
            $errfname = "Required Field"; 
            $check=1;
        }
        if(!empty($_POST['last_name']))
        {
            $lname =$_POST["last_name"];
            if(!preg_match("/^[a-zA-Z ]*$/",$lname))
            {
                $errlname = "Only letters allowed"; 
                $check=1;
            }
        }
        else
        {
            $errlname = "Required Field"; 
            $check=1;
        }
        
       if(!empty($_POST['email']))
       {
            $email =$_POST["email"];
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
            {
                $erremail = "Invalid email format";
                $check=1;
            }
            include 'connections.php';
            $sql="select * from user where email='$email'";
            $query=mysqli_query($con,$sql);
            $check2=mysqli_num_rows($query);
            if($check2!=0)
            {
                $erremail="email already exists";
                $check=1;
            }
        }
        else
        {
            $erremail = "Required Field"; 
            $check=1;
        }
        if(!empty($_POST['contact']))
        {
            $contact=$_POST['contact'];
            if(preg_match("/d{10}/",$contact))
            {
                $errcontact="invalid no.";
                $check=1;
            }
            if(strlen($contact)!=10)
            {
                $errcontact="invalid no.";
                $check=1;
            }
        }
        else
        {
            $errcontact = "Required Field"; 
            $check=1;
        }
        if(!empty($_POST['user']))
        {
            include 'connections.php';
            $user=$_POST['user'];
            $sql="select * from user where user='$user'";
            $query=mysqli_query($con,$sql);
            $check2=mysqli_num_rows($query);
            if($check2!=0)
            {
                $erruser="user already exists";
                $check=1;
            }
        }
        else
        {
            $erruser = "Required Field"; 
            $check=1;
        }
        if(!empty($_POST['pass']) && !empty($_POST['pass2']))
        {
            if(!($_POST['pass']==$_POST['pass2']))
            {
                $errconpass="password do not match";
                $check=1;
            }
        }
        else{
            if(empty($_POST['pass']))
            {
                $errpass="Required Field";
                $check=1;
            }
            if(empty($_POST['pass']))
            {
                $errconpass="Required Field";
                $check=1;
            }
        }
        if($check==0)
        {
            $pass=$_POST['pass'];
            header("location:signup.php?first_name=$fname&&last_name=$lname&&email=$email&&contact=$contact&&user=$user&&pass=$pass");
        }
    }
    if(isset($_POST['log_in']))
    {
        $check=0;
        if(!empty($_POST['user']))
        {
            include 'connections.php';
            $user=$_POST['user'];
            $sql="select * from user where user='$user'";
            $query=mysqli_query($con,$sql);
            $check2=mysqli_num_rows($query);
            if($check2==0)
            {
                $log_user="user does not exists";
                $check=1;
            }
        }
        else
        {
            $log_user = "Required Field"; 
            $check=1;
        }
        if(empty($_POST['pass']))
        {
                $log_pass="Required Field";
                $check=1;
        }
        if($check==0)
        {
            $pass=$_POST['pass'];
            header("location:login.php?user=$user&&pass=$pass");
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            LetsGo!
        </title>
        <link rel="stylesheet" type="text/css" href="index.css" />
    </head>
    <style>
        #content{
            margin-top: 30px;
            min-height: 500px;
        }
      
        #error2
        {
            font-size: 10px;
        }
    </style>
    <body>
        <div id="wrapper">
            <div id="header">
                <div id="logo">
                    <a href="home.php">LetsGo!</a>
                </div>
            </div>
            <div id="menu_bar">
                <a href="home.php">Home</a>
                <a href="book.php">Book</a>
                <a href="cancel.php">Cancel</a>
                <a href="enquiry.php">Enquiry</a>
                <a href="about.php">About Us</a>
                <a href="contact.php">Contact Us</a>
            </div>
            <div id="content_block">
                <div id="content">
                    <div id="content2">
                    <div id="log_in">
                        <div id="error">
                            <strong>Already Registered</strong>
                        </div>
                        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                            <table>
                                <tr><td>User Name</td><td>:</td><td><input type="text" name="user"/><br /><div id="error2"><?php echo $log_user; ?></div></td></tr>
                                <tr><td>Password</td><td>:</td><td><input type="password" name="pass"/><br /><div id="error2"><?php echo $log_pass; ?></div></td></tr>
                                <tr><td></td><td></td><td><input type="submit" name="log_in" value="login" /></td</tr>
                             </table>
                        </form>
                    </div>
                    <div id="sign_up" >
                        <div id="error">
                            <strong>New Registration</strong>
                        </div>
                        <form action="<?php echo $_SERVER["PHP_SELF"];?>"  method="post">
    <table>
        <tr><td>First Name</td><td>:</td><td><input type="text" name="first_name"/><br /><div id="error2"><?php echo $errfname; ?></div></td></tr>
        <tr><td>Last Name</td><td>:</td><td><input type="text" name="last_name"/><br /><div id="error2"><?php echo $errlname; ?></div></td></tr>
        <tr><td>Email</td><td>:</td><td><input type="text" name="email"/><br /><div id="error2"><?php echo $erremail; ?></div></td></tr>
        <tr><td>Contact no. </td><td>:</td><td><input type="text" name="contact"/><br /><div id="error2"><?php echo $errcontact; ?></div></td></tr>
        <tr><td>User Name</td><td>:</td><td><input type="text" name="user"/><br /><div id="error2"><?php echo $erruser; ?></div></td></tr>
        <tr><td>Password</td><td>:</td><td><input type="password" name="pass"/><br /><div id="error2"><?php echo $errpass; ?></div></td></tr>
        <tr><td>Confirm Password</td><td>:</td><td><input type="password" name="pass2"/><br /><div id="error2"><?php echo $errconpass; ?></div></td></tr>
        <tr><td></td><td></td><td><input type="submit" name="sign_up" value="Signup" /></td</tr>
    </table>
</form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
}
else
{
    header('location:home.php');
}
?>