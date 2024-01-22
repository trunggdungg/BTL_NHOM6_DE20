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

                <li style="background-color: red;">
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
            <div class="add_giangvien col-2">
                <form action="add_giaovien.php" method="post" onsubmit="return validateForm()" name="GV">
                    <label for="">Mã khoa</label>
                    <select name="ma_khoa" required>
                        <?php
                        // Kết nối đến cơ sở dữ liệu
                        include("./php/connect.php");
                        // Truy vấn SQL để lấy danh sách khoa
                        $sql = "SELECT MaKhoa FROM khoa";
                        $result = $conn->query($sql);

                        $options = "<option value=''>Chọn khoa</option>";

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Thêm cả mã khoa và tên khoa vào tùy chọn
                                $options .= "<option value='{$row['MaKhoa']}'>{$row['MaKhoa']}</option>";
                            }
                        }

                        // Đóng kết nối
                        $conn->close();

                        echo $options;
                        ?>
                    </select>
                    <label for="">Mã giáo viên</label>
                    <input type="text" name="id_giaovien" id="" required>
                    <label for="">Tên giáo viên</label>
                    <input type="text" name="name_gv" id="" required>
                    <label for="">Ngày sinh</label>
                    <input type="date" name="ngaysinh" id="" required>
                    <label for="">Giới tính</label>
                    <select name="gender_gv" id="gender_gv" required>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                    <label for="">Quê quán</label>
                    <input type="text" name="address_gv" id="" required>
                 
                    <label for="trinhdo">Trình độ</label>
                    <select name="trinhdo" id="trinhdo" required>
                        <option value="Giáo sư">Giáo sư</option>
                        <option value="Phó giáo sư">Phó giáo sư</option>
                        <option value="Tiến sĩ">Tiến sĩ</option>
                        <option value="Thạc sĩ">Thạc sĩ</option>
                    </select>

                    <label for="">Số điện thoại</label>
                    <input type="tel" name="sdt_gv" id="" pattern="[0-9]{10}" required>
                    <label for="">Email</label>
                    <input type="email" name="email_gv" id="">


                    <input type="submit" value="Thêm" class="btn_add_gv" name="btn_gv" required>
                </form>
                <!--  -->
                <div id="filter-section-gv">
            <form method="post" action="">
                <label for="filter-khoa">Chọn khoa:</label>
                <select name="filter_khoa" id="filter-khoa">
                    <option value="">Tất cả</option>
                    <?php
                    include("./php/connect.php");
                    $sql_khoa = "SELECT MaKhoa FROM khoa";
                    $result_khoa = $conn->query($sql_khoa);

                    if ($result_khoa->num_rows > 0) {
                        while ($row_khoa = $result_khoa->fetch_assoc()) {
                            echo "<option value='{$row_khoa['MaKhoa']}'>{$row_khoa['MaKhoa']}</option>";
                        }
                    }
                    $conn->close();
                    ?>
                </select>

                <label for="search-gv">Tìm kiếm giảng viên:</label>
                <input type="text" name="search_gv" id="search-gv" placeholder="Nhập từ khóa">
                <input type="submit" value="Lọc và Tìm kiếm">
            </form>
        </div>
            </div>
<!-- show gv -->
            <div class="show_giangvien">
                <div class="container">
                    <?php
                    include("./php/connect.php");

            // Xử lý yêu cầu lọc và tìm kiếm giảng viên
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $filter_khoa = $_POST["filter_khoa"];
                $search_gv = $_POST["search_gv"];

                $whereClauseKhoa = (!empty($filter_khoa)) ? " MaKhoa = '$filter_khoa'" : "";
                $whereClauseSearchGV = (!empty($search_gv)) ? " TenGiaoVien LIKE '%$search_gv%'" : "";

                $whereClauseGV = "";
                if (!empty($whereClauseKhoa) && !empty($whereClauseSearchGV)) {
                    $whereClauseGV = "$whereClauseKhoa AND $whereClauseSearchGV";
                } else {
                    $whereClauseGV = $whereClauseKhoa . $whereClauseSearchGV;
                }

                $sql_gv = "SELECT * FROM giaovien";
                if (!empty($whereClauseGV)) {
                    $sql_gv .= " WHERE $whereClauseGV";
                }

                $result_gv = $conn->query($sql_gv);
                

                    if ($result_gv ->num_rows > 0) {
                        ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã khoa</th>
                                    <th>Mã giáo viên</th>
                                    <th>Tên giáo viên</th>
                                    <th>Ngày sinh </th>
                                    <th>Giới tính</th>
                                    <th>Quê quán</th>
                                    <th>Trình độ</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                // Hiển thị dữ liệu từ mỗi hàng
                                while ($row_gv = $result_gv ->fetch_assoc()) {
                                    ?>
                                    <tr>
                                    <td><?php echo $row_gv['MaKhoa']; ?></td>
                                    <td><?php echo $row_gv['MaGiaoVien']; ?></td>
                                    <td><?php echo $row_gv['TenGiaoVien']; ?></td>
                                    <td><?php echo $row_gv['NgaySinh']; ?></td>
                                    <td><?php echo $row_gv['GioiTinh']; ?></td>
                                    <td><?php echo $row_gv['QueQuan']; ?></td>
                                    <td><?php echo $row_gv['TrinhDo']; ?></td>
                                    <td><?php echo $row_gv['SDT']; ?></td>
                                    <td><?php echo $row_gv['Email']; ?></td>
                                    <td>
                                        <a href="form_sua_gv.php?MaGiaoVien=<?php echo $row_gv['MaGiaoVien']; ?>">Sửa</a>
                                        <a href="delete_gv.php?MaGiaoVien=<?php echo $row_gv['MaGiaoVien']; ?>">Xoá</a>
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
                    }}
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