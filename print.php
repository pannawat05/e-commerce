<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="print.css" media="print">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>พิมพ์ใบจ่า</title>
</head>
<style>
    .sender{
    text-align: left;
    margin-left: 30px;
}
.custumer{
    text-align: right;
    margin-right: 30px;
}
#logo{
    width: 50px;
    height:50px;
    border-radius:50px;
    border:5px;
    
}
</style>
<?php
include('conn.php');
$order = $_GET["order"];
$sql1="select o_name,o_addr,o_phone from order_head where o_id = '$order'";
$query1 =mysqli_query($con,$sql1);
$sql2="select name,address,phone from login where username = 'admin'";
$query2 =mysqli_query($con,$sql2);

?>
<body>
<h2>ตัวอย่าง</h2><br><br>
<center><img src="image/logo.jpeg" alt="logo" id="logo"></center><br>
<center><h4>Rabbitshop</h4></center><br>
<?php while ($row1 = mysqli_fetch_assoc($query2)): ?>
<div class="sender">
<h3>ชื่อและที่อยู่ผู้ส่ง</h3>
<?php
echo $row1['name'];
echo $row1['address'];
echo $row1['phone'];

?>
</div>
<br><br><br>
<?php endwhile; ?>
<?php while ($row2 = mysqli_fetch_assoc($query1)): ?>
<div class="custumer">
    <h3>ชื่อและที่อยู่ผู้รับ</h3>
<?php
echo $row2['o_name']."";
echo $row2['o_addr']." ";
echo $row2['o_phone'];

?>
</div>
<?php endwhile; ?><br>
<center><h4 style="color:#fca3ff;">ขอบคุณที่ใช้บริการ</h4></center>
<button id="print" class=" btn btn-success" onclick="window.print();">Print</button>

    
</body>
</html>