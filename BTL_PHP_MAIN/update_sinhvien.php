
<?php
include("./php/connect.php");

if (isset($_POST['btn_sua_sinhvien'])) {
    // Lấy dữ liệu từ form
    $id_lop = $_POST['ma_lop'];
    $id_sv = $_POST['id_sinhvien'];
    $ten_sv = $_POST['name_sv'];
    $ngaysinh = $_POST['ngaysinh'];
    $gioitinh = $_POST['gender_sv'];
    $quequan = $_POST['address_sv'];
    $cccd = $_POST['cccd_sv'];
    $sdt = $_POST['sdt_sv'];
    $email = $_POST['email_sv'];
    

    // Truy vấn cập nhật
    $updatesql = "UPDATE `sinhvien` SET `MaLopHoc`=?,`TenSinhVien`=?,`NgaySinh`=?,`GioiTinh`=?,`QueQuan`=?,`CCCD`=?,`SDT`=?,`Email`=? WHERE `MaSinhVien`=?";
    $stmt = $conn->prepare($updatesql);

    // Thực hiện truy vấn
    if ($stmt) {
        $stmt->bind_param('sssssssss',$id_lop,$ten_sv,$ngaysinh,$gioitinh,$quequan,$cccd,$sdt,$email , $id_sv);
        $stmt->execute();

        // Kiểm tra xem câu lệnh đã thực hiện thành công hay không
        if ($stmt->affected_rows > 0) {
            // echo "Cập nhật thành công";
            header("location: SinhVien.php");
        } else {
            echo "Không có dòng nào bị ảnh hưởng";
        }

        $stmt->close();
    } else {
        echo "Lỗi trong quá trình chuẩn bị câu lệnh: " . $conn->error;
    }
    $conn->close();
}
?>

