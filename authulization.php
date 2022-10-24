<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" <!-- sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Hello, world!</title>
  </head>
  <body>
<?php
session_start();
        if(isset($_POST['username'])){
				//connection
                  include("conn.php");
				//รับค่า user & password
                  $Username = $_POST['username'];
                  $Password = $_POST['password'];
				//query 
                  $sql="SELECT * FROM login Where username='".$Username."' and password='".$Password."' ";

                  $result = mysqli_query($con,$sql);
				
                  if(mysqli_num_rows($result)==1){
                    

                      $row = mysqli_fetch_array($result);

                        $_SESSION["User_name"] = $row["username"];
                        $_SESSION["User_password"] = $row["password"];
                        $_SESSION["logged"]=1;
                      echo '<script type="text/javascript">
  					swal.fire("Rabbitshop", "Login Success", "success",10000);
  					</script>';
                      header("refresh:2;url=index.php");
                       if($Username =='admin'){
                        $_SESSION["User_name"] = $row["name"];
                        $_SESSION["logged"]=1;
                        echo '<script type="text/javascript">
              swal.fire("Rabbitshop", "Admin Login Success", "success",10000);
              </script>';
                        header("refresh:2;url=adminconsole.php?p=0");
                       } 

}else{
                    echo "<script>";
                        echo 's
wal(""," user หรือ  password ไม่ถูกต้อง","error");'; 
                        echo "window.history.back()";
                    echo "</script>";
       } 
}

            
?>
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
