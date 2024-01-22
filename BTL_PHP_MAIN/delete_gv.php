<?php
include("./php/connect.php");

$idgv = $_GET["MaGiaoVien"];

// In giá trị để kiểm tra
echo "ID Giáo viên: " . $idgv;

$sql = "DELETE FROM giaovien WHERE MaGiaoVien = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die('Lỗi prepare: ' . $conn->error);
}

$stmt->bind_param("s", $idgv);

if ($stmt->execute()) {
    echo "Xóa thành công";
    header("location: GiangVien.php");
} else {
    echo "Lỗi xóa: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
