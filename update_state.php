<?php
echo $_POST['update_id'].$_POST['o_status'];

session_start();
include('conn.php');
if(isset($_POST['updatedata']))
    {   
        $id = $_POST['update_id'];
        
        $state = $_POST['o_status'];
        

        $query = "UPDATE order_head SET o_status = '$state' WHERE o_id='$id'  ";
        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            $_SESSION['alert']='อัพเดทสถานะสำเร็จ';
            header("Location:adminconsole.php?p=order");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>


