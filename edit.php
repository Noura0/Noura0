 
 <!-- ------------------------------------- PHP -------------------------------- -->

<?php
	extract($_POST);
	$user='root';
	$pass='';
	$db='traindb';
	$con= new mysqli('localhost',$user,$pass,$db) or die( "Could not connect to database " );
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

<h2>Change Your Destinantion</h2>

<form name="form1" method="post" action="changeDes.php">                        <!-- changeDes.php -->

  <table width="800" border="1" cellpadding="5">    <!-- بفتح جدول -->
    <tr>
      <th >From</th>  <!-- عنوان العمود -->
      <th ><?php echo $fromf;?></th>  <!-- قيمة العمود -->
    </tr>
    <tr>
      <td>To</td>  <!-- عنوان العمود -->
      <td>
      <select name="tof">     <!--  قيمة العمود عباره عن قائمه اختار منها  -->
      <?php 
	  $q = "SELECT DISTINCT `to` FROM trip WHERE `from`='$fromf' ";   //  يجيب  التو بناء ع الفورم  حقتي 

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
		$trips = mysqli_num_rows($result);
		for($i=0; $i<$trips; $i++) 
		{
			$trip=mysqli_fetch_assoc($result);
			echo "<option value='$trip[to]'> $trip[to] </option>";
		}
	}
	
	?> 
	</select></td>    <!--  نهاية القائمة اللي اختار منها  -->
    </tr>
	
    <tr>
      <td colspan="2">
      <input name="fromf" type="hidden" value="<?php echo $fromf;?>"/>
      <input name="num_seatsf" type="hidden" value="<?php echo $num_seatsf;?>"/>
      <input name="submit" type="submit" value="Change"></td>
    </tr>
  </table>
</form>

<br><br><br><br><br><br><br><br><br>
</div>
</body>
</html>