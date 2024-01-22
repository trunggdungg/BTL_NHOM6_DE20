<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="./assets/css/style.css"> -->
    <link rel="stylesheet" href="./assets/css/khoa.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin-top: 20px;
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

                <li style="background-color:red;">
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
            <!-- <div class="add_lophoc col-2">


            </div> -->

            <div class="show_diemsv">
                <div class="container">

                    <?php
                    $servername = "localhost:3308";
                    $username = "root";
                    $password = "";
                    $dbname = "qldiem";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Kiểm tra xem nút 'Thêm' hoặc 'Xóa' đã được nhấn chưa
                    if (isset($_POST['btn_them'])) {
                        // Lấy dữ liệu từ bảng HTML
                        $students = $_POST['students'];
                        $diemChuyenCan = $_POST['diemChuyenCan'];
                        $diemGiuaKi = $_POST['diemGiuaKi'];
                        $diemThiLan1 = $_POST['diemThiLan1'];
                        $diemThiLan2 = $_POST['diemThiLan2'];
                        $diemCuoiKi = $_POST['diemCuoiKi'];
                        $selectedSubject = $_POST['selectedSubject'];

                        // Lặp qua mảng sinh viên để thêm hoặc cập nhật dữ liệu từ bảng vào cơ sở dữ liệu
                        foreach ($students as $key => $student) {
                            // Kiểm tra nếu bất kỳ trường bắt buộc nào không trống
                            if (!empty($diemChuyenCan[$key]) || !empty($diemGiuaKi[$key]) || !empty($diemThiLan1[$key]) || !empty($diemThiLan2[$key]) || !empty($diemCuoiKi[$key])) {
                                $sqlCheckExist = "SELECT * FROM diem WHERE MaSinhVien = ? AND MaMonHoc = ?";
                                $stmtCheckExist = $conn->prepare($sqlCheckExist);
                                $stmtCheckExist->bind_param("ss", $student, $selectedSubject);
                                $stmtCheckExist->execute();
                                $resultExist = $stmtCheckExist->get_result();

                                if ($resultExist->num_rows > 0) {
                                    // Nếu đã tồn tại, thực hiện cập nhật
                                    $sqlUpdate = "UPDATE diem SET DiemChuyenCan=?, DiemGiuaKi=?, DiemThiLan1=?, DiemThiLan2=?, DiemCuoiKi=? WHERE MaSinhVien=? AND MaMonHoc=?";
                                    $stmtUpdate = $conn->prepare($sqlUpdate);
                                    $stmtUpdate->bind_param("sssssss", $diemChuyenCan[$key], $diemGiuaKi[$key], $diemThiLan1[$key], $diemThiLan2[$key], $diemCuoiKi[$key], $student, $selectedSubject);

                                    if ($stmtUpdate->execute()) {
                                        // Cập nhật thành công
                                        $stmtUpdate->close();
                                    } else {
                                        // Lỗi khi cập nhật
                                        echo "Lỗi: " . $stmtUpdate->error;
                                        $stmtUpdate->close();
                                    }
                                } else {
                                    // Nếu chưa tồn tại, thực hiện thêm mới
                                    $sqlInsert = "INSERT INTO diem (MaSinhVien, MaMonHoc, DiemChuyenCan, DiemGiuaKi, DiemThiLan1, DiemThiLan2, DiemCuoiKi) VALUES (?, ?, ?, ?, ?, ?, ?)";
                                    $stmtInsert = $conn->prepare($sqlInsert);
                                    $stmtInsert->bind_param("sssssss", $student, $selectedSubject, $diemChuyenCan[$key], $diemGiuaKi[$key], $diemThiLan1[$key], $diemThiLan2[$key], $diemCuoiKi[$key]);

                                    if ($stmtInsert->execute()) {
                                        // Thêm mới thành công
                                        $stmtInsert->close();
                                    } else {
                                        // Lỗi khi thêm mới
                                        echo "Lỗi: " . $stmtInsert->error;
                                        $stmtInsert->close();
                                    }
                                }

                                $stmtCheckExist->close();
                            }
                        }

                        echo "Dữ liệu đã được thêm hoặc cập nhật vào cơ sở dữ liệu.";
                    } elseif (isset($_POST['btn_xoa'])) {
                        // Lấy mã sinh viên cần xóa
                        $deleteStudentId = $_POST['deleteStudentId'];

                        // Thực hiện xóa
                        $sqlDelete = "DELETE FROM diem WHERE MaSinhVien = ?";
                        $stmtDelete = $conn->prepare($sqlDelete);
                        $stmtDelete->bind_param("s", $deleteStudentId);

                        if ($stmtDelete->execute()) {
                            echo "Dữ liệu của sinh viên đã được xóa khỏi bảng điểm.";
                        } else {
                            echo "Lỗi: " . $stmtDelete->error;
                        }

                        $stmtDelete->close();
                    }
                    ?>
                    <form method='POST' action=''>

                        <label for='class'>Chọn Lớp:</label>
                        <select id='class' name='class'>
                            <?php
                            $classQuery = "SELECT DISTINCT MaLopHoc, TenLopHoc FROM lophoc";
                            $classResult = $conn->query($classQuery);

                            while ($classRow = $classResult->fetch_assoc()) {
                                echo "<option value='" . $classRow["MaLopHoc"] . "'>" . $classRow["TenLopHoc"] . "</option>";
                            }
                            ?>
                        </select>

                        <?php
                        $subjectsQuery = "SELECT DISTINCT MaMonHoc, TenMonHoc FROM monhoc";
                        $subjectsResult = $conn->query($subjectsQuery);
                        ?>

                        <label for='subject'>Chọn Môn Học:</label>
                        <select id='subject' name='subject'>
                            <?php
                            while ($subjectRow = $subjectsResult->fetch_assoc()) {
                                echo "<option value='" . $subjectRow["MaMonHoc"] . "'>" . $subjectRow["MaMonHoc"] . " - " . $subjectRow["TenMonHoc"] . "</option>";
                            }
                            ?>
                        </select>

                        <input type='submit' name='filter' value='Lọc'>
                    </form>

                    <?php
                    if (isset($_POST['filter'])) {
                        $selectedClass = $_POST['class'];
                        $selectedSubject = $_POST['subject'];

                        $sql = "SELECT sv.MaSinhVien, sv.TenSinhVien, lh.TenLopHoc, d.DiemChuyenCan, d.DiemGiuaKi, d.DiemThiLan1, d.DiemThiLan2, d.DiemCuoiKi, mh.MaMonHoc
            FROM sinhvien sv
            JOIN lophoc lh ON sv.MaLopHoc = lh.MaLopHoc
            LEFT JOIN diem d ON sv.MaSinhVien = d.MaSinhVien AND d.MaMonHoc = ?
            LEFT JOIN monhoc mh ON mh.MaMonHoc = ?
            WHERE sv.MaLopHoc = ?";

                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("sss", $selectedSubject, $selectedSubject, $selectedClass);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            ?>
                            <form method='POST' action=''>
                                <div class="actions">
                                    <button type='submit' name='btn_them'>Thêm</button>
                                </div>
                                <input type='hidden' name='selectedSubject' value='<?php echo $selectedSubject; ?>'>
                                <table>
                                    <tr>
                                        <th>Mã Sinh Viên</th>
                                        <th>Tên Sinh Viên</th>
                                        <th>Lớp Học</th>
                                        <th>Mã Môn Học</th>
                                        <th></th>
                                        <th>Điểm Chuyên Cần</th>
                                        <th>Điểm Giữa Kì</th>
                                        <th>Điểm Thi Lần 1</th>
                                        <th>Điểm Thi Lần 2</th>
                                        <th>Điểm Cuối Kì</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $row["MaSinhVien"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["TenSinhVien"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["TenLopHoc"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["MaMonHoc"]; ?>
                                            </td>
                                            <td><input type='hidden' name='students[]' value='<?php echo $row["MaSinhVien"]; ?>'>
                                            </td>
                                            <td><input type='text' name='diemChuyenCan[]'
                                                    value='<?php echo $row["DiemChuyenCan"]; ?>'></td>
                                            <td><input type='text' name='diemGiuaKi[]' value='<?php echo $row["DiemGiuaKi"]; ?>'>
                                            </td>
                                            <td><input type='text' name='diemThiLan1[]' value='<?php echo $row["DiemThiLan1"]; ?>'>
                                            </td>
                                            <td><input type='text' name='diemThiLan2[]' value='<?php echo $row["DiemThiLan2"]; ?>'>
                                            </td>
                                            <td><input type='text' name='diemCuoiKi[]' value='<?php echo $row["DiemCuoiKi"]; ?>'>
                                            </td>
                                            <td>
                                                <button type='submit' name='btn_xoa'
                                                    onclick="return confirm('Bạn có chắc muốn xóa không?');">Xóa điểm</button>
                                                <input type='hidden' name='deleteStudentId'
                                                    value='<?php echo $row["MaSinhVien"]; ?>'>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>
                            </form>
                            <?php
                        } else {
                            echo "Không có dữ liệu";
                        }
                        $stmt->close();
                    }

                    $conn->close();
                    ?>

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