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
          
            margin: 0px auto;
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
<?php                   if($_SERVER['REQUEST_METHOD']=="POST")
                        {
                            if(isset($_POST['provide_details']))
                            {
                                $i=1;
                                $seat=$_POST['select_seat'];
?>                              <div id="provide_details">
                                <div id="details">
                                <form action="book.php" method="post">
<?php                               $bus_id=$_POST['bus_id'];$route_id=$_POST['route_id'];$date=$_POST['date']; ?>
                                    <input type="hidden" name="bus_id" value="<?php echo $bus_id; ?>" />
                                    <input type="hidden" name="route_id" value="<?php echo $route_id; ?>" />
                                    <input type="hidden" name="date" value="<?php echo $date; ?>" />
                                    <input type="hidden" name="select_seat" value="<?php echo $seat; ?>" />
                                    <table>
                                        <tr><td>First Name</td><td>Last Name</td><td>Age</td><td>Gender</td></tr>
<?php                               while($i<=$seat)
                                   { ?>
                                        <tr>
                                            <td><input type="text" name="fname<?php echo $i; ?>" required/></td>
                                            <td><input type="text" name="lname<?php echo $i; ?>" required/></td>
                                            <td><input type="number" name="age<?php echo $i; ?>" required/></td>
                                            <td><select name="gender<?php echo $i; ?>" required>
                                                    <option value="">------</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                            </select></td>
                                        </tr>
<?php                               $i++;
                                   } ?>
                                        <tr><td><input type="submit" value="book" /></td></tr>
                                </table>
                            </form>
    </div>
                        </div>
<?php                        }
                            else
                            {
                                 $bus_id=$_POST['bus_id'];$route_id=$_POST['route_id'];$date=$_POST['date'];$user=$_SESSION['user_id'];
                                 $sql_route="select * from route where route_id='$route_id'";
                                 $query_route=mysqli_query($con,$sql_route);
                                 while($row=mysqli_fetch_array($query_route))
                                 {
                                     $city_from=$row['city_from'];
                                     $city_to=$row['city_to'];
                                     $ammount=$row['fare'];
                                 }
                                 $sql_bus="select bus_no from bus where bus_id='$bus_id'";
                                 $query_bus=mysqli_query($con,$sql_bus);
                                 while($row=mysqli_fetch_array($query_bus))
                                 { 
                                     $bus_no=$row['bus_no'];} 
                                        $bill="select max(bill_no) from ticket";
                                        $query_bill=mysqli_query($con,$bill);
                                        while($row=mysqli_fetch_array($query_bill))
                                        {
                                            $bill_no=$row['max(bill_no)'];
                                        }
                                        $bill_no=$bill_no+1;
                                 $hera=1;
                                 $tot_ammount=$ammount*$_POST['select_seat'];
                                 while($hera<=$_POST['select_seat'])
                                 {
                                     //$tot_ammount=$tot_ammount+$ammount;
                                     //echo $tot_ammount;
                                        $fname=$_POST['fname'.$hera];
                                        $lname=$_POST['lname'.$hera];
                                        $age=$_POST['age'.$hera];
                                        $gender=$_POST['gender'.$hera];
                                        //echo 'First Name:'.$fname;echo '<br />Last Name:'.$lname; echo '<br />Age'.$age;echo '<br />Gender'.$gender;
                                        $seat_sql="select seat_no from ticket where route_id='$route_id' and bus_id='$bus_id' and date_travel='$date' ORDER BY seat_no asc ";
                                        $seat_query=mysqli_query($con,$seat_sql);
                                        $count_seat=mysqli_num_rows($seat_query);
                                        //$tot_ammount=0;
                                        if($count_seat==0)
                                        {
                                            $i=1;
                                            $sql="insert into ticket (bill_no,route_id,bus_id,user_id,city_from,city_to,bus_no,fname,lname,gender,age,date_travel,seat_no,ammount)
                                                values
                                                ('$bill_no','$route_id','$bus_id','$user','$city_from','$city_to','$bus_no','$fname','$lname','$gender','$age','$date','$i+1','$ammount')";
                                            $query=mysqli_query($con,$sql);
                                            $sql2="select seat_available from available where date='$date' and bus_id='$bus_id' and route_id='$route_id'";
                                            $query2=mysqli_query($con,$sql2);
                                            while($result=mysqli_fetch_array($query2))
                                            { $modi=$result['seat_available']; }
                                            $modi=$modi-1;
                                            $sql3="UPDATE  available SET  seat_available ='$modi' WHERE  date = '$date' and bus_id='$bus_id' and route_id='$route_id'";
                                            $query3=mysqli_query($con,$sql3);
                                        }
                                        else
                                        {
                                            $i=1;
                                            while($seat=mysqli_fetch_array($seat_query))
                                            {
                                                if($seat['seat_no']==$i && $i<46)
                                                    $i++;
                                                else                       
                                                    break;
                                            }           
                                            //echo '<br />seat no'.$i;
                                                $sql="insert into ticket (bill_no,route_id,bus_id,user_id,city_from,city_to,bus_no,fname,lname,gender,age,date_travel,seat_no,ammount)
                                                values
                                                ('$bill_no','$route_id','$bus_id','$user','$city_from','$city_to','$bus_no','$fname','$lname','$gender','$age','$date','$i+1','$ammount')";
                                            $query=mysqli_query($con,$sql);
//                                            if($query)
//                                            { echo 'query done'; }
                                            $sql2="select seat_available from available where date='$date' and bus_id='$bus_id' and route_id='$route_id'";
                                            $query2=mysqli_query($con,$sql2);
                                            while($result=mysqli_fetch_array($query2))
                                            { $modi=$result['seat_available']; }
                                            $modi=$modi-1;
                                            $sql3="UPDATE  available SET  seat_available ='$modi' WHERE  date = '$date' and bus_id='$bus_id' and route_id='$route_id'";
                                            $query3=mysqli_query($con,$sql3);
//                                            if($query3)
//                                            { echo 'update done'; }
//                                            else
//                                            { header('location:home.php'); }
                                        }
                                        $hera++;
                                 }
                                 ?>
                    <div id="result"><div id="message">
                                         your tacket has been booked
                                     </div>
                                     <div id="back">
                                        <a href="home.php" >Go Back To Home</a>
                                     </div>
                                     <div id="detail_header">
                                        <table>
                                            <tr><td>Bill No.</td>       <td>:</td><td><?php echo $bill_no;?></td></tr>
                                            <tr><td>Date Travel</td>    <td>:</td><td><?php echo $date;?></td></tr>
                                            <tr><td>To</td>              <td>:</td><td><?php echo $city_to;?></td></tr>
                                            <tr><td>From</td>            <td>:</td><td><?php echo $city_from;?></td></tr>
                                            <tr><td>No.of Passenger</td><td>:</td><td><?php echo $hera-1;?></td></tr>
                                            <tr><td>Bus No.</td>        <td>:</td><td><?php echo $bus_no;?></td></tr>
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
                                            <tr><td></td><td></td><td>Total Ammount</td><td><?php echo $tot_ammount; ?></td></tr>
                                        </table>
                                     </div></div><?php
                                 }
                         }
                         else
                         {
                            header('location:home.php');
                         }
?>                 </div>
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