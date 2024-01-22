<?php
include("./php/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $column = $_GET['column'];
    $value = $_GET['value'];

    // Kiểm tra xem cột được cập nhật có hợp lệ hay không
    $allowedColumns = array('MaSinhVien', 'MaMonHoc', 'DiemChuyenCan', 'DiemGiuaKi', 'DiemThiLan1', 'DiemThiLan2');
    if (!in_array($column, $allowedColumns)) {
        echo "Cột không hợp lệ";
        exit();
    }

    // Chuẩn bị câu lệnh SQL UPDATE
    $sql = "UPDATE diem SET $column = ? WHERE MaDiem = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die('Lỗi prepare: ' . $conn->error);
    }

    // Kiểm tra kiểu dữ liệu và bind tham số
    $stmt->bind_param("ss", $value, $id);

    $stmt->execute();

    // Kiểm tra xem câu lệnh đã thực hiện thành công hay không
    if ($stmt->affected_rows > 0) {
        echo "Cập nhật thành công";
    } else {
        echo "Không có dòng nào bị ảnh hưởng";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Phương thức không hợp lệ";
}
?>
