<meta charset="UTF-8">
<?php
session_start();
$_SESSION['evidance']=0;
$_SESSION['pay_type']=0;
?>
<?php
//1. เชื่อมต่อ database: 
require_once('conn.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
$fileupload = $_POST['submit']; //รับค่าไฟล์จากฟอร์ม	

//ฟังก์ชั่นวันที่
        date_default_timezone_set('Asia/Bangkok');
	$date = date("Ymd");	
//ฟังก์ชั่นสุ่มตัวเลข
         $numrand = (mt_rand());
//เพิ่มไฟล์
$upload=$_FILES['upload'];
if($upload !='') {   //not select file
        //โฟลเดอร์ที่จะ upload file เข้าไป 
        $path="image/evidance/";  
        
        //เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
         $type = strrchr($_FILES['upload']['name'],".");
        	
        //ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
        $newname = $date.$numrand.$type;
        $path_copy=$path.$newname;
        $path_link="image/bill_img/".$newname;
        
        //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
        move_uploaded_file($_FILES['upload']['tmp_name'],$path_copy);  
        $_SESSION['img']=$newname;
        $_SESSION['paytype']='promptpay';
}
	// เพิ่มไฟล์เข้าไปในตาราง r$_SESSION['img']=$newname;
			echo "<script type='text/javascript'>";
        	echo "window.location = 'saveorder.php'; ";
        	echo "</script>";
	
		
		
	// javascript แสดงการ upload file
	
	

?>