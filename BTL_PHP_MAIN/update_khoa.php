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

if (isset($_POST['btn_sua'])) {
    // Lấy dữ liệu từ form
    $idkhoa = $_POST['id_khoa'];
    $tenkhoa = $_POST['name_khoa'];

    // Truy vấn cập nhật
    $updatesql = "UPDATE `khoa` SET `TenKhoa`=? WHERE `MaKhoa`=?";
    $stmt = $conn->prepare($updatesql);

    // Thực hiện truy vấn
    if ($stmt) {
        $stmt->bind_param('ss', $tenkhoa, $idkhoa);
        $stmt->execute();

        // Kiểm tra xem câu lệnh đã thực hiện thành công hay không
        if ($stmt->affected_rows > 0) {
            // echo "Cập nhật thành công";
            header("location: Khoa.php");
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
</body>
</html>
