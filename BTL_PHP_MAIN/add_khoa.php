<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   

</head>
<body>
<?php
// require 'db/connect.php';
include("./php/connect.php");
if (isset($_POST['btn_khoa'])) {
 
// 
    $makhoa = $_POST['id_khoa'];
    $tenkhoa = $_POST['name_khoa'];
  
// include("connect.php");

    // them
    $sql = "INSERT INTO `khoa` (`MaKhoa`, `TenKhoa`)
            VALUES (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $makhoa, $tenkhoa);
    
    if($stmt->execute()){
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            header("location: Khoa.php");
            // echo"oke";
            exit(); 
        } else {
        // echo"fail";
        //    exit(); 
           header("location: Khoa.php");
        }

       
    } 
    

    $stmt->close();
    $conn->close();
}
?>
<!--  -->


</body>
</html>