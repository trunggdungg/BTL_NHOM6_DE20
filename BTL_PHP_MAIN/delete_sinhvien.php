<?php
include("./php/connect.php");

$idsv = $_GET["MaSinhVien"];

// Truy vấn kiểm tra xem sinh viên có điểm hay không
$sqlCheckDiem = "SELECT COUNT(*) as total FROM diem WHERE MaSinhVien = ?";
$stmtCheckDiem = $conn->prepare($sqlCheckDiem);
if (!$stmtCheckDiem) {
    die('Lỗi prepare: ' . $conn->error);
}

$stmtCheckDiem->bind_param("s", $idsv);
$stmtCheckDiem->execute();
$stmtCheckDiem->bind_result($total);
$stmtCheckDiem->fetch();

$stmtCheckDiem->close();

// Xác định thông báo dựa trên có điểm hay không
if ($total > 0) {
    echo '<script language="javascript">';
    echo 'var xacNhan = confirm("Sinh viên đang có điểm. Bạn có chắc chắn muốn xóa?");';
    echo 'if (xacNhan) {';

    // Xóa tất cả điểm của sinh viên
    $sqlDeleteDiem = "DELETE FROM diem WHERE MaSinhVien = ?";
    $stmtDeleteDiem = $conn->prepare($sqlDeleteDiem);

    if (!$stmtDeleteDiem) {
        die('Lỗi prepare: ' . $conn->error);
    }

    $stmtDeleteDiem->bind_param("s", $idsv);

    if ($stmtDeleteDiem->execute()) {
        $stmtDeleteDiem->close();

        // Tiếp tục xóa sinh viên
        $sqlDeleteSinhVien = "DELETE FROM sinhvien WHERE MaSinhVien = ?";
        $stmtDeleteSinhVien = $conn->prepare($sqlDeleteSinhVien);

        if (!$stmtDeleteSinhVien) {
            die('Lỗi prepare: ' . $conn->error);
        }

        $stmtDeleteSinhVien->bind_param("s", $idsv);

        if ($stmtDeleteSinhVien->execute()) {
            echo '  alert("Xóa sinh viên thành công!");';
            echo '  window.location.href="SinhVien.php";';
        } else {
            echo '  alert("Lỗi xóa sinh viên: ' . $stmtDeleteSinhVien->error . '");';
        }

        $stmtDeleteSinhVien->close();
    } else {
        echo '  alert("Lỗi xóa điểm: ' . $stmtDeleteDiem->error . '");';
    }

    echo '} else {';
    echo '  window.location.href = document.referrer;'; // Quay lại trang trước đó
    echo '}';
    echo '</script>';
} else {
    // Nếu không có điểm, thực hiện xóa sinh viên ngay lập tức
    $sqlDeleteSinhVien = "DELETE FROM sinhvien WHERE MaSinhVien = ?";
    $stmtDeleteSinhVien = $conn->prepare($sqlDeleteSinhVien);

    if (!$stmtDeleteSinhVien) {
        die('Lỗi prepare: ' . $conn->error);
    }

    $stmtDeleteSinhVien->bind_param("s", $idsv);

    if ($stmtDeleteSinhVien->execute()) {
        $stmtDeleteSinhVien->close();
        echo '<script language="javascript">';
        echo '  alert("Xóa sinh viên thành công!");';
        echo '  window.location.href="SinhVien.php";';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo '  alert("Lỗi xóa sinh viên: ' . $stmtDeleteSinhVien->error . '");';
        echo '  window.location.href="SinhVien.php";';
        echo '</script>';
    }
}

$conn->close();
?>
