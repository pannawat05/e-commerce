
<!doctype html>
<html lang="en">
  <head>
<?php 
session_start();
include('conn.php');
$_SESSION["paytype"]='cash';
$_SESSION['name']=$_POST["name"];
$_SESSION['address']=$_POST["address"];
$_SESSION['phone']=$_POST["phone"];
$_SESSION['email']=$_POST["email"];

	$name = $_POST["name"]; 
	$address = $_POST["address"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	
	$username = $_SESSION["User_name"];

$sql ="UPDATE login SET `name`='$name',`address`='$address',`phone`='$phone',`email`='$email' WHERE username='$username'";
$query= mysqli_query($con,$sql);

END;

?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Choose your payment method</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <style>
  a{
      text-decoration:none;
      color:black;
      
  }
  </style>
  <body>
    <h1>เลือกวิธีการจ่ายเงิน</h1>
    <a class="netbank_btn" href="mobile.php"><img src="image/netbank.png"> >>mobie banking<< 
</a><br><br>
    <a class="cash_btn" href="saveorder.php"><img src="image/cash.png" width="150px" height="150px"> >>ชำระเงินปลายทาง<< </a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>