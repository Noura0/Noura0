
 <!-- ------------------------------------- PHP -------------------------------- -->
<?php
	extract($_POST);
	$user='root';
	$pass='';
	$db='traindb';
	$con= new mysqli('localhost',$user,$pass,$db) or die( "Could not connect to database " );
	
	$q = "SELECT * FROM reservation WHERE `res_id`=$res_idf";   // ------------------------------- reservation جدول 
	$exists = mysqli_query($con,$q);
	if (!$exists)
	       {
			  print "error - the query could not be executed";
			  $error=mysqli_error($con);
			  print "<p>$error</p>";
			  exit;
			}
	$res= mysqli_fetch_assoc($exists);     // اخذت القيم اللي بالصف هذا كله 
	
	//---------------------------------------------------------------------
	
	$q = "SELECT * FROM `trip` WHERE `trip_id`=$res[trip_id]";   // --------------------------  trip جدول
	$result = mysqli_query($con,$q);
	if (!$result)
	       {
			  print "error - the query could not be executed";
			  $error=mysqli_error($con);
			  print "<p>$error</p>";
			  exit;
			}
	$trip= mysqli_fetch_assoc($result);  // اخذت القيم اللي بالصف هذا كله 
	
?>
 <!-- ------------------------------------- HTML -------------------------------- -->
 
<!DOCTYPE html>
<html>
<head>
<meta charset = "utf-8">
<title>Update information</title>
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
<table width="900" border="1" align="center" cellpadding="5" style="font:bold 9px tahoma;">   <!-- بفتح جدول -->

       <tr>                      <!-- عناوين الجدول  -->
    <th width="103" >Reservation Number</th>
    <th width="65" >Trip Number</th>
    <th width="67">From</th>
    <th width="58">To</th>
    <th width="41" >Time</th>
    <th width="37" >Fees</th>  <!-- Total price "رسوم" -->
    <th width="99" >Number of Passengers</th>
    <th width="97" >Name</th>
    <th width="54" >Mobile</th>
    <th width="45" >Email</th>
    <th width="76">Options</th>
      </tr> 
   
  <tr>                 <!-- بعبي الجدول بالقيم من كلا الجدولين -->
    <td><?php echo $res["res_id"]?></td>
    <td><?php echo $res["trip_id"]?></td>
    <td><?php echo $trip["from"]?></td>
    <td><?php echo $trip["to"]?></td>
    <td><?php echo $res["time"]?></td>                 <!--  Reservation التايم هنا حق جدول ال  --> 
    <td><?php echo $res["total_price"]?></td>
    <td><?php echo $res["num_pass"]?></td>
    <td><?php echo $res["fname"] ." ". $res["lname"]?></td>
    <td><?php echo $res["mobile"]?></td>
    <td><?php echo $res["email"]?></td>
	
	
    <td>             <!-- option داخل عمود ال  --> 
    <form action="edit.php" method="post">                                             <!-- edit.php   Change Destinantion --> 
    <input name="res_idf" type="hidden" value="<?php echo $res["res_id"]?>">
    <input name="fromf" type="hidden" value="<?php echo $trip["from"]?>">
    <input name="num_seatsf" type="hidden" value="<?php echo $res["num_pass"];?>">
    <input name="edit" type="submit" value="Change Destinantion"></form>
    
    <form action="cancel.php" method="post">                                                <!-- cancel.php   Cancel --> 
    <input name="res_idf" type="hidden" value="<?php echo $res["res_id"]?>">
    <input name="num_seatsf" type="hidden" value="<?php echo $res["num_pass"];?>">
    <input name="available_seatsf" type="hidden" value="<?php echo $trip["available_seats"]?>">
    <input name="trip_idf" type="hidden" value="<?php echo $trip["trip_id"]?>">
    <input name="cancel" type="submit" value="Cancel"></form>
	</td>     <!-- option داخل عمود ال  -->
	
    </tr>
</table>  <!-- نهاية الجدول  -->
<br/>

<a href="print.php?res_idg=<?php echo $res["res_id"]?>"> Print </a>   <!-- اذا ابغى اطبعهم -->
  <br><br><br><br><br><br><br><br>
</p>
</div>
</body>
</html>