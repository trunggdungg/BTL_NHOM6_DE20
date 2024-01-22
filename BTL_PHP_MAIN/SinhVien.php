<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/khoa.css">
    <style>

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
                <form action="add_sinhvien.php" method="post" onsubmit="return validateForm()" name="GV">
                    <label for="">Mã Lớp</label>
                    <select name="ma_lop" required>
                        <?php
                        include("./php/connect.php");

                        // Truy vấn SQL để lấy danh sách khoa
                        $sql = "SELECT MaLopHoc,TenLopHoc FROM lophoc";
                        $result = $conn->query($sql);

                        $options = "<option value=''>Chọn lớp</option>";

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Thêm cả mã khoa và tên khoa vào tùy chọn
                                $options .= "<option value='{$row['MaLopHoc']}'>{$row['MaLopHoc']} - {$row['TenLopHoc']}</option>";
                            }
                        }

                        // Đóng kết nối
                        $conn->close();

                        echo $options;
                        ?>
                    </select>
                    <label for="">Mã sinh viên</label>
                    <input type="text" name="id_sinhvien" id="" required>
                    <label for="">Tên sinh viên</label>
                    <input type="text" name="name_sv" id="" required>
                    <label for="">Ngày sinh</label>
                    <input type="date" name="ngaysinh" id="" required>
                    <label for="">Giới tính</label>
                    <select name="gender_sv" id="gender_sv" required>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                    <label for="">Quê quán</label>
                    <input type="text" name="address_sv" id="" required>
                    <label for="">CCCD</label>
                    <input type="text" name="cccd_sv" id="" required>
                    <label for="">Số điện thoại</label>
                    <input type="tel" name="sdt_sv" id="" pattern="[0-9]{10}" required>
                    <label for="">Email</label>
                    <input type="email" name="email_sv" id="">


                    <input type="submit" value="Thêm" class="btn_add_gv" name="btn_sv" required>
                </form>

                <!--loc sinh vien -->
                <div id="filter-section">
                    <form method="post" action="">
                        <label for="filter-lop">Chọn lớp:</label>
                        <select name="filter_lop" id="filter-lop">
                            <option value="">Tất cả</option>
                            <?php
                            include("./php/connect.php");
                            $sql = "SELECT MaLopHoc, TenLopHoc FROM lophoc";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['MaLopHoc']}'>{$row['MaLopHoc']} - {$row['TenLopHoc']}</option>";
                                }
                            }
                            $conn->close();
                            ?>
                        </select>
                        <label for="search-sv">Tìm kiếm sinh viên:</label>
                        <input type="text" name="search_sv" id="search-sv" placeholder="Nhập từ khóa">
                        <input type="submit" value="Lọc và Tìm kiếm">
                    </form>
                </div>
            </div>


            <!-- show sinh vien -->
            <div class="show_sinhvien ">
                <div class="container">
                    <?php
                    include("./php/connect.php");

                    // Xử lý yêu cầu lọc và tìm kiếm
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $filter_lop = $_POST["filter_lop"];
                        $search_sv = $_POST["search_sv"];

                        // Đầu tiên, xây dựng điều kiện lọc theo lớp
                        $whereClauseLop = (!empty($filter_lop)) ? " MaLopHoc = '$filter_lop'" : "";

                        // Tiếp theo, xây dựng điều kiện tìm kiếm chung
                        $whereClauseSearch = "";
                        if (!empty($search_sv)) {
                            $whereClauseSearch = " (MaSinhVien LIKE '%$search_sv%' OR TenSinhVien LIKE '%$search_sv%')";
                        }

                        // Kết hợp cả hai điều kiện
                        $whereClause = "";
                        if (!empty($whereClauseLop) && !empty($whereClauseSearch)) {
                            $whereClause = "$whereClauseLop AND $whereClauseSearch";
                        } else {
                            $whereClause = $whereClauseLop . $whereClauseSearch;
                        }

                        // Xây dựng câu truy vấn cuối cùng
                        $sql = "SELECT * FROM sinhvien";
                        if (!empty($whereClause)) {
                            $sql .= " WHERE $whereClause";
                        }

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table class='table table-bordered'>
                                    <thead>
                                        <tr>
                                            <th>Mã lớp</th>
                                            <th>Mã sinh viên</th>
                                            <th>Tên sinh viên</th>
                                            <th>Ngày sinh</th>
                                            <th>Quê quán</th>
                                            <th>CCCD</th>
                                            <th>Số điện thoại</th>
                                            <th>Email</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['MaLopHoc']}</td>
                                        <td>{$row['MaSinhVien']}</td>
                                        <td>{$row['TenSinhVien']}</td>
                                        <td>{$row['NgaySinh']}</td>
                                        <td>{$row['QueQuan']}</td>
                                        <td>{$row['CCCD']}</td>
                                        <td>{$row['SDT']}</td>
                                        <td>{$row['Email']}</td>
                                        <td>
                                            <a href='form_sua_sinhvien.php?MaSinhVien={$row['MaSinhVien']}'>Sửa</a>
                                            <a href='delete_sinhvien.php?MaSinhVien={$row['MaSinhVien']}'>Xoá</a>
                                        </td>
                                    </tr>";
                            }

                            echo "</tbody></table>";
                        } else {
                            echo "Không có kết quả";
                        }
                    }
                    $conn->close();
                    ?>
                </div>

            </div>
        </div>


    </div> <!-- end main -->
</body>

</html>
