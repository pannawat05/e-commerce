<?php session_start(); ?>
<?php require_once('conn.php');
$id=$_GET['id'];
$i =0;
?>
<?php 
$sql1 = "select * from order_detail left join product on order_detail.p_id = product.id where o_id =' $id'";
$query1 = mysqli_query($con,$sql1);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u LWgxfKTRIcfu0JTxR EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<title>orderdetail</title>
</head>

<body>
   <h1>รายการสินค้าที่สั่งซื้อ</h1>

<table width="100%" class="table">
  <tr class="table-info" >
    <td width="2%">ที่</td>
    <td width="10%">ชื่อสินค้า</td>
    <td width="10%">จำนวนที่ซื้อ</td>
    <td width="15%">ราคา/ชิ้น</td>
        <td width="15%">ราคารวม/สินค้า</td>
  </tr>
  
   <?php do { ?>
   <?php $i +=1 
   ?>
   
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $row_Recordset1['name']; ?></td>
    <td><?php echo $row_Recordset1['d_qty']; ?></td>
    <td><?php echo $row_Recordset1['price']; ?></td>
    <td><?php echo $row_Recordset1['price']*$row_Recordset1['d_qty'];?></td>
      <tr>
     <td width="39"><table width="72" border="0">
      <tr> 
    </table></td>
  </tr>
  <?php } while ($row_Recordset1 = mysqli_fetch_array($query1)); ?>
</table>
<p> 
</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
