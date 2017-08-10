<?php 
	$user='root';
	$pass='';
	$db='traindb';
	//$_GET["res_idg"] = 2;
	$con= new mysqli('localhost',$user,$pass,$db) or die( "Could not connect to database " );
	$q="SELECT * FROM reservation, trip
	    WHERE reservation.trip_id=trip.trip_id AND reservation.res_id=$_GET[res_idg]";
	$result = mysqli_query($con,$q);
	if (!$result){
			  print "error - the query could not be executed";
			  $error=mysqli_error($con);
			  print "<p>$error</p>";
			  exit;
	}
	else {
		echo "executed";
	}
	$res=mysqli_fetch_assoc($result);
  ?>
  
   <!-- ------------------------------------- HTML -------------------------------- -->

<!DOCTYPE html>
<html>
<head>
<meta charset = "utf-8">
<title>print information</title>
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

<table width="800" border="1" cellpadding="5">       <!-- بفتح جدول  -->
  <tr>
    <th width="211" scope="row">Reservation Number</th>   <!-- اسم عمود  -->
    <td width="557"><?php echo $res["res_id"];?></td>   <!-- قيمة عمود  -->
  </tr>
  
  <tr>
    <th> Trip Number</th>    <!-- اسم عمود  -->
    <td><?php echo $res["trip_id"];?></td>   <!-- قيمة عمود  -->
  </tr>
  
  <tr>
    <th>Name</th>
    <td><?php echo $res["fname"]." ". $res["lname"];?></td>
  </tr>
  
    <tr>
    <th>Email</th>
    <td><?php echo $res["email"];?></td>
   </tr>
   
    <tr>
    <th>Mobile</th>
    <td><?php echo $res["mobile"];?></td>
   </tr>
   
    <tr>
    <th>From</th>
    <td><?php echo $res["from"];?></td>
   </tr>
   
    <tr>
    <th>To</th>
    <td><?php echo $res["to"];?></td>
   </tr>
   
    <tr>
    <th>Date</th>
    <td><?php echo $res["date"];?></td>
    </tr>
	
    <tr>
    <th>Time</th>
    <td><?php echo $res["time"];?></td>
   </tr>
   
    <tr>
    <th>Number of Passengers</th>
    <td><?php echo $res["num_pass"];?></td>
    </tr>
   
    <tr>
    <th>Price Per Seat</th>
    <td><?php echo $res["price"];?></td>
    </tr>
	
    <tr>
    <th>Total Price</th>
    <td><?php echo $res["total_price"];?></td>
    </tr>
	
</table>

<br><br><br><br><br>
</div>
</body>
</html>