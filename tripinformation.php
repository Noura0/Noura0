<!DOCTYPE html>
<html>
<head>
<title>Trip information</title>
<link href="style.css" rel="stylesheet" type="text/css">
</style>
</head>


<body>
      <div class="header_resize">
      <div class="logo"></div>
      <div class="menu_nav">
        <ul>
          <li><a href="search.html">New Booking</a></li>
          <li><a href="updateform.html">Change Booking & Print</a></li>
          <li><a href="contact.html">Contact Us</a></li>
        </ul>
        </div>
        </div>
		
           <!-- ------------------------------------------------------------- -->

<div class="content_resize">

<?php

$dep= $_POST["departuref"]; // from
$des= $_POST["destinationf"]; // to
$num_pass= $_POST["num_seatf"];  //  available_seats   // من الفورم استدعاء

$user='root';
$pass='';
$db='traindb';
$con= new mysqli('localhost',$user,$pass,$db) or die( "Could not connect to database " ); // الاتصال
 
                               //  trip استدعيت من جدول ال 
							   
$q = "SELECT * FROM trip WHERE `from`='$dep' AND `to`='$des' AND `available_seats` >= '$num_pass'"; // `available_seats` >= '$num_pass'
	$result = mysqli_query($con,$q);
	if (!$result)
	{
	  print "error - the query could not be executed";
	  $error=mysqli_error($con);
	  print "<p>$error</p>";
	  exit;
	}
else   // ضبط السلكت
{

	$rows = mysqli_num_rows($result);     // SELECT بناء ع استدعائي في ال 
	if ($rows==0)
	{
		echo "<br/> <br/>No Trips available!";     //   from - to  لأن مافية صف يوم اخترت   $rows==0 
	}
	else 
	{
	  print "<table border=1>\n";
	  print "<tr><th>From</th>
	         <th>To</th>
			 <th>Date</th>
		     <th>Time</th>
		     <th>Price</th>
			 <th></th></tr>";  // اطبع عناوين الجدول
		
	  for($i=0; $i<$rows; $i++)  // عشان امشي ع كل الصفوف 
	  {
    $row = mysqli_fetch_assoc($result);
	$total = $num_pass * $row["price"]; // لحساب السعر الكامل 
	
    print "<tr" . (($i%2)? "class='shade'":"") .">  
	  <td>" . $row["from"]."</td>
	  <td>$row[to]</td>
	  <td>$row[date]</td>
      <td>$row[time]</td>
	  <td>$total</td> 
      
	 <td><form action='book.php' method='post'>                  
	 <input name='trip_idf' type='hidden' value='$row[trip_id]'>
	 <input name='num_passf' type='hidden' value=$num_pass>
	 <input name='totalf' type='hidden' value=$total>
	 <input name='submit' type='submit' value='Book'>  
	  </form></td></tr>\n";
    }
  print "</table>";
  
}
} //  نهاية  else  السلكت
?>

<br><br><br><br><br><br><br><br><br><br>
</div>
</body>
</html>

