<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mobile banking</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>
<body>
<h1>ชำระเงิน</h1>
<h3>ภายใน 00:00</h3>
<?php
    session_start();
    echo'<h2>'.$_SESSION["total"].'บาท'.'</h2>';
    $total = $_SESSION["total"];
    
require_once("lib/PromptPayQR.php");
$PromptPayQR = new PromptPayQR(); // new object
$PromptPayQR->size = 8; // Set QR code size to 8

$PromptPayQR->id = '0981021476'; // PromptPay ID
$PromptPayQR->amount = $total; // Set amount (not necessary)
echo '<img src="' . $PromptPayQR->generate() . '" />';
    ?>

<form action="upload.php" method="post" enctype="multipart/form-data">
<div class="input-group mb-3">
  <input type="file" class="form-control" id="file" name="upload">
  <label class="input-group-text" for="file">อัพโหลดหลักฐานการโอน</label>
<input type="submit" value="Upload Image" name="submit" class="btn btn-primary">
</div> 
</form>
<script>
let timeSecond = 600;
const timeH = document.querySelector("h3");

displayTime(timeSecond);

const countDown = setInterval(() => {
  timeSecond--;
  displayTime(timeSecond);
  if (timeSecond == 0 || timeSecond < 1) {
    endCount();
    clearInterval(countDown);
  }
}, 1000);

function displayTime(second) {
  const min = Math.floor(second / 60);
  const sec = Math.floor(second % 60);
  timeH.innerHTML = `ภายใน 
  ${min < 10 ? "0" : ""}${min}:${sec < 10 ? "0" : ""}${sec}
  `;
}

function endCount() {
  timeH.innerHTML = "Time out";
alert('time is up!');
}

// *********************
// This Code is for only the floating card in right bottom corner
// **********************

const touchButton = document.querySelector(".float-text");
const card = document.querySelector(".float-card-info");
const close = document.querySelector(".gg-close-r");

touchButton.addEventListener("click", moveCard);
close.addEventListener("click", moveCard);

function moveCard() {
  card.classList.toggle("active");
}

</script>
</body>
</html>