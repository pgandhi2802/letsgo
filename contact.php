<?php
include 'connections.php';
session_start();
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
            padding: 30px;
            margin-top: 30px;
            margin-left:auto;
            margin-right: auto;
            padding-top: 70px;
        }
        #result{
            
            margin: 0px auto;
            padding: 10px;
            box-shadow: 0px 0px 5px gray;
            border-top-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }
        #result>table{
            margin : 0px auto;
        }
        th,td{
            min-width: 200px;
            text-align:center;
            padding: 5px;
            box-shadow: 0px 0px 2px blue;
        }
        th{
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            padding: 5px;
        }
    </style>
    <body>
        <div id="wrapper">
            <div id="header">
                <div id="logo">
                    <a href="home.php">LetsGo!</a>
                </div>
                <?php if(isset($_SESSION['loggedin'])){?>
                <div id="user">
                    <a href="logout.php" >Logout</a>
                </div>
                <?php }?>
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
                    <div id="result">
                    <table>
                        <tr><th>City</th><th>Address</th><th>Contact No</th></tr>
                    <?php
                    $user=$_SESSION['user_id'];
                    $sql="select * from branch";
                    $query=mysqli_query($con,$sql);
                    while($row=mysqli_fetch_array($query))
                    {?>
                        <tr><td><?php echo $row['branch_name']; ?></td><td><?php echo $row['address1'];?><br /><?php echo $row['address2'];?></td><td><?php echo $row['contact_no']; ?></td></tr>
              <?php }
                    ?>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>