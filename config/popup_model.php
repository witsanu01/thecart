<?php
    session_start();
    include_once('../config/functions.php');
    include_once('../config/connect.php');
//    $id = $_GET['id'];
    $rid = $_GET['repair_id'];
	
    //session_start();
    //$_SESSION["empid"] = $user->id;
	
    //$sql = "SELECT * FROM toolsquantity AS tq LEFT JOIN tools AS tl ON tq.tools_id=tl.tools_id WHERE `toolsQuantity_id`='$id'";
    //$mem = mysqli_fetch_assoc($members);


    $sql = "SELECT * FROM products  where id ='$rid'";
    $result = $conn->query($sql);
    $mem = $result ->fetch_assoc();
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>เลือกหมวดหมู่</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">
  <title></title>
</head>
<body>
  <main id="main">
    <section id="contact" class="contact">
      <div class="container mt-3">
        <center>
					<img class="img-rounded" height="250" width="250" src="/thecart/dbadmin/assets/img/product/<?php echo $mem['product_img_name'];?>"><br><br><br>
        </center> 
            <div class="container mt-5">
            <div class="container">
                <b>รหัสเมนู</b> <?php echo $mem['product_code']; ?><br><br>
              </div> 
              <div class="container">
                <b>ชื่อเมนู</b> <?php echo $mem['product_name']; ?><br><br>
              </div> 
              <div class="container">
              <b>ราคา</b> <?php echo $mem['product_price']; ?> บาท<br><br>
              </div>   
              <div class="container">
                <b>คงเหลือจำนวน</b> <?php echo $mem['qty']; ?> ชิ้น<br><br>
              </div> 
            </div>
    <center>
<div class="container">
</div>
    </center>    
</div>
</div>
</div>
</section><!-- End Contact Section -->
</main><!-- End #main -->
</body>
</html>
