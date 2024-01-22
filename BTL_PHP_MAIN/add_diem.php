<?php
include("./php/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_diem = $_POST['id_diem'];
    $id_sv = $_POST['id_sinhvien'];
    $id_monhoc = $_POST['id_monhoc'];
    $diemcc = $_POST['diemchuyencan'];
    $diemgiuaki = $_POST['diemgiuaki'];
    $diemthi1 = $_POST['diemthi1'];
    $diemthi2 = $_POST['diemthi2'];

    $trongso_chuyencan = 0.1;
    $trongso_giuaki = 0.2;
    $trongso_thi1 = 0.3;
    $trongso_thi2 = 0.4;

    // Tính điểm cuối kì
    $diemcuoiki = ($diemcc * $trongso_chuyencan) +
        ($diemgiuaki * $trongso_giuaki) +
        ($diemthi1 * $trongso_thi1) +
        ($diemthi2 * $trongso_thi2);

    // Chuẩn bị câu lệnh SQL INSERT
    $sql = "INSERT INTO `diem` (`MaDiem`, `MaSinhVien`, `MaMonHoc`, `DiemChuyenCan`, `DiemGiuaKi`, `DiemThiLan1`, `DiemThiLan2`, `DiemCuoiKi`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die('Lỗi prepare: ' . $conn->error);
    }

    // Kiểm tra kiểu dữ liệu và bind tham số
    $stmt->bind_param("sssssssd", $id_diem, $id_sv, $id_monhoc, $diemcc, $diemgiuaki, $diemthi1, $diemthi2, $diemcuoiki);

    // Thực hiện câu lệnh INSERT
    if ($stmt->execute()) {
        header("location: QuanLyDiem.php");
        exit();
    } else {
        echo "Lỗi khi thêm dữ liệu vào database.";
    }

    $stmt->close();
    $conn->close();
}
?>
