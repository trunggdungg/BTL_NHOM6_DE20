<?php
include("./php/connect.php");

$id_sv = $_GET['MaSinhVien'];

// include("connect.php");

$sql = "SELECT * FROM sinhvien WHERE MaSinhVien = '$id_sv'";

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

                <li style="background-color: red;">
                    <a href="SinhVien.php">
                        Quản lý sinh viên
                        <i class="nav-arow-down ti-angle-down"></i>
                    </a>

                </li>

                <li>
                    <a href="GiangVien.php">
                        Quản lý giảng viên
                        <i class="nav-arow-down ti-angle-down"></i>
                    </a>

                </li>

                <li>
                    <a href="#">
                        Quản lý môn học
                        <i class="nav-arow-down ti-angle-down"></i>
                    </a>

                </li>

                <li >
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

                <li >
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
            <div class="add_lop">
                <form action="update_sinhvien.php" method="post">
                    <input type="hidden" value="<?php echo $masinhvien ?>" name="id_sinhvien">
                    <label for="">Mã lớp</label>
                    <select name="ma_lop" required>
                        <?php
                        // Kết nối đến cơ sở dữ liệu
                        include("./php/connect.php");

                        // Truy vấn SQL để lấy danh sách khoa
                        $sql_lop = "SELECT MaLopHoc,TenLopHoc FROM lophoc";
                        $result_lop = $conn->query($sql_lop);

                        $options = "<option value=''>Chọn lớp học</option>";

                        $selected_lop = $row['MaLopHoc'];
                        if ($result_lop->num_rows > 0) {
                        while ($row_lop = $result_lop->fetch_assoc()) {
                            $selected = ($row_lop['MaLopHoc'] == $selected_lop) ? 'selected' : '';
                            echo "<option value='{$row_lop['MaLopHoc']}' $selected>{$row_lop['MaLopHoc']} - {$row_lop['TenLopHoc']} </option>";
                        }
                    }
                        $conn->close();
                        ?>
                    </select>
                    <label for="">Mã sinh viên</label>
                    <input type="text" name="id_sinhvien" id="" value="<?php echo $row['MaSinhVien']?>" required readonly> 
                    <label for="">Tên sinh viên</label>
                    <input type="text" name="name_sv" id="" value="<?php echo $row['TenSinhVien']?>" required>
                    <label for="">Ngày sinh</label>
                    <input type="date" name="ngaysinh" id="" value="<?php echo $row['NgaySinh']?>" required>
                    <label for="">Giới tính</label>
                    <select name="gender_sv" id="gender_sv" value="<?php echo $row['GioiTinh']?>" required>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                    <label for="">Quê quán</label>
                    <input type="text" name="address_sv" id="" value="<?php echo $row['QueQuan']?>" required>
                    <label for="">CCCD</label>
                    <input type="text" name="cccd_sv" id="" value="<?php echo $row['CCCD']?>" required>
                    <label for="">Số điện thoại</label>
                    <input type="tel" name="sdt_sv" id="" value="<?php echo $row['SDT']?>" pattern="[0-9]{10}" required>
                    <label for="">Email</label>
                    <input type="email" name="email_sv" id="" value="<?php echo $row['Email']?>">

                    <input type="submit" value="Sửa" class="btn_sua_sinhvien" name="btn_sua_sinhvien">
                </form>

            </div>


        </div>


    </div> <!-- end main -->
</body>

</html>