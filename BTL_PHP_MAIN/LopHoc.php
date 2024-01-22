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

                <li style="background-color:red;">
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
                <form action="add_lophoc.php" method="post" onsubmit="return validateForm()" name="GV">
                    <label for="">Mã khoa</label>
                    <select name="ma_khoa" required>
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
                        $sql = "SELECT MaKhoa,TenKhoa FROM khoa";
                        $result = $conn->query($sql);

                        $options = "<option value=''>Chọn khoa</option>";

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Thêm cả mã khoa và tên khoa vào tùy chọn
                                $options .= "<option value='{$row['MaKhoa']}'>{$row['MaKhoa']}- {$row['TenKhoa']} </option>";

                            }
                        }

                        // Đóng kết nối
                        $conn->close();

                        echo $options;
                        ?>
                    </select>
                    <label for="">Mã lớp học</label>
                    <input type="text" name="id_lophoc" id="" required>
                    <label for="">Tên lớp học</label>
                    <input type="text" name="name_lophoc" id="" required>


                    <input type="submit" value="Thêm" class="btn_add_lophoc" name="btn_lophoc" required>
                </form>
            </div>

            <div class="show_giangvien">
                <div class="container">
                    <?php
                    include("./php/connect.php");

                    // Truy vấn dữ liệu từ cơ sở dữ liệu
                    $sql = "SELECT * FROM lophoc";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã khoa</th>
                                    <th>Mã lớp học</th>
                                    <th>Tên lớp học</th>
                                    <th>Thao tác</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                // Hiển thị dữ liệu từ mỗi hàng
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['MaKhoa']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['MaLopHoc']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['TenLopHoc']; ?>
                                        </td>


                                        <td> <a href="form_sua_lophoc.php?MaLopHoc=<?php echo $row['MaLopHoc']; ?>">Sửa</a>
                                            <a href="delete_lophoc.php?MaLopHoc=<?php echo $row['MaLopHoc']; ?>">Xoá</a>
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