<?php 

    // Database connection
    include("../../../config/connect.php");
    
    if(isset($_POST["submit"])) {
        // Set image placement folder
        $target_dir = "../../assets/img/category/";
        $catName = basename($_POST['catName']);
        $uploadpic = basename($_FILES["fileUpload"]["name"]);
        // Get file path
        $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
        // Get file extension
        $imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Allowed file types
        $allowd_file_ext = array("jpg", "jpeg", "png");

        if (!file_exists($_FILES["fileUpload"]["tmp_name"])) {
            $resMessage = array(
            );
                     echo '<script type="text/javascript">';
                     echo 'setTimeout(function () { swal.fire({
                         title: "ผิดพลาด!",
                         text: "กรุณาเลือกไฟล์ภาพ !!",
                         type: "error",
                         icon: "error"
                     });';
                     echo '}, 500 );</script>';
 
         } else if (!in_array($imageExt, $allowd_file_ext)) {
             $resMessage = array(
             );   
                     echo '<script type="text/javascript">';
                     echo 'setTimeout(function () { swal.fire({
                         title: "ผิดพลาด",
                         text: "อัพโหลดได้แค่ .jpg, .jpeg และ .png เท่านั้น !!",
                         type: "error",
                         icon: "error"
                     });';
                     echo '}, 500 );</script>';
                              
         } else if ($_FILES["fileUpload"]["size"] > 2097152) {
             $resMessage = array(
             );
                     echo '<script type="text/javascript">';
                     echo 'setTimeout(function () { swal.fire({
                         title: "ผิดพลาด!",
                         text: "ไฟล์ต้องมีขนาดไม่เกิน 2Mb !!",
                         type: "error",
                         icon: "error"
                     });';
                     echo '}, 500 );</script>';
             
         } else if (file_exists($target_file)) {
             $resMessage = array(
             );
                     echo '<script type="text/javascript">';
                     echo 'setTimeout(function () { swal.fire({
                         title: "ผิดพลาด!",
                         text: "ชื่อไฟล์นี้ซ้ำ",
                         type: "error",
                         icon: "error"
                     });';
                     echo '}, 500 );</script>';
 
         } else {
        
            if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                
                $sql = "INSERT INTO categories (catName,catPic) 
                VALUES ('$catName','$uploadpic')";        

                $stmt = $conn->prepare($sql);
                 if($stmt->execute()){
                    $resMessage = array(
                    );                 
                    echo '<script type="text/javascript">';
                    echo 'setTimeout(function () { swal.fire({
                        title: "สำเร็จ!",
                        text: "เพิ่มหมวดหมู่เรียบร้อย",
                        type: "success",
                        icon: "success"
                    });';
                    echo '}, 500 );</script>';
            
                    echo '<script type="text/javascript">';
                    echo 'setTimeout(function () { 
                        window.location.href = "../view/category.php";';
                    echo '}, 2000 );</script>';
                   
                 }
            } else {
                $resMessage = array(
                    "status" => "alert-danger",
                    "message" => "Image coudn't be uploaded."
                );
            }
        
        
    }
} 
    
?>