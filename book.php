 
 <!-- ------------------------------------- PHP -------------------------------- -->
 
<?php 
session_start();
extract($_POST);
$result=false;
$rows=0;
if (isSet($confirm)){
	$user='root';
	$pass='';
	$db='traindb';
	$con= new mysqli('localhost',$user,$pass,$db) or die( "Could not connect to database " );
	$q = "SELECT * FROM reservation WHERE `trip_id`=$_SESSION[tripID] AND `mobile`=$mobilef";
	$exists = mysqli_query($con,$q);
	if (!$exists){
			  print "error - the query could not be executed";
			  $error=mysqli_error($con);
			  print "<p>$error</p>";
			  exit;
			}
	$rows = mysqli_num_rows($exists);	
	if($rows==0){
		$q = "INSERT INTO `reservation`(`trip_id`, `total_price`, `num_pass`, `fname`, `lname`, `mobile`, `email`) VALUES ($_SESSION[tripID], $_SESSION[totalPrice], $_SESSION[numPass], '$fnamef', '$lnamef', '$mobilef', '$emailf')";
			$result = mysqli_query($con,$q);
			if (!$result){
			  print "error - the query could not be executed";
			  $error=mysqli_error($con);
			  print "<p>$error</p>";
			  exit;
			}
		$id=mysqli_insert_id($con);
		$q = "SELECT `available_seats` FROM trip WHERE `trip_id`=$_SESSION[tripID]";
		$selected = mysqli_query($con,$q);
		if (!$selected){
			  print "error - the query could not be executed";
			  $error=mysqli_error($con);
			  print "<p>$error</p>";
			  exit;
			}
		else 
		{
			$trip=mysqli_fetch_assoc($selected);
			$available_seats_new = $trip["available_seats"] - $_SESSION["numPass"]; //-----------------------
			$q = "UPDATE `trip` SET `available_seats`=$available_seats_new WHERE `trip_id`=$_SESSION[tripID]";
			$selected = mysqli_query($con,$q);
			if (!$selected){
				  print "error - the query could not be executed";
				  $error=mysqli_error($con);
				  print "<p>$error</p>";
				  exit;
			}
		}
	}
}
  ?>
  <!-- ------------------------------------- HTML -------------------------------- -->
<!DOCTYPE html>
<html>
<head>
<meta charset = "utf-8">
<title>Book</title>
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
if(!isSet($confirm))
{
$_SESSION["tripID"]=$trip_idf; // tripinformation  من  الهيدن في فورم 
$_SESSION["numPass"]=$num_passf; // اخذت قيمهم
$_SESSION["totalPrice"]=$totalf;
?>

<form method ="post" action="book.php"> 

<br><br>
<label>First name : </label><input type ="text" name = "fnamef" required> <br><br>
<label>Last name : </label><input type ="text" name = "lnamef" required> <br><br>
<label>Phone number: </label><input type ="text" name = "mobilef" required><br><br>
<label>E-mail : </label><input type ="email" name = "emailf" placeholder= "Name@mail.com" required><br><br>
<input type ="submit" name="confirm" value="Confirm book"> 

<?php
} //  if(!isSet($confirm)) تسكيرة 

if($rows!=0) //  80 - 81 - 82  بناء ع 
    {
	echo "<h2> Your Booking already exist !</h2>";
	}
elseif (isSet($confirm) & $result)
{
	echo "<h2> Your Booking is confirmed !</h2>";
	echo "<h2> Your Reservation Number is: $id </h2>";
	echo"<a href='updateform.html'> Change </a><br/>";   // رابط عشان اروح للأوبديت  // updateform.html
	echo"<a href='print.php?res_idg=$id'> Print </a>";  // رابط عشان اروح للبرنت // print.php
}
?>
<br><br><br><br><br>
</div>
</body>
</html>