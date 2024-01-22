<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/khoa.css">

 <!-- bootrap -->
 
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

                <li style="background-color: red;">
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
        <div id="form" class="">
            <!-- <div class="add_khoa col-2">
                <div class="form_text">
                    <form action="add_khoa.php" method="post">
                        <label for="">Mã khoa</label>
                        <input type="text" name="id_khoa" id="" required>
                        <label for="">Tên khoa</label>
                        <input type="text" name="name_khoa" id="" required>

                        <input type="submit" value="Thêm" class="btn_add_khoa" name="btn_khoa">
                    </form>
                </div>
            </div> -->

            <div class="show_khoa ">
                <div class="container">
                    <?php
                    include("./php/connect.php");

                    // Truy vấn dữ liệu từ cơ sở dữ liệu
                    $sql = "SELECT * FROM khoa";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã khoa</th>
                                    <th>Tên khoa</th>
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
                                            <?php echo $row['TenKhoa']; ?>
                                        </td>

                                    
                                        <td> <a href="form_sua_khoa.php?MaKhoa=<?php echo $row['MaKhoa']; ?>">Sửa</a>
                                            <a href="delete_khoa.php?MaKhoa=<?php echo $row['MaKhoa']; ?>">Xoá</a>
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

        <!-- bootrap -->
 
        <!-- end main -->
    </div>
</body>

</html>