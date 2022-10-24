<?php session_start(); ?>
<?php require_once('conn.php');
?>
<?php
$uname = $_SESSION["User_name"];
$sql1 ="select name from login where username = '$uname' ";
$query1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_assoc($query1);
$name = $row1['name'];

$sql2="select * from order_head where o_name = '$name' ";
$query2=mysqli_query($con,$sql2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u LWgxfKTRIcfu0JTxR EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<title>user console</title>
</head>
<style>
  #ordered{
    color:green;
    font-size:20px
  }
  #delivery{
    color:#994a00;
    font-size:20px;
  }
  #pack{
    color:#ffd152;
    font-size:20px;

  }
</style>
<body>
   <h1>คำสั่งซื้อของคุณ</h1>
    <h3>user: <?php echo  $_SESSION['User_name']; ?></h3>

<table width="100%" class="table">
  <tr class="table-danger" >
    <td width="2%">ที่</td>
    <td width="10%">รายการสินค้าที่สั่งซื้อ</td>
    <td width="10%">ราคารวม</td>
    <td width="20%">สถานะของคำสั่งซื้อ</td>
     <td width="20%">วันที่สั่งซื้อ</td>
    <td width="15%">ตัวเลือก</td>
    <td>กดปุ่มนี้เมื่อได้รับสินค้า</td>
  </tr>
   <?php do { ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><a href="member_order_detail.php?id=<?php echo $row2['o_id'] ?>">ดูรายการ</a></td>
    <td><?php echo $row2['o_total']; ?></td>
    <td><?php if($row2['o_status'] == 1){
      echo "สั่งซื้อแล้ว"."<i class='fa-solid fa-receipt' id='ordered'></i>";
    }else if($row2['o_status'] == 2){
      echo"ร้านค้ากำลังนำสินค้าส่งขนส่ง"."<i class='fa-solid fa-boxes-packing' id='pack'></i>";
    }else if($row2['o_status'] == 3){
      echo"ขนส่งกำลังจัดส่งสินค้า"."<i class='fa-solid fa-truck' id='delivery'></i>";
    }else if($row2['o_status'] == 4){
      echo"ได้รับสินค้าแล้ว";
    }
    
    
    
    ?></td>
    <td><?php echo $row2['o_dttm']; ?></td>
    <td width="15%"><a href="delorder.php?order=<?php echo $row2['o_id']; ?>" class="btn btn-danger" onclick="return confirm('ต้องการยกเลิกคำสั่งซื้อ?');">ยกเลิกคำสั่งซื้อ</a></td>
    <td><a class="btn btn-primary" href="user_order.php?u=<?php echo $row2['o_id']; ?>" onclick="return confirm ('ได้สินค้าแล้ว?');">ได้สินค้าแล้ว📦</a></td>
      <tr>
      <?php $i +=1;?>
  <?php } while ($row2 = mysqli_fetch_assoc($query2)); ?>
</table>
</body>
</html>
<?php
mysqli_free_result($con);
?>
