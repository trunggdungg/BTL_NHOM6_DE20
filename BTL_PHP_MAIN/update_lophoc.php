
<?php
include("./php/connect.php");

if (isset($_POST['btn_sua_lophoc'])) {
    // Lấy dữ liệu từ form
    $id_khoa = $_POST['ma_khoa'];
    $id_lophoc = $_POST['id_lophoc'];
    $ten_lophoc = $_POST['name_lophoc'];

    // Truy vấn cập nhật
    $updatesql = "UPDATE `lophoc` SET `MaKhoa`=?, `TenLopHoc`=? WHERE `MaLopHoc`=?";
    $stmt = $conn->prepare($updatesql);

    // Thực hiện truy vấn
    if ($stmt) {
        $stmt->bind_param('sss',$id_khoa , $ten_lophoc , $id_lophoc);
        $stmt->execute();

        // Kiểm tra xem câu lệnh đã thực hiện thành công hay không
        if ($stmt->affected_rows > 0) {
            // echo "Cập nhật thành công";
            header("location: LopHoc.php");
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

