 
 <!-- ------------------------------------- HTML -------------------------------- -->

<!DOCTYPE html>
<html>
<head>
<title>change destination</title>
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

if (!isSet($select))    //  select  اذا لم اضغط زر  
{
$q = "SELECT * FROM trip WHERE `from`='$fromf' AND `to`='$tof' AND `available_seats` >= $num_seatsf";
	$result = mysqli_query($con,$q);
	if (!$result)
	{
	  print "error - the query could not be executed";
	  $error=mysqli_error($con);
	  print "<p>$error</p>";
	  exit;
	}
else
{
	
	$rows=mysqli_num_rows($result);
	if ($rows==0)
	{
		echo "<br/><br/>  No Trips available !";
	}
	else
	{
	  print "<table border=1>\n";   // عناوين الاعمدة
	  print "<tr><th>From</th>
	         <th>To</th>
			 <th>Date</th>
		     <th>Time</th>
		     <th>Price</th>
			 <th></th></tr>";
		
	  for($i=0; $i<$rows; $i++)    // عشان اعبي الاعمدة بالقيم 
	  {
    $row = mysqli_fetch_assoc($result);
	$total = $num_seatsf * $row["price"];
    print "<tr" . (($i%2)?" class='shade'":"") . ">
	      <td>".$row["from"]."</td>
		  <td>$row[to]</td>
		  <td>$row[date]</td>
          <td>$row[time]</td>
		  <td>$total</td><td>
		  
	 <form action='ChangeDes.php' method='post'>
	 <input name='trip_idf' type='hidden' value='$row[trip_id]'>
	 <input name='num_passf' type='hidden' value=$num_seatsf>
	 <input name='totalf' type='hidden' value=$total>
	 <input name='select' type='submit' value='Select'></form></td></tr>\n";
    }
  print "</table>";
}
}
}     //  if (!isSet($select)) نهاية 

if (isSet($select))   //  select اذا ضغطت زر 
{
	$q= "UPDATE `reservation` SET `trip_id`=$trip_idf , `total_price`=$totalf";
	$result = mysqli_query($con,$q);
	if (!$result)
	{
	  print "error - the query could not be executed";
	  $error=mysqli_error($con);
	  print "<p>$error</p>";
	  exit;
	}
	else 
	{
		echo "Your reservation has been updated";
	}
}         
?>     

<br><br><br><br><br><br><br><br><br><br>
</div>
</body>
</html>

