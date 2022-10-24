<html>
<head>
<?php
include('conn.php');
session_start();
	
	
	$p_id = $_GET['p_id']; 
	$act = $_GET['act'];
 
	if($act=='add' && !empty($p_id))
	{
		if(isset($_SESSION['cart'][$p_id]))
		{
			$_SESSION['cart'][$p_id]++;
		} 
		else
		{
			$_SESSION['cart'][$p_id]=1;
		}
	}
 
	if($act=='remove' && !empty($p_id))  //ยกเลิกการสั่งซื้อ
	{
		unset($_SESSION['cart'][$p_id]);
	}
if($act=="remove1"){
    unset($_SESSION['cart']);

}
 
	if($act=='update')
	{
		$amount_array = $_POST['amount'];
		foreach($amount_array as $p_id=>$amount)
		{
			$_SESSION['cart'][$p_id]=$amount;
		}
	}
	$username = $_SESSION["User_name"];
	
	$query1="SELECT name,address,phone,email FROM login WHERE username='$username'";
   $Result1 = mysqli_query($con,$query1) or die(mysqli_error());
   $row=mysqli_fetch_assoc($Result1);
	
	if(isset($_SESSION['User_name'])){
	    $name=$row['name'];
	    $address=$row['address'];
	    $phone=$row['phone'];
	    $email=$row['email'];
	} 
	if(empty($_SESSION['cart'])){
	
	header("location:index.php");
	}
	if($act == 'add'){
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Rabbitshop!</strong> เพิ่มสินค้าสำเร็จ
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php

	}
	
	?>
	
	
	
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<link href="libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="jquery.nice-number.css" rel="stylesheet">
    <!--JQuery CDN-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="jquery.nice-number.js"></script>
<script type="text/javascript">
$(function(){

  $('input[type="number"]').niceNumber();

});
</script>
<script src="sweetalert2.all.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>my cart!</title>
  </head>
<style>
   button{
      background-color:#000000;
      color:#ffffff;
      border:none;
      outline:none;
      padding:0 10px;
      border-radius:5px;
  }

</style>
  <body>
<form id="cart" name="cart" method="post" action="?act=update">
<table class="table"  align="center">
<tr>
      <td colspan="5">
      <center><h2><b>ตะกร้าสินค้า</span></h2></center></td>
    </tr>
    <tr width='100%'>
      <td width="25%" align="center">สินค้า</td>
      <td width="20%" align="center">ชื่อสินค้า</td>
      <td width="15%"align="center">ราคา</td>
      <td width="15%"align="center" >จำนวน</td>
      <td width="20%"align="center" >รวม(บาท)</td>
      <td width="5%"align="center" >ลบ</td>
    </tr>
<?php
$total=0;
if(!empty($_SESSION['cart']))
{
	
	include("conn.php");
	foreach($_SESSION['cart'] as $p_id=>$qty)
	{
		$sql = "SELECT * FROM product WHERE id= $p_id";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		$sum = $row['price'] * $qty;
		$_SESSION["p_qty"][$p_id] = $qty;
		$total  += $sum;
    $_SESSION["total"] = $total;
		echo "<tr width='100%'>";
    echo  "<td width ='25%' align='center'>.<img src ='image/product/".$row['img1']."' width='25%'>.</td>";  
		echo "<td width='20%' align='center' style='border:none;'>" . $row["name"] . "</td>";
		echo "<td width='15%' align='center' style='border:none;'>" .number_format($row["price"],2) . "</td>";
		echo "<td width='15%' align='center' style='border:none;'>";  
	    echo "<input type='number' name='amount[$p_id]' value='$qty' size='1' width='5%' class='form-control'/></td>";
        echo "<td width='20%'align='center' style='border:none;'>"."<b>".number_format($sum,2)."</b>"."</td>";
        echo"<td width='5%' align='center' style='border:none;'>";
        echo"<a href='cart.php?p_id=$p_id&act=remove' class='btn btn-danger'>ลบ</a>";
        echo "</tr>";
    }
    echo "<tr>";
  	echo "<td  colspan='4'  align='center'><b>ราคารวม(บาท)</b></td>";
  	echo "<td align='right'>"."<b>".number_format($total,2)."</b>"."</td>";
  	echo "<td align='left'></td>";
	echo "</tr>";
}
?>
<tr>
<td style="border:none;"><a onclick='window.history.back()' class="btn btn-primary">Back</a></td>
<td style="border:none;"><a href='index.php'  class="btn btn-primary">กลับหน้าหลัก</a></td>
<td style="border:none;" colspan="4" align="right">
    <input type="submit" name="button" id="button" value="ปรับปรุง" class="btn btn-info">
<a  href='?act=remove1'class="btn btn-warning remove"><i class="fa-regular fa-circle-minus"></i>ยกเลิกตะกร้าสินค้า</a>
</td>
</tr>
</table>


</form>
<div class="container" style="padding-top:100px">
  <div class="row">
  <div class="col-md-4"></div>
    <div class="col-md-5" style="background-color:#f4f4f4">
      <h3 align="center" style="color:green">
      <span class="glyphicon glyphicon-shopping-cart"> </span>

         confirm cart </h3>
      <form  name="formlogin" action="payment.php" method="POST" id="login" class="form-horizontal">
        <div class="form-group">
          <div class="col-sm-12">
            <input type="text"  name="name" class="form-control" required placeholder="ชื่อ-สกุล" value="<?php echo $name; ?>"/>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <textarea name="address" class="form-control"  rows="3"  required placeholder="ที่อยู่ในการส่งสินค้า"> <?php echo $address; ?></textarea> 
          </div>

        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <input type="text"  name="phone" class="form-control" required placeholder="เบอร์โทรศัพท์" /  value="<?php echo $phone; ?>">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <input type="email"  name="email" class="form-control" required placeholder="อีเมล์"  value="<?php echo $email; ?>"/>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12" align="center">
            <button type="submit" class="btn btn-primary btn-lg" id="btn">

             ยืนยันการสั่งซื้อ </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
$('.remove').on('click',function (e) {

        e.preventDefault();

        var self = $(this);

        console.log(self.data('title'));


        Swal.fire({

            title: 'Are you sure?',

            text: "You won't be able to revert this!",

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#3085d6',

            cancelButtonColor: '#d33',

            confirmButtonText: 'Yes, delete it!'

        }).then((result) => {

            if (result.isConfirmed) {

                Swal.fire(

                    'Deleted!',

                    'Your file has been deleted.',

                    'success'

                )

              location.href = self.attr('href');


            }

        })



    })
   

</script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper 

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7 zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG 2QOK9T ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">-->
  </body>
</html>
  </body>
</html>
</html>