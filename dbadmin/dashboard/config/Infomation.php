<?php
error_reporting(0);
include 'header.php'; 
include 'nav.php'; 
session_start();
error_reporting(0);
include("../../../config/connect.php");
include("../../../config/functions.php");

$updatedata = new DB_con();

if (isset($_POST['update'])) {

    $userid = $_SESSION['id'];
    $fname = $_POST['fullname'];
    $uname = $_POST['username'];
    $email = $_POST['useremail'];
    $password = md5($_POST['password']);
    $date = $_POST['regdate'];

    $sql = $updatedata->update($fname, $uname, $email, $password, $date, $userid);
    if ($sql) {
        echo "<script>alert('Updated Successfully!');</script>";
        echo "<script>window.location.href='../view/customer'</script>";
    } else {
        echo "<script>alert('Something went wrong! Please try again!');</script>";
        echo "<script>window.location.href='Infomation.php'</script>";
    }
}

?>
    <section class="content">
    <div class="content">
        <div class="container-fluid">
          <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title">แก้ไขข้อมูลลูกค้า</h4>
                  
                </div>
                <div class="card-body table-responsive">
                       <?php 

                        $userid = $_GET['id'];
                        $updateuser = new DB_con();
                        $sql = $updateuser->fetchonerecord($userid);
                        while($row = mysqli_fetch_array($sql)) {
                        ?>

                        <form action="" method="post">
                        <div class="mb-3">
                            <label for="firstname" class="form-label" style="color:">ชื่อ-นามสกุล</label>
                            <input type="text" class="form-control" name="fullname" 
                                value="<?php echo $row['fullname']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label" style="color:">ชื่อผู้ใช้</label>
                            <input type="text" class="form-control" name="username"
                                value="<?php echo $row['username']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" style="color:">อีเมล</label>
                            <input type="email" class="form-control" name="useremail" 
                                value="<?php echo $row['useremail']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phonenumber" style="color:">รหัสผ่าน</label>
                            <input type="password" class="form-control" name="password"
                                value="<?php echo $row['password']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phonenumber" style="color:">วันที่สมัครสมาชิก</label>
                            <input type="text" class="form-control" name="regdate"
                                value="<?php echo $row['regdate']; ?>" required>
                        </div>
                        <?php } ?>
                        <button type="submit" name="update" class="btn btn-warning">แก้ไขข้อมูล</button>
                        </form>

<!-- content -->
    </section>
  </div>
<?php 
include 'jqscript.php';
include 'footer.php';
include 'scchart.php';
?> 
