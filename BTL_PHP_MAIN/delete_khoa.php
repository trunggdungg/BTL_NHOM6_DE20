<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="wrap">
        <?php
       include("./php/connect.php");

        // // Lấy giá trị từ biến GET (ví dụ: username)
        // $idkhoa = $_POST['id_khoa'];

        // // Sử dụng biến thực thể để tránh tấn công SQL injection
        // $idkhoa = mysqli_real_escape_string($conn, $idkhoa);
    $idkhoa = $_GET["MaKhoa"];
        // Câu truy vấn DELETE
        $sql = "DELETE FROM khoa WHERE MaKhoa = ?";
        $stmt = $conn ->prepare($sql);
        $stmt ->bind_param("s",$idkhoa);


        if ($stmt-> execute()) {
            // echo "Xóa thành công";
            header("location: Khoa.php");

        } else {
            echo "Lỗi xóa: " . $conn->error;
        }

        $conn->close();
        ?>
    </div>
</body>

</html>