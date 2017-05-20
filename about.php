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
            margin-left:auto;
            margin-right: auto;
            padding-top: 10px;
        }
        p{
            color:darkblue;
        }
        h3{
            color:crimson;
        }
    </style>
    <body>
        <div id="wrapper">
            <div id="header">
                <div id="logo">
                    <a href="home.php">LetsGo!</a>
                </div>
                <?php
                session_start();
                if(isset($_SEESION['loggedin']))
                { ?>
                <div id="user">
                    <a href="logout.php" >Logout</a>
                </div>
                <?php } ?>
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
                    <h3>FOUNDATION:</h3>
                    <b><p>WE CAME INTO SERVICE ON 21/11/12 AND OPENED OFFICE AT KOTA.ITS BEEN ONE YEAR SINCE OUR INCEPTION ANDWE HAVE COVERED A LOT OF JOURNEY -ITS BECAUSEWE BELIEVE IN--- OUR CUSTOMERS OUR PRIDE.</b></p>
                    <h1>SERVICE EXPANSION:</h1>
                    <p>WE STARTED OUR BUSINESS FROM KOTA WHICH IS NOW OURHEAD OFFICE AND HAVE ALSO OPENED OFFICES IN INDORE AND GWALIOR.WE ARE MOVING SWIFTLY AND HAVE EXPANDED BUSINESS TO KOTA,JHANSI,KANPUR,LUCKNOW,BHOPAL,GUNA,BINA,INDORE,UJJAIN.WE HAVE MADE CONTACTS WITH BEST BUS FLEET OPERATORS TO PROVIDE SERVICE VIA OUR RESERVATION PORTAL.OUR VISION IS TO GET ALL BUS OPERATORS, URBAN AS WELL AS SUB-URBAN,TO PROVIDE SERVICE TO OUR CUSTOMER</p>
                    <h4><i>WE ARE IMMENSELY PROUD TO PROVIDE YOU THE BEST.LETSGO.COM THANKS CUSTOMERS FOR THEIR LOVING SUPPORT.</i></h4>
                </div>
            </div>
        </div>
    </body>
</html>