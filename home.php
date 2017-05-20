<?php
include 'connections.php';
session_start();
if(isset($_SESSION['loggedin']))
{
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
            min-height: 350px;
            padding-top:150px;
        }
        #search{
            width: 390px;
            margin: 0px auto;
            padding: 10px;
            box-shadow: 0px 0px 5px gray;
            border-top-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }
        #message{
            width: 200px;
            margin: 0px auto;
            text-align:center;
            border-radius: 5px;
            box-shadow: 0px 0px 5px crimson;
        }
        #message>a{
            color: crimson;
        }
        #message_result{
            width: 390px;
            height: 100px;
            padding-top: 30px;
            margin: 0px auto;
            margin-top: 70px;
            box-shadow: 0px 0px 5px gray;
            border-top-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }
        #result{
            width: 390px;
            margin: 0px auto;
            padding: 10px;
            box-shadow: 0px 0px 5px gray;
            border-top-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }
    </style>
    <body>
        <div id="wrapper">
            <div id="header">
                <div id="logo">
                    <a href="home.php">LetsGo!</a>
                </div>
                <div id="user">
                    <a href="logout.php" >Logout</a>
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
                    <?php
                    $error="Enter your query";
                    if($_SERVER['REQUEST_METHOD']=="POST"){
                        $to=$_POST['to'];$from=$_POST['from'];$date=$_POST['travel_date'];
                        $query1=mysqli_query($con,"select * from route where city_to='$to' and city_from='$from'");
                        $count1=  mysqli_num_rows($query1);
                        if($count1==0)
                        {
                            $erro2=NULL;
                            $error="No route found";
                            ?>
                    <div id="message_result">
                        <div id="error">
                            <?php echo $error ;?>
                        </div> 
                        <div id="message">
                            <a href="home.php" >Back To Home </a>
                        </div>
                    </div>
                    <?php
                        }
                        else
                        {
                            $error2="your route has been found";
                            $error="make another query";
                            while($row=mysqli_fetch_array($query1))
                            {
                                $id=$row['route_id'];
                                $query2=mysqli_query($con,"select * from available where route_id='$id' and date='$date' and seat_available > 0 and seat_available < 46");
                                $count2=  mysqli_num_rows($query2);
                                if($count2!=0)
                                {
                                    while($row1=mysqli_fetch_array($query2))
                                    { ?>
                                        
                                        <div id="result"><div id="error"><?php echo $error2 ;?></div> <table>
                            <tr><td>From</td><td>:</td><td><?php echo $from; ?></td></tr>
                            <tr><td>To</td><td>:</td><td><?php echo $to; ?></td></tr>
                            <tr><td>Date Travel</td><td>:</td><td><?php echo $date; ?></td></tr>
                            <tr><td>Seat Available</td><td>:</td><td><?php echo $row1['seat_available']; ?></td></tr>
                        
                        <?php 
                        $seat=$row1['seat_available'];
                        $bus_id=$row1['bus_id'];
                        $route_id=$row1['route_id'];
                        $date=$row1['date'];
                        $i=0;
                        ?>
                    
                        <form action="book.php" method="POST">
                            <input type="hidden" name="bus_id" value="<?php echo $bus_id; ?>" />
                            <input type="hidden" name="route_id" value="<?php echo $route_id; ?>" />
                            <input type="hidden" name="date" value="<?php echo $date; ?>" />
                            <input type="hidden" name="max_seat" value="<?php echo $seat; ?>" />
                            
                                <tr><td>Select No. of Seats</td><td>:</td><td>
                                <select name="select_seat" required>
                                    <?php
                                    $i=0;
                                    while($i<$seat && $i< 5){ ?>
                                    <option value="<?php echo $i+1;?> "><?php echo $i+1; ?></option>
<?php                               $i++;}
                                    ?>
                                    </td>
                                </select>
                                <tr><td></td><td></td><td><input type="submit" name="provide_details" value="provide details"/></td></tr>
                            </table>
                        </form>
                    </table>
                                            </div>
                        <?php
                    }
                }
                else
                {
                    $error="Sorry! No Seat Available";
                    ?>
                    <div id="message_result">
                        <div id="error">
                            <?php echo $error2 ;?>
                        </div> 
                        <div id="message">
                            <a href="home.php" >Back To Home </a>
                        </div>
                    </div> <?php
                }
            }
        }
    }
    else
    {
                    $sql="select * from branch";
                    $query_to=  mysqli_query($con, $sql);
                    $query_from=  mysqli_query($con, $sql);?>
                    <div id="search">
                        <div id="error">
                            <?php echo $error; ?>
                        </div>
                        <form action="home.php" method="post">
                            <table>
                                <tr><td>From<td>:</td></td><td><select name="from" required>
                                                        <option value="">--------</option>
            <?php                                       while($row=mysqli_fetch_array($query_to)){ ?>
                                                        <option value="<?php echo $row['branch_name']; ?>"><?php echo $row['branch_name']; ?></option> <?php }?>
                                                       </select></td></tr>
                                 <tr><td>To<td>:</td></td><td><select name="to" required>
                                                        <option value="">--------</option>
            <?php                                       while($row=mysqli_fetch_array($query_from)){ ?>
                                                        <option value="<?php echo $row['branch_name']; ?>"><?php echo $row['branch_name']; ?></option> <?php }?>
                                                       </select></td></tr>
                                <tr><td>Date Travel<td>:</td></td><td><input type="date" name="travel_date" required/></td></tr>
    <tr><td></td><td></td><td><input type="submit" value="search" /></td></tr> <?php } ?>
                            </table>
                        </form>
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
    header('location:index.php');
}
?>