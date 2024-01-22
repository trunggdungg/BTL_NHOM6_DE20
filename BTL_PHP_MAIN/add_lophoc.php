<?php
include("./php/connect.php");

// Kiểm tra xem có dữ liệu được gửi từ form không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $ma_khoa = $_POST['ma_khoa'];
    $id_lophoc = $_POST['id_lophoc'];
    $name_lophoc = $_POST['name_lophoc'];

    // Kiểm tra xem các giá trị có hợp lệ không (ở đây bạn cần thêm kiểm tra)
    // Nếu mọi thứ đều hợp lệ, thực hiện truy vấn SQL INSERT
    $sql = "INSERT INTO lophoc (MaKhoa, MaLopHoc, TenLopHoc) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Kiểm tra lỗi prepare
    if (!$stmt) {
        die('Error in prepare statement');
    }

    // Bind các biến với statement
    $stmt->bind_param('sss', $ma_khoa, $id_lophoc, $name_lophoc);

    // Thực hiện execute
    if ($stmt->execute()) {
        // echo "Thêm mới thành công!";
        header("location: LopHoc.php");

    } else {
        echo "Có lỗi xảy ra khi thêm mới!";
    }

    // Đóng statement
    $stmt->close();
}

// Đóng kết nối
$conn->close();
?>
