<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place for life</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/xulydangky.css">
    <link rel="icon" href="images/iconapp.svg" type="image/x-icon">
    <script src="js/dangky.js"></script>
</head>


<body>
    <div class="header">
        <img src="images/iconapp.svg" alt="" srcset="" height="200">
    </div>
    <div class="topnav">
        <a href="index.html">Trang chủ</a>
        <a href="forsale.html">Nhà đất bán</a>
        <a href="forent.html">Nhà đất cho thuê</a>
    </div>
    <div class="row">
        <div class="leftcolumn">
            <div class="container">
            <?php
                    include "connectmysql.php";
                    include "thanhvien.php";
                    $mssv = null;
                    $hoten = null;
                    $email = null;
                    $gioitinh = null;
                    $sothich = null;
                    $quoctich = null;
                    $ghichu = null;
                    
                    if (isset($_POST["mssv"])) $mssv = $_POST["mssv"];
                    if (isset($_POST["hoten"])) $hoten = $_POST["hoten"];
                    if (isset($_POST["email"])) $email = $_POST["email"];
                    if (isset($_POST["gioitinh"])) $gioitinh = $_POST["gioitinh"];
                    if (isset($_POST["sothich"])) $sothich = $_POST["sothich"];
                    if (isset($_POST["quoctich"])) $quoctich = $_POST["quoctich"];
                    if (isset($_POST["ghichu"])) $ghichu = $_POST["ghichu"];

                    settype($gioitinh, "int");
                    // validate
                    $mssv = trim(strip_tags($mssv));
                    $hoten = trim(strip_tags($hoten));
                    $email = trim(strip_tags($email));
                    $quoctich = trim(strip_tags($quoctich));
                    $ghichu = trim(strip_tags($ghichu));

                    $loi = "";
                    if ($mssv == null || $mssv == "")
                        $loi .= "Bạn chưa nhập mã số sinh viên <br>";
                    if ($hoten == null || $hoten == "")
                        $loi .= "Bạn chưa nhập họ tên <br>";
                    if ($email == null || $email == "")
                        $loi .= "Bạn chưa nhập email <br>";
                    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false)
                        $loi .= "Email không đúng <br>";
                    if ($gioitinh != 0 && $gioitinh != 1)
                        $loi .= "Bạn chưa chọn giới tính <br>";
                    if ($sothich == null || $sothich == "")
                        $loi .= "Bạn chưa chọn sở thích <br>";
                    if ($quoctich == null || $quoctich == "")
                        $loi .= "Bạn chưa chọn quốc tịch <br>";
                    if ($loi != "") { ?>
                        <div>
                            <?php print $loi ?>
                            <button onclick="history.back()">Trở về</button>
                        </div>
                <?php } else {
                    $thanhvien = new thanhvien($mssv, $hoten, $email, $gioitinh, $sothich, $quoctich, $ghichu);
                    session_start();
                    $valid_code = null;
                    if (isset($_SESSION['verify_code']))
                        $valid_code = $_SESSION['verify_code'];
                    $user_code = null;
                    if (isset($_POST['code']))
                        $user_code = $_POST['code'];
                    // check verify code
                    if ($user_code == $valid_code) {
                        $thanhvien->insert();
                        session_unset();
                        session_destroy();
                        // notify register successful
                        echo "<script>alert('Đăng ký thành công!'); window.location = './index.html';</script>";
                    } else {
                        // back to enter verify code again
                        echo "<script>alert('Nhập lại mã xác thực!'); history.back();</script>";
                    }
                }         
                ?>
            </div>
        </div>
        <div class="rightcolumn">
            <div class="card">
                <h2>Giới thiệu</h2>
                <iframe width="250" height="130" src="https://www.youtube.com/embed/2jeqQ6Py-o8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                <p>PFL là website bất động sản hàng đầu Việt Nam</p>
            </div>
            <div class="card">
                <h1>Follow Me</h1>
                <img src="images/social.jpg" alt="" width="50%">
            </div>
            <div class="card">
                <h2>Liên hệ</h2>
                <p>Điện thoại: 0945205850</p>
                <p>Email: pfl@gmail.com</p>
            </div>
            <div class="card"><a href="bosuutap.html">Bộ sưu tập</a></div>
            <div class="card"><a href="banhang.html">Đặt hàng</a></div>
            <div class="card"><a href="dangky.html">Đăng Ký</a></div>
        </div>

    </div>
    <div class="footer">
        <h4>Website được nhiều người mua nhất</h4>
    </div>
</body>

</html>