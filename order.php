<?php require_once('conn.php');
$i=0;
?>
<?php
$sql1 = "SELECT * FROM `order_head`";
$query1 = mysqli_query($con,$sql1);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<title>admin console</title>
</head>
<style>
  .edit{
    color:#000;
  }
  .state{
    display:none;
  }
</style>
<body>
  <?php
if(!empty ($_SESSION['alert'])){
  ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Rabbitshop!</strong> <?php echo $_SESSION['alert'];?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php }
unset($_SESSION['alert']);
?>
   <h1>คำสั่งซื้อใหม่</h1>
<table width="139%" class="table table-responsive-md">
  <tr class="table-danger" >
    <td width="72">ที่</td>
    <td>รหัสคำสั่งซื้อ</td>
 <td width="137">ชื่อลูกค้า</td>
  <td width="133">ที่อยู่</td>
    <td width="122">รายการสินค้าที่สั่งซื้อ</td>
    <td width="131">ราคารวม</td>
    <td width="200">สถานะของสินค้า</td>
    <td class="state">state id</td>
     <td width="132">วันที่สั่งซื้อ</td>
     <td width="137">ประเภทการชำระเงิน</td>
    <td width="379">ตัวเลือก</td>
    <td width="150"></td>
  </tr>
   <?php do { ?>
   <?php $i= $i+1; ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo$row_Recordset1['o_id']; ?></td>
    <td><?php echo $row_Recordset1['o_name']; ?></td>
      <td><?php echo $row_Recordset1['o_addr']; ?></td>
    <td><a href="member_order_detail.php?id=<?php echo $row_Recordset1['order_id'] ?>">ดูรายการ</a></td>
    <td><?php echo $row_Recordset1['o_total']; ?></td>
    <td><?php if($row_Recordset1['o_status'] == 1){
      echo "สั่งซื้อแล้ว";
    }else if($row_Recordset1['o_status'] == 2){
      echo"ร้านค้ากำลังนำสินค้าส่งขนส่ง";
    }else if($row_Recordset1['o_status'] == 3){
      echo"ขนส่งกำลังจัดส่งสินค้า";
    }else if($row_Recordset1['o_status'] == 4){
      echo"ได้รับสินค้าแล้ว";
    }
    ?><a href="#" class="edit" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-edit"></i></a></td>
    <td class="state"><?php echo $row_Recordset1['o_status']; ?></td>
    <td><?php echo $row_Recordset1['o_dttm']; ?></td>
     <td><?php echo $row_Recordset1['paytype']; ?></td>
     <td height="50px"><a href="print.php?order=<?php echo $row_Recordset1['o_id'] ?>" ><button width ="300px" class="btn btn-primary" id ="print" width="100px">พิมพ์ใบจ่ากล่อง</button></a></td>
     <tr>
     <td width="72"><table width="72" border="0">
      <tr>
    </table>

  <?php } while ($row_Recordset1 = mysqli_fetch_assoc($query1)); ?>
</table>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action ="update_state.php" method="post">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">อัพเดตสถานะคำสั่งซื้อ</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <input type="hidden" id="update_id" name="update_id">
      <select class="form-select" aria-label="Default select example" id="o_status" name="o_status">
  <option value="1">สั่งซื้อแล้ว</option>
  <option value="2">ร้านค้ากำลังนำสินค้าส่งขนส่ง</option>
  <option value="3">ขนส่งกำลังจัดส่งสินค้า</option>
  <option value="4">ได้รับสินค้าแล้ว</option>
</select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="updatedata"  class="btn btn-primary">Update</button>
   </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
       $('.edit').on('click',function(){
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
         }).get();

         console.log(data);
         $('#update_id').val(data[1]);
         $('#o_status').val(data[7]);
       });
   });
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
