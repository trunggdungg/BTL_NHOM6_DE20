<?php
include("./php/connect.php");

$id_diemrl = $_GET["MaDiemRL"];

// In giá trị để kiểm tra
echo "ID Điểm rèn luyện: " . $id_diemrl;

$sql = "DELETE FROM diemrl WHERE MaDiemRL = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die('Lỗi prepare: ' . $conn->error);
}

$stmt->bind_param("s", $id_diemrl);

if ($stmt->execute()) {
    echo "Xóa thành công";
    header("location: QuanLyDiemRL.php");
} else {
    echo "Lỗi xóa: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
