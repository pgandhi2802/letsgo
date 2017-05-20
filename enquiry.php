<?php
include'connections.php';
session_start();
if(isset($_SESSION['loggedin'])){
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
/*            margin-top: 30px;
            margin-left:auto;
            margin-right: auto;
            padding-top: 80px;*/
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
        #result{
            width: 390px;
            margin: 0px auto;
            padding: 10px;
            box-shadow: 0px 0px 5px gray;
            border-top-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }
        #provide_details{
            text-align: center;
            margin: 0px auto;
            margin-left:auto;
            margin-right:auto;
            padding: 10px;
            box-shadow: 0px 0px 5px gray;
            border-top-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }
        #details{
              width: 600px;
              margin: 0px auto;
        }
        input[type=text],input[type=number],select,input[type=submit]{
            width: 150px;
        }
        #message{
            text-align: center;
            font-weight: bold;
        }
        #back{
            text-align:center;
        }
        table{
            margin: 0px auto;
        }
        td{
            box-shadow: 0px 0px 5px blue;
        }
        th{
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            box-shadow: 0px 0px 5px blue;
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
                    <div id="provide_details">
                        <div id="result">
                            <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" >
                                    <div id="message">
                                        Enter the bill no
                                    </div>
                                <input type="number" name="bill_no" value="bill_no"/>
                                <input type="submit" name="submit" value="submit" />
                            </form>
                            <?php
                            if(isset($_POST['bill_no']))
                            {
                                $user=$_SESSION['user_id'];
                                $bill_no=$_POST['bill_no'];
                                $sql="select * from ticket where user_id='$user' and bill_no='$bill_no'";
                                $query=mysqli_query($con,$sql);
                                $ammount=0;
                                while($row=mysqli_fetch_array($query))
                                { 
                                    $bill_no=$row['bill_no'];
                                    $date=$row['date_travel'];
                                    $city_to=$row['city_to'];
                                    $city_from=$row['city_from'];
                                    $bus_no=$row['bus_no'];
                                    $ammount=$ammount+$row['ammount'];
                                }
                                    ?>
                                    <div id="detail_header">
                                        <table>
                                            <tr><td>Bill No.</td>       <td>:</td><td><?php echo $bill_no;?></td></tr>
                                            <tr><td>Date Travel</td>    <td>:</td><td><?php echo $date?></td></tr>
                                            <tr><td>To</td>              <td>:</td><td><?php echo $city_to;?></td></tr>
                                            <tr><td>From</td>            <td>:</td><td><?php echo $city_from;?></td></tr>
                                            <tr><td>Bus No.</td>        <td>:</td><td><?php echo $bus_no;?></td></tr>
                                            <tr><td>Total Ammount</td>        <td>:</td><td><?php echo $ammount;?></td></tr>
                                        </table>
                                         <hr /> 
                                        <table>
                                        <tr><th>Name</th><th>Age</th><th>Gender</th><th>Seat No</th></tr>
                            <?php
                                        $det="select * from ticket where bill_no='$bill_no'";
                                        $query_det=mysqli_query($con,$det);
                                        while($row=mysqli_fetch_array($query_det))
                                        { ?>
                                            <tr><td><?php echo $row['fname'];echo ' '.$row['lname']; ?></td><td><?php echo $row['age']; ?></td><td><?php echo $row['gender']; ?></td><td><?php  echo $row['seat_no']; ?></td></tr>
                                  <?php }
                            ?>
                                        </table>
                                     </div> <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php } ?>