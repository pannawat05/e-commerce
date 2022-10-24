<?php 
$id =$_GET["id"];
include('conn.php');
$sql1="select type from product where id = $id";
$query1=mysqli_query($con,$sql1);
$type1 =mysqli_fetch_assoc($query1);
$type = $type1['type'];

$sql2="select distinct type from product where type !='$type'";
$query2 = mysqli_query($con,$sql2);

$Sql3 = "select * from product where id = $id";
$query3 = mysqli_query($con,$Sql3);


$sql4="select pro from product where id = $id";
$query4=mysqli_query($con,$sql4);
$pro1 =mysqli_fetch_assoc($query4);
$pro = $pro1['pro'];

$sql5="select distinct pro from product where pro !='$pro'";
$query5 = mysqli_query($con,$sql5);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>add new product</title>
  </head>
  <body>
    
      <h1>update product</h1><br><br>
<form  method="post" action="updatepro.php" enctype="multipart/form-data" name="upload" id="upload"> 
	<?php
   while($row2 = mysqli_fetch_assoc($query3)): ?>
   <input type="hidden" name="id" value="<?php echo $row2['id']; ?>">
<label for="name">ชื่อสินค้า :</label> <input type="text" name="name" class="form-control" placeholder="ชื่อสินค้า" value="<?php echo $row2['name'];  ?>"><br>
<label for="price">ราคาสินค้า :</label> <input type="number" name="price" class="form-control" placeholder="ราคาสินค้า" value="<?php echo $row2['price'];  ?>" ><br>
<label for="type">ประเภทของสินค้า :</label> 

<select class="form-select" aria-label="ประเภท" name="type">
  <option selected><?php echo $type; ?></option>
	
<?php
   while($row1 = mysqli_fetch_assoc($query2)): ?>
  <option value="<?php echo $row1['type']; ?>"><?php echo $row1['type']; ?></option>
<?php endwhile;?>
	
</select><br>
<label for="detail">รายละเอียดสินค้า :</label><textarea class="form-control" name="detail" required rows="3" placeholder="รายละเอียด  ไม่เกิน 255 ตัวอักษร"><?php echo $row2['detail']; ?></textarea><br>
<label for="no">จำนวนสินค้า :</label> <input type="number" name="no" class="form-control" placeholder="จำนวนสินค้า" value="<?php echo $row2['no'];  ?>"><br>
<label for="img1">รูปปกสิค้า:</label> <input type="file" name="img1" class="form-control" placeholder="เลือกรูปที่ 1" ><br>
<label for="" class="form-text text-muted">current image</label> <img src="image/product/<?php echo $row2['img1']; ?>" width ="40%"><br>
<input type="hidden" name="old_img1" value="<?php echo $row2['img1'];  ?>">
<label for="img2">รูป2:</label> <input type="file" name="img2" class="form-control" placeholder="เลือกรูปที่ 2"  ><br>
<label for="" class="form-text text-muted">current image</label><img src="image/product/<?php echo $row2['img2']; ?>" width ="40%"><br>
<input type="hidden" name="old_img2" value="<?php echo $row2['img2'];  ?>">
<label for="img3">รูป3:</label> <input type="file" name="img3" class="form-control" placeholder="เลือกรูปที่ 3"  ><br>
<label for="" class="form-text text-muted">current image</label><img src="image/product/<?php echo $row2['img3']; ?>" width ="40%"><br>
<input type="hidden" name="old_img3" value="<?php echo $row2['img3'];  ?>">
<label for="img4">รูป4:</label> <input type="file" name="img4" class="form-control" placeholder="เลือกรูปที่ 4"  ><br>
<label for="" class="form-text text-muted">current image</label><img src="image/product/<?php echo $row2['img4']; ?>" width ="40%"><br>
<input type="hidden" name="old_img4" value="<?php echo $row2['img4'];  ?>">
	<?php endwhile;?>
<label for="type">ขึ้นหน้าหลัก :</label> <select class="form-select"  name="pro">
  <option selected><?php echo $pro  ?></option>
	<?php
   while($row3 = mysqli_fetch_assoc($query5)): ?>
  <option value="1"><?php echo $row3['pro']; ?></option>
	<?php endwhile; ?>
  </select><br>
  <input type="submit" name="save"  value="เพิ่มสินค้า" class ="btn btn-primary" />
    </form>
   

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>