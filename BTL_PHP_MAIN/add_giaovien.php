<?php
include("./php/connect.php");
 
// 
$id_khoagv = $_POST['ma_khoa'];
$id_gv = $_POST['id_giaovien'];
$ten_gv = $_POST['name_gv'];
$ngaysinh = $_POST['ngaysinh'];
$gioitinh = $_POST['gender_gv'];
$quequan = $_POST['address_gv'];
$trinhdo = $_POST['trinhdo'];
$sdt = $_POST['sdt_gv'];
$emai = $_POST['email_gv'];
// include("connect.php");

// them
$sql = "INSERT INTO `giaovien` (`MaGiaoVien`, `TenGiaoVien`,`NgaySinh`,`GioiTinh`,`QueQuan`,`TrinhDo`,`SDT`,`MaKhoa`,`Email`)
        VALUES (?,?,?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssss", $id_gv,$ten_gv,$ngaysinh,$gioitinh,$quequan,$trinhdo,$sdt,$id_khoagv,$emai);

if($stmt->execute()){
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("location: GiangVien.php");
        // echo"oke";
        exit(); 
    } else {
    // echo"fail";
    //    exit(); 
       header("location: GiangVien.php");
    }

   
} 


$stmt->close();
$conn->close();
?>
