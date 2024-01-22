<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/khoa.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* #nav>li {
            height: 70px;
            text-align: center;
            justify-content: center;
            background-color: #fff;
            margin-top: 30px;
         
            line-height: 70px;
            border: 1px solid aquamarine;

        } */
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
                    <a href="MonHoc.php">
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

                <li>
                    <a href="QuanLyDiem.php">
                        Quản lý điểm
                        <i class="nav-arow-down ti-angle-down"></i>
                    </a>

                </li>

                <li style="background-color:red;">
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
                <form action="add_diemrl.php" method="post" onsubmit="return validateForm()" name="GV">
                    <!-- <label for="">Mã điểm rèn luyện</label>
                    <input type="text" name="id_diemrl" id="" required> -->
                    <label for="">Mã sinh viên</label>
                    <select name="id_sinhvien" required>
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

                        // Truy vấn SQL để lấy danh sách khoa
                        $sql = "SELECT MaSinhVien,TenSinhVien FROM sinhvien";
                        $result = $conn->query($sql);
                        $options = "<option value=''>Chọn sinh viên</option>";

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Thêm cả mã khoa và tên khoa vào tùy chọn
                                $options .= "<option value='{$row['MaSinhVien']}'>{$row['MaSinhVien']}- {$row['TenSinhVien']} </option>";

                            }
                        }

                        // Đóng kết nối
                        $conn->close();

                        echo $options;
                        ?>
                    </select>
                    <label for="">Học kỳ</label>
                    <input type="number" name="hocky" id="" onchange="calculateFinalScore()" required>
                    <label for="">Tổng điểm</label>
                    <input type="text" name="tongdiem" id="" onchange="calculateFinalScore()" required>

                    <input type="submit" value="Thêm" class="btn_add_diem" name="btn_diemrl" required>
                </form>
            </div>

            <div class="show_giangvien">
                <div class="container">
                    <?php
                    include("./php/connect.php");

                    // Truy vấn dữ liệu từ cơ sở dữ liệu
                    $sql = "SELECT * FROM diemrl";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã điểm rèn luyện</th>
                                    <th>Mã sinh viên</th>
                                    <th>Học kỳ</th>
                                    <th>Tổng điểm</th>
                                    <th>Xếp loại</th>
                                    <th>Thao tác </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php


                                // Hiển thị dữ liệu từ mỗi hàng
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['MaDiemRL']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['MaSinhVien']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['HocKy']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['TongDiem']; ?>
                                        </td>
                                        <td>
                                        <?php echo $row['XepLoai']; ?>
                                        </td>
                                        <td>

                                            <a href="form_sua_diemrl.php?MaDiemRL=<?php echo $row['MaDiemRL']; ?>">Sửa</a>
                                            <a href="delete_diemrl.php?MaDiemRL=<?php echo $row['MaDiemRL']; ?>">Xoá</a>
                                        </td>

                                    </tr>
                                    <?php

                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                    } else {
                        echo "Không có kết quả";
                    }
                    $conn->close();
                    ?>

                    <!-- <button type="button"> <a href="Khoa.php">Thêm</a></button> -->

                    <form action="search.php">

                        <!-- tìm kiếm -->

                        <!-- <input type="submit" value="Tìm kiếm" name="search"> -->

                    </form>


                </div>
            </div>
        </div>


    </div>
    <!-- end main -->


</body>

</html>