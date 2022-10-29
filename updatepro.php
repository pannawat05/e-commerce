<?php 
session_start();
    require_once "conn.php";
    if (isset($_POST['save'])) {
	$edit_id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $detail = $_POST['detail'];
    $no = $_POST['no'];
    $pro = $_POST['pro'];

    //new image name
    $img1 = "img1".$name;
    $img2 = "img2".$name;
    $img3 = "img3".$name;
    $img4 = "img4".$name;
        //old_image
    $old_img1 = $_POST['old_img1'];
    $old_img2 = $_POST['old_img2'];
    $old_img3 = $_POST['old_img3'];
    $old_img4 = $_POST['old_img4'];
       //new image type
    $type1 = strrchr($_FILES['img1']['name'],".");
    $type2 = strrchr($_FILES['img2']['name'],".");
    $type3 = strrchr($_FILES['img3']['name'],".");
    $type4 = strrchr($_FILES['img4']['name'],".");
    //echo $type1;
   if ( $img1 != '') {
	$sql = "UPDATE product SET `name`= '$name',`price`='$price',`type`='$type',`detail`='$detail',`no`='$no',`img1`='$img1.$type1',`pro`='$pro' WHERE id = $edit_id ";
 $query = mysqli_query($con,$sql);
  unlink("image/product/".$old_img1);
  move_uploaded_file($_FILES["img1"]["tmp_name"],"image/product/".$img1.$type1);
}
elseif ($img2 != '') {
   $sql = "UPDATE product SET `name`= '$name',`price`='$price',`type`='$type',`detail`='$detail',`no`='$no',`img2`='$img2.$type2',`pro`='$pro' WHERE id = $edit_id ";
 $query = mysqli_query($con,$sql);
  unlink("image/product/".$old_img2);
  move_uploaded_file($_FILES["img2"]["tmp_name"],"image/product/".$img2.$type2);
}
elseif ($img3 != '') {
   $sql = "UPDATE product SET `name`= '$name',`price`='$price',`type`='$type',`detail`='$detail',`no`='$no',`img3`='$img3.$type3',`pro`='$pro' WHERE id = $edit_id ";
 $query = mysqli_query($con,$sql);
 unlink("image/product/".$old_img3);
 move_uploaded_file($_FILES["img3"]["tmp_name"],"image/product/".$img3.$type3);
}
elseif ($img4 != '') {
    $sql = "UPDATE product SET `name`= '$name',`price`='$price',`type`='$type',`detail`='$detail',`no`='$no',`img4`='$img4.$type4',`pro`='$pro' WHERE id = $edit_id ";


 $query = mysqli_query($con,$sql);
 unlink("image/product/".$old_img4);
 move_uploaded_file($_FILES["img4"]["tmp_name"],"image/product/".$img4.$type4);
}

 if($query){
        $_SESSION['alert'] = 'Update successfully';
        header("location:adminconsole.php?p=list");

 }
}
?>
