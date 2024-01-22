<?php
include("./php/connect.php");

$id = $_GET['MaGiaoVien'];

// include("connect.php");

$sql = "SELECT * FROM giaovien WHERE MaGiaoVien = '$id'";

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

                <li style="background-color: red;">
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

                <li class="has-subnav">
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
            <div class="add_khoa">
                <form action="update_gv.php" method="post">
                    <input type="hidden" value="<?php echo $idgv ?>" name="id_gv">
                    <label for="">Mã khoa</label>
                    <select name="ma_khoa" required>
                        <?php
                        // Kết nối đến cơ sở dữ liệu
                        include("./php/connect.php");

                        // Truy vấn SQL để lấy danh sách khoa
                        $sql_khoa = "SELECT MaKhoa,TenKhoa FROM khoa";
                        $result_khoa = $conn->query($sql_khoa);

                        $options = "<option value=''>Chọn khoa</option>";

                        $selected_khoa = $row['MaKhoa'];
                        if ($result_khoa->num_rows > 0) {
                            while ($row_khoa = $result_khoa->fetch_assoc()) {
                                $selected = ($row_khoa['MaKhoa'] == $selected_khoa) ? 'selected' : '';
                                echo "<option value='{$row_khoa['MaKhoa']}' $selected>{$row_khoa['MaKhoa']} - {$row_khoa['TenKhoa']} </option>";
                            }
                        }
                        $conn->close();
                        ?>
                    </select>
                    <label for="">Mã giáo viên</label>
                    <input type="text" name="id_giaovien" id="" value="<?php echo $row['MaGiaoVien'] ?>" readonly>
                    <label for="">Tên giáo viên</label>
                    <input type="text" name="name_gv" id="" value="<?php echo $row['TenGiaoVien'] ?>">
                    <label for="">Ngày sinh</label>
                    <input type="date" name="ngaysinh" id="" value="<?php echo $row['NgaySinh'] ?>">
                    <label for="">Giới tính</label>
                    <!-- <input type="text" name="gender_gv" id="" value="<?php echo $row['GioiTinh'] ?>"> -->

                    <select name="gender_gv" id="gender_gv" value="<?php echo $row['GioiTinh']?>" >
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                    <label for="">Quê quán</label>
                    <input type="text" name="address_gv" id="" value="<?php echo $row['QueQuan'] ?>">
                    <label for="">Trình độ</label>
                    <!-- <input type="text" name="trinhdo" id="" value="<?php echo $row['TrinhDo'] ?>"> -->
                    <select name="trinhdo" id="trinhdo" value="<?php echo $row['TrinhDo'] ?>">
                        <option value="Giáo sư">Giáo sư</option>
                        <option value="Phó giáo sư">Phó giáo sư</option>
                        <option value="Tiến sĩ">Tiến sĩ</option>
                        <option value="Thạc sĩ">Thạc sĩ</option>
                    </select>
                    <label for="">Số điện thoại</label>
                    <input type="text" name="sdt_gv" id="" value="<?php echo $row['SDT'] ?>">
                    <label for="">Email</label>
                    <input type="email" name="email_gv" id="" value="<?php echo $row['Email'] ?>">


                    <input type="submit" value="Sửa" class="btn_sua_gv" name="btn_gv">
                </form>

            </div>


        </div>


    </div> <!-- end main -->
</body>

</html>