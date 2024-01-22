<?php
include("./php/connect.php");

if (isset($_POST['btn_gv'])) {
    $idgv = $_POST['id_gv'];
    $id_khoa_gv = $_POST['ma_khoa'];
    $id_giaovien = $_POST['id_giaovien'];
    $name_gv = $_POST['name_gv'];
    $ngaysinh = $_POST['ngaysinh'];
    $gender_gv = $_POST['gender_gv'];
    $address_gv = $_POST['address_gv'];
    $trinhdo = $_POST['trinhdo'];
    $sdt_gv = $_POST['sdt_gv'];
    $email_gv = $_POST['email_gv'];

    $sql = "UPDATE giaovien SET
            MaKhoa = ?,
            TenGiaoVien = ?,
            NgaySinh = ?,
            GioiTinh = ?,
            QueQuan = ?,
            TrinhDo = ?,
            SDT = ?,
            Email = ?
            WHERE MaGiaoVien = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die('Lỗi prepare: ' . $conn->error);
    }

    $stmt->bind_param("sssssssss", $id_khoa_gv, $name_gv, $ngaysinh, $gender_gv, $address_gv, $trinhdo, $sdt_gv, $email_gv, $id_giaovien);

    if ($stmt) {
        $stmt->bind_param("sssssssss", $id_khoa_gv, $name_gv, $ngaysinh, $gender_gv, $address_gv, $trinhdo, $sdt_gv, $email_gv, $id_giaovien);
        $stmt->execute();

        // Kiểm tra xem câu lệnh đã thực hiện thành công hay không
        if ($stmt->affected_rows > 0) {
            // echo "Cập nhật thành công";
            header("location: GiangVien.php");
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