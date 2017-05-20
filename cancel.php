<?php
include 'connections.php';
session_start();
if($_SESSION['loggedin'])
{ ?>

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
            min-width: 100px;
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
<?php if(!isset($_GET['q']))
        {
            $user=$_SESSION['user_id'];
            
//            $sql="select distinct(bill_no),count(bill_no),date_travel,city_from,city_to,bus_no from ticket where date_travel>CURDATE() and user_id='$user' group by bill_no";
            $sql="select distinct(bill_no),count(bill_no),date_travel,city_from,city_to,bus_no from ticket where user_id='$user' group by bill_no";
            $query=mysqli_query($con,$sql);
            ?>
                    <div id="result">
                        <table>
                            <tr><th>Bill No.</th><th>Date Travel</th><th>To</th><th>From</th><th>No.of Passenger</th><th>Bus No.</th></tr>
                            <?php 
                                while($row=mysqli_fetch_array($query))
                                {?>
                            <tr><td><a href="cancel.php?q=<?php echo $row['bill_no'];?>"><?php echo $row['bill_no'];?></a></td><td><?php echo $row['date_travel'];?></td><td><?php echo $row['city_from'];?></td><td><?php echo $row['city_to'];?></td><td><?php echo $row['count(bill_no)'];?></td><td><?php echo $row['bus_no'];?></td></tr>
<?php                           }
                            ?>
                        </table>
                    </div>
            <?php
        }
        else 
        {
            $bill_no=$_GET['q'];
            $sql_get="select bus_id,route_id,date_travel from ticket where bill_no='$bill_no' group by bill_no";
            $query_get=mysqli_query($con,$sql_get);
            while($row=mysqli_fetch_array($query_get)){
                $bus_id=$row['bus_id'];
                $route_id=$row['route_id'];
                $date=$row['date_travel'];
                echo $bus_id;
                echo $route_id;
                echo $date;
            }
            $sql_get="select seat_available from available where bus_id='$bus_id' and route_id='$route_id' and date='$date'";
            $query_get=mysqli_query($con,$sql_get);
            while($row=mysqli_fetch_array($query_get))
            {
                $i=$row['seat_available'];
            }
            $i=$i+1;
            $sql_up="UPDATE available SET  seat_available ='$i' WHERE bus_id='$bus_id' and route_id='$route_id' and date= '$date'";
            $query=mysqli_query($con,$sql_up);
            if($query)
                echo 'up done';
            $sql_del="DELETE FROM ticket  where bill_no='$bill_no'";
            $query_del=mysqli_query($con,$sql_del);
            if($query_del)
                echo ' del done';
        }
    ?>
                    </div>
                </div>
            </div>
        </body>
    </html>
<?php }
else
{
    header('location:index.php');
}
?>
