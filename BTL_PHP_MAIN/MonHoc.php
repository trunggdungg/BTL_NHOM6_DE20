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

                <li >
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

                <li style="background-color: red;">
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
            <div class="add_sv col-2">
                <form action="add_monhoc.php" method="post" onsubmit="return validateForm()" name="GV">
                
                  
                    <label for="">Mã môn học</label>
                    <input type="text" name="id_monhoc" id="" required>
                    <label for="">Tên môn học</label>
                    <input type="text" name="" id="" required>
                    <label for="">Số tín chỉ</label>
                    <input type="number" name="sotinchi" id="" required>
                    <label for="">Học kỳ</label>
                    <input type="number" name="hocky" id="" required>


                    <input type="submit" value="Thêm môn học" class="btn_add_monhoc" name="btn_monhoc" required>
                </form>
            </div>

            <!-- show sinh vien -->
            <div class="show_monhoc ">
                <div class="container">
                    <?php
                    include("./php/connect.php");

                    // Truy vấn dữ liệu từ cơ sở dữ liệu
                    $sql = "SELECT * FROM monhoc";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã môn học</th>
                                    <th>Tên môn học</th>
                                    <th>Số tín chỉ</th>
                                  <th>Học kỳ</th>
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
                                            <?php echo $row['MaMonHoc']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['TenMonHoc']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['SoTinChi']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['HocKy']; ?>
                                        </td>
                                     

                                       
                                        <td> <a href="form_sua_monhoc.php?MaMonHoc=<?php echo $row['MaMonHoc']; ?>">Sửa</a>
                                           <a href="delete_monhoc.php?MaMonHoc=<?php echo $row['MaMonHoc']; ?>">Xoá</a>
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


    </div> <!-- end main -->
</body>

</html>