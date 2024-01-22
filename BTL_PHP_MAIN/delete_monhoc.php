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
       
    $mamonhoc = $_GET["MaMonHoc"];
        // Câu truy vấn DELETE
        $sql = "DELETE FROM monhoc WHERE MaMonHoc = ?";
        $stmt = $conn ->prepare($sql);
        $stmt ->bind_param("s",$mamonhoc);


        if ($stmt-> execute()) {
            // echo "Xóa thành công";
            header("location: MonHoc.php");

        } else {
            echo "Lỗi xóa: " . $conn->error;
        }

        $conn->close();
        ?>
    </div>
</body>

</html>