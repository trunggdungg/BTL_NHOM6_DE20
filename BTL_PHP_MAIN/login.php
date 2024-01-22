<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include("./php/connect.php");

if(isset($_POST['BTN-login'])){
    $user = $_POST["username"];
    $pass = $_POST["psw"];

    $sql = "SELECT TenNguoiDung, MatKhau FROM nguoidung WHERE TenNguoiDung = ? AND MatKhau = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);
    
    if($stmt->execute()){
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          
            header("location: index.html");
            exit(); 
        } else {
           header("location: Login.html");
           exit(); 
        }
    } 
    

    $stmt->close();
    $conn->close();
}
?>
</body>
</html>