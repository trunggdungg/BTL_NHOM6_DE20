<?php
include("./php/connect.php");

$id = $_GET['MaMonHoc'];

// include("connect.php");

$sql = "SELECT * FROM monhoc WHERE MaMonHoc = '$id'";

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

                    <li >
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
                <div class="sua_mon">
                    <form action="update_monhoc.php" method="post">
                        <input type="hidden" value="<?php echo $id_mon ?>" name="id_monhoc">
                        <label for="">Mã môn học</label>
                        <input type="text" name="id_monhoc" id="id_monhoc" value="<?php echo $row['MaMonHoc']?>" readonly>
                        <label for="">Tên môn học</label>
                        <input type="text" name="name_monhoc" id="" value="<?php echo $row['TenMonHoc']?>" >
                        <label for="">Số tín chỉ</label>
                        <input type="number" name="sotinchi" id="" value="<?php echo $row['SoTinChi']?>" >
                        <label for="">Học Kỳ</label>
                        <input type="number" name="hocky" id="" value="<?php echo $row['HocKy']?>" >
                        <input type="submit" value="Sửa" class="btn_sua_mon" name="btn_sua_mon">

                      
                    </form>

                </div>

                
            </div>


        </div> <!-- end main -->
    </body>

    </html>