<?php
include("./php/connect.php");

$id = $_GET['MaDiemRL'];

// include("connect.php");

$sql = "SELECT * FROM diemrl WHERE MaDiemRL = '$id'";

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

                    <li>
                        <a href="#">
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
                        <a href="#">
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

                    <li  style="background-color: red;">
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
                    <form action="update_diemrl.php" method="post">
                    <input type="hidden" value="<?php echo $id ?>" name="id_gv"> 
                    <label for="">Mã điểm rèn luyện</label>
                    <input type="text" name="id_diemrl" id="" value="<?php echo $row['MaDiemRL'] ?>" readonly>
                    <label for="">Mã sinh viên</label >
                    <input type="text" name="id_diemrl" id="" value="<?php echo $row['MaSinhVien'] ?>" readonly>
                    <label for="">Học kỳ</label>
                    <input type="number" name="hocky" id=""  value="<?php echo $row['HocKy'] ?>" onchange="calculateFinalScore()" required>
                    <label for="">Tổng điểm</label>
                    <input type="text" name="tongdiem" id="" onchange="calculateFinalScore()" required>
                    <input type="submit" value="Sửa" class="btn_add_diem" name="btn_diemrl" required>

                    </form>

                </div>

                
            </div>


        </div> <!-- end main -->
    </body>

    </html>