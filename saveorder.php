<?php 

	session_start();
    include("conn.php");  
echo $_SESSION["paytype"].$_SESSION["img"];
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" integrity="sha512-fRVSQp1g2M/EqDBL+UFSams+aw2qk12Pl/REApotuUVK1qEXERk3nrCFChouag/PdDsPk387HJuetJ1HBx8qAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js" integrity="sha512-7VTiy9AhpazBeKQAlhaLRUk+kAMAb8oczljuyJHPsVPWox/QIXDFOnT9DUk1UC8EbnHKRdQowT7sOBe7LAjajQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<title>Confirm</title>
</head>
<body>
<!--สร้างตัวแปรสำหรับบันทึกการสั่งซื้อ -->
<?php
	$name = $_SESSION["name"]; 
	$address = $_SESSION["address"];
	$email = $_SESSION["email"];
	$phone = $_SESSION["phone"];
	$total = $_SESSION['total'];
	$dttm = Date("Y-m-d G:i:s");
	$status = 'สั่งซื้อเรียบร้อย';
	$pay=$_SESSION['paytype'];
	$img=$_SESSION['img'];
	$user=$_SESSION['MM_Username'];
	//บันทึกการสั่งซื้อลงใน order_detail
	mysqli_query($con, "BEGIN"); 
	$sql1	= "insert into order_head values(null, '$dttm', '$name', '$address', '$email', '$phone', '$total','$pay','1','$img')";
	$query1	= mysqli_query($con, $sql1) or die (mysqli_error($con));
	//ฟังก์ชั่น MAX() จะคืนค่าที่มากที่สุดในคอลัมน์ที่ระบุ ออกมา หรือจะพูดง่ายๆก็ว่า ใช้สำหรับหาค่าที่มากที่สุด นั่นเอง.
	$sql2 = "select max(o_id) as o_id from order_head where o_name='$name' and o_email='$email' and o_dttm='$dttm' ";
	$query2	= mysqli_query($con, $sql2);
	$row = mysqli_fetch_array($query2);
	$o_id = $row["o_id"];
//PHP foreach() เป็นคำสั่งเพื่อนำข้อมูลออกมาจากตัวแปลที่เป็นประเภท array โดยสามารถเรียกค่าได้ทั้ง $key และ $value ของ array
	foreach($_SESSION['cart'] as $p_id=>$qty)
	{
		$p_qty = $_SESSION["p_qty"][$p_id];
		$sql3	= "select * from product where id= $p_id";
		$query3	= mysqli_query($con, $sql3);
		$row3	= mysqli_fetch_array($query3);
		$total	= $_SESSION['total'];
		
		
		
		
		//ตัดสต๊อก
 $sql5="SELECT * FROM product WHERE id= $p_id";
 $query5=mysqli_query($con,$sql5) or die(mysqli_error($con));
 
while($row5= mysqli_fetch_assoc($query5)): 
 $left=$row5['no'] - $qty;
 $sql6="UPDATE product SET no='$left' WHERE id = $p_id";
 $query6=mysqli_query($con,$sql6)or die(mysqli_error($con));
endwhile;
		
		$sql4	= "insert into order_detail values(null, '$o_id', '$p_id', '$p_qty', '$total')";
		$query4	= mysqli_query($con, $sql4);
	if($query1 && $query4){
		mysqli_query($con, "COMMIT");
		$msg = "บันทึกข้อมูลเรียบร้อยแล้ว ";
		
			//unset($_SESSION['cart'][$p_id]);
			unset($_SESSION['cart']);
		}
		//แจ้งเตือนผ่านไลน์

}
		
			 
			 

    
  

	
	if($query1 && $query4){
		mysqli_query($con, "COMMIT");
		$msg = "บันทึกข้อมูลเรียบร้อยแล้ว";
		echo '<script>
    setTimeout(function() {
        swal({
            title: "Rabbitshop",
            text: "สั่งซื้อสำเร็จ!",
            type: "success"
        }, function() {
            window.location = "index.php";
        });
    }, 1000);
</script>';
	
	
			unset($_SESSION['orderid']);
			unset($_SESSION['item']);
			unset($_SESSION['total']);
			
	}
	else{
		mysqli_query($con, "ROLLBACK");  
		$msg = "บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่ค่ะ ";	
                 setTimeout(function() {
      echo'  swal({
            title: "Rabbitshop",
            text: "สั่งซื้อไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่!",
            type: "error"
        }, function() {
            window.location = "index.php";
        });
    }, 1000);';
				 });
	}
	
							
	
	?>


 




</body>
</html>