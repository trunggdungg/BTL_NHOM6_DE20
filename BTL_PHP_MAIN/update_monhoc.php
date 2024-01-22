
<?php
include("./php/connect.php");

if (isset($_POST['btn_sua_mon'])) {
    // Lấy dữ liệu từ form
    $id_mon = $_POST['id_monhoc'];
    $namemh = $_POST['name_monhoc'];
    $stc = $_POST['sotinchi'];
    $hoc_ky = $_POST['hocky'];


    // Truy vấn cập nhật
    $updatesql = "UPDATE `monhoc` SET `TenMonHoc`=?, `SoTinChi`=?,`HocKy` = ? WHERE `MaMonHoc`=?";
    $stmt = $conn->prepare($updatesql);

    // Thực hiện truy vấn
    if ($stmt) {
        $stmt->bind_param('ssss', $namemh,$stc,$hoc_ky , $id_mon);
        $stmt->execute();

        // Kiểm tra xem câu lệnh đã thực hiện thành công hay không
        if ($stmt->affected_rows > 0) {
            // echo "Cập nhật thành công";
            header("location: MonHoc.php");
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

