<?php
include("./php/connect.php");
 
// 
$id_lop = $_POST['ma_lop'];
$id_sv = $_POST['id_sinhvien'];
$ten_sv = $_POST['name_sv'];
$ngaysinh = $_POST['ngaysinh'];
$gioitinh = $_POST['gender_sv'];
$quequan = $_POST['address_sv'];
$cccd = $_POST['cccd_sv'];
$sdt = $_POST['sdt_sv'];
$email = $_POST['email_sv'];

// them
$sql = "INSERT INTO `sinhvien` (`MaLopHoc`, `MaSinhVien`,`TenSinhVien`,`NgaySinh`,`GioiTinh`,`QueQuan`,`CCCD`,`SDT`,`Email`)
        VALUES (?,?,?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssss", $id_lop,$id_sv,$ten_sv,$ngaysinh,$gioitinh,$quequan,$cccd,$sdt,$email);

if($stmt->execute()){
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("location: SinhVien.php");
        // echo"oke";
        exit(); 
    } else {
    // echo"fail";
    //    exit(); 
       header("location: SinhVien.php");
    }

   
} 


$stmt->close();
$conn->close();
?>
