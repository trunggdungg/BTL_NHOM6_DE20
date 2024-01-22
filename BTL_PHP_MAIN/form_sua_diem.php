<?php
include("./php/connect.php");

$id_diem = $_GET['MaDiem'];

// include("connect.php");

$sql = "SELECT * FROM diem WHERE MaDiem = '$id_diem'";

$result = mysqli_query($conn, $sql);


// Lấy dữ liệu dưới dạng mảng kết hợp
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/khoa.css">

    <style>
        #nav>li {
            height: 70px;
            text-align: center;
            justify-content: center;
            background-color: #fff;
            margin-top: 30px;
            /* padding-top:25px ; */
            line-height: 70px;
            border: 1px solid aquamarine;

        }
    </style>
</head>

<body>
    <div class="main">
        <!-- header -->
        <div id="header">
            <div class="text-header">
                <h1>Quản lý điểm sinh viên</h1>
            </div>

            <!-- nút login -->
            <button class="btn-login" type="button"><a href="Login.html">Đăng xuất</a></button>

        </div>
        <!-- end header -->
        <!-- phần menu -->
        <div id="menu">
            <ul id="nav">

                <li>
                    <a href="index.php">
                        Quản lý sinh viên
                        <i class="nav-arow-down ti-angle-down"></i>
                    </a>

                </li>

                <li >
                    <a href="GiangVien.php">
                        Quản lý giảng viên
                        <i class="nav-arow-down ti-angle-down"></i>
                    </a>

                </li>

                <li>
                    <a href="MonHoc.php">
                        Quản lý môn học
                        <i class="nav-arow-down ti-angle-down"></i>
                    </a>

                </li>

                <li>
                    <a href="LopHoc.php">
                        Quản lý lớp học
                        <i class="nav-arow-down ti-angle-down"></i>
                    </a>

                </li>

                <li>
                    <a href="Khoa.php">
                        Quản lý khoa
                        <i class="nav-arow-down ti-angle-down"></i>
                    </a>

                </li>

                <li style="background-color: red;">
                    <a href="QuanLyDiem.php">
                        Quản lý điểm
                        <i class="nav-arow-down ti-angle-down"></i>
                    </a>
                </li>

                <li>
                    <a href="QuanLyDiemRL.php">
                        Quản lý điểm rèn luyện
                        <i class="nav-arow-down ti-angle-down"></i>
                    </a>

                </li>

                <li>
                    <a href="NguoiDung.php">
                        Quản lý người dùng
                        <i class="nav-arow-down ti-angle-down"></i>
                    </a>

                </li>

            </ul>


        </div>


        <!-- phần form nhập -->
        <div id="form">
            <div class="add_lophoc col-2">
                <form action="update_diem.php" method="post" onsubmit="return validateForm()" name="diem">
                <input type="hidden" value="<?php echo $madiem ?>" name="id_diem">
                    <!-- <label for="">Mã điểm</label>
                    <input type="text" name="id_diem" id="" value="<?php echo $row['MaDiem'] ?>" required readonly> -->
                    <label for="">Mã sinh viên</label>
                    <input type="text" name="id_sinhvien" id="" value="<?php echo $row['MaSinhVien'] ?>" required readonly>
                    
                    <label for="">Mã môn học</label>
                    <select name="id_monhoc" required>
                        <?php
                        // Kết nối đến cơ sở dữ liệu
                        $servername = "localhost:3308";
                        $username = "root";
                        $password = "";
                        $dbname = "qldiem";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Kiểm tra kết nối
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Truy vấn SQL để lấy danh sách môn học
                        $sql = "SELECT MaMonHoc, TenMonHoc FROM monhoc"; // Thêm MaMonHoc vào câu truy vấn
                        $result = $conn->query($sql);
                        $options = "<option value=''>Chọn môn học</option>";

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Thêm cả mã môn học và tên môn học vào tùy chọn
                                $options .= "<option value='{$row['MaMonHoc']}'>{$row['TenMonHoc']} </option>";
                            }
                        }

                        // Đóng kết nối
                        $conn->close();

                        echo $options;
                        ?>
                        <label for="">Điểm chuyên cần</label>
                        <input type="text" name="diemchuyencan" id="" value="" required>
                        <label for="">Điểm giữa kì</label>
                        <input type="text" name="diemgiuaki" id="" value=""  required>
                        <label for="">Điểm thi lần 1</label>
                        <input type="text" name="diemthi1" id="" value=""  required>
                        <label for="">Điểm thi lần 2</label>
                        <input type="text" name="diemthi2" id="" value=""  required>
                        
                        <input type="submit" value="Sửa" class="btn_add_diem" name="btn_diem" required>
                </form>
            </div>


        </div>


    </div> <!-- end main -->
</body>

</html>