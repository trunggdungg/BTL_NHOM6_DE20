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

if (isset($_POST['btn_diemrl'])) {
    // Lấy dữ liệu từ form
    $id_diemrl = $_POST['id_diemrl'];
    $id_sv = $_POST['id_sinhvien'];
    $hoc_ky = $_POST['hocky'];
    $tong_diem = $_POST['tongdiem'];

    // Xác định xếp loại
    if ($tong_diem < 30) {
        $xep_loai = "Yếu";
    } elseif ($tong_diem >= 30 && $tong_diem < 50) {
        $xep_loai = "Trung bình";
    } elseif ($tong_diem >= 50 && $tong_diem < 80) {
        $xep_loai = "Khá";
    } elseif ($tong_diem >= 80 && $tong_diem <= 100) {
        $xep_loai = "Tốt";
    } else {
        $xep_loai = "Không xác định";
    }

    // Chuẩn bị câu lệnh SQL UPDATE
    $sql = "UPDATE diemrl SET
        MaSinhVien = ?,
        HocKy = ?,
        TongDiem = ?,
        XepLoai = ?
        WHERE MaDiemRL = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die('Lỗi prepare: ' . $conn->error);
    }

    // Kiểm tra kiểu dữ liệu và bind tham số
    $stmt->bind_param("sssss", $id_sv, $hoc_ky, $tong_diem, $xep_loai, $id_diemrl);

    $stmt->execute();

    // Kiểm tra xem câu lệnh đã thực hiện thành công hay không
    if ($stmt->affected_rows > 0) {
        // Chuyển hướng sau khi thêm thành công
        header("location: QuanLyDiemRL.php");
    } else {
        echo "Không có dòng nào bị ảnh hưởng";
    }

    $stmt->close();
    $conn->close();
}
?>
</body>
</html>
