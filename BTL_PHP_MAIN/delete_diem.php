<?php
include("./php/connect.php");

$idgv = $_GET["MaDiem"];

// In giá trị để kiểm tra
echo "ID Sinh viên: " . $idgv;

$sql = "DELETE FROM diem WHERE MaDiem = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die('Lỗi prepare: ' . $conn->error);
}

$stmt->bind_param("s", $idgv);

if ($stmt->execute()) {
    echo "Xóa thành công";
    // header("location: QuanLyDiem.php");
} else {
    echo "Lỗi xóa: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
