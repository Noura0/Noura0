
 <!-- ------------------------------------- HTML -------------------------------- -->

<!DOCTYPE html>
<html>
<head>
<title>cancel reservation</title>
<link href="style.css" rel="stylesheet" type="text/css">
</style>
</head>

<body>
      <div class="header_resize">
      <div class="logo"></div>
      <div class="menu_nav">
            <ul>
          <li><a href="search.html">New Booking</a></li>
          <li><a href="updateform.html">Change Booking&Print</a></li>
          <li><a href="contact.html">Contact Us</a></li>
           </ul>
        </div>
        </div>


  <!-- ------------------------------------------------------------- -->

<div class="content_resize">

<?php
extract($_POST);
$user='root';
$pass='';
$db='traindb';
$con= new mysqli('localhost',$user,$pass,$db) or die( "Could not connect to database " );

$available_seats_new = $num_seatsf + $available_seatsf; // ارجع عدد المقاعد  اللي هو اوردي حجزها 

			$q = "UPDATE `trip` SET `available_seats`=$available_seats_new WHERE `trip_id`=$trip_idf";
			$updated = mysqli_query($con,$q);
			if (!$updated)
			{
				  print "error - the query could not be executed";
				  $error=mysqli_error($con);
				  print "<p>$error</p>";
				  exit;
			}
	
$q = "DELETE FROM reservation WHERE `res_id`=$res_idf";   // احذف رقم الحجز
	$result = mysqli_query($con,$q);
	if (!$result)
	{
	  print "error - the query could not be executed";
	  $error=mysqli_error($con);
	  print "<p>$error</p>";
	  exit;
	}
	else echo "<h2> Your reservation has been cancelled ! </h2>";
?>

<br><br><br><br><br><br><br><br><br><br>
</div>
</body>
</html>

