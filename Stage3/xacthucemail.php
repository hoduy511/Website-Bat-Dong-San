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
        <a href="index.php">Trang chủ</a>
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

                if (isset($_POST["mssv"]))
                    $mssv = $_POST["mssv"];
                if (isset($_POST["hoten"]))
                    $hoten = $_POST["hoten"];
                if (isset($_POST["email"]))
                    $email = $_POST["email"];
                if (isset($_POST["gioitinh"]))
                    $gioitinh = $_POST["gioitinh"];
                if (isset($_POST["sothich"]))
                    $sothich = implode(', ', $_POST["sothich"]);
                if (isset($_POST["quoctich"]))
                    $quoctich = $_POST["quoctich"];
                if (isset($_POST["ghichu"]))
                    $ghichu = $_POST["ghichu"];

                settype($gioitinh, "int");
                // validate
                $mssv = trim(strip_tags($mssv));
                $hoten = trim(strip_tags($hoten));
                $email = trim(strip_tags($email));
                $quoctich = trim(strip_tags($quoctich));
                $ghichu = trim(strip_tags($ghichu));

                $loi = "";
                if ($mssv == "")
                    $loi .= "Bạn chưa nhập mã số sinh viên <br>";
                if ($hoten == "")
                    $loi .= "Bạn chưa nhập họ tên <br>";
                if ($email == "")
                    $loi .= "Bạn chưa nhập email <br>";
                if (filter_var($email, FILTER_VALIDATE_EMAIL) == false)
                    $loi .= "Email không đúng <br>";
                if ($gioitinh != 0 && $gioitinh != 1)
                    $loi .= "Bạn chưa chọn giới tính <br>";
                if ($sothich == "")
                    $loi .= "Bạn chưa chọn sở thích <br>";
                if ($quoctich == "")
                    $loi .= "Bạn chưa chọn quốc tịch <br>";
                if ($loi != "") { ?>
                    <div>
                        <?= print $loi ?>
                        <button onclick="history.back()">Trở về</button>
                    </div>
                    <?php } else {
                    // authentication
                    $thanhvien = new thanhvien($_POST["mssv"], $_POST["hoten"], $_POST["email"], $_POST["gioitinh"], implode(", ", $_POST["sothich"]), $_POST["quoctich"], $_POST["ghichu"]);
                    try {
                        if ($thanhvien->is_exist()) {
                            echo "Bạn đã đăng ký trước đó rồi";
                    ?>      <button onclick="history.back()">Trở về</button>
                    <?php    } else
            if ($thanhvien->is_exist_email()) {
                            echo "Email đã được sử dụng";
                    ?>      <button onclick="history.back()">Trở về</button>
                    <?php  
                        } else {
                            $code = random_int(1000, 9999);
                            session_start();

                            if (!isset($_SESSION['verify_code'])) {
                                // send code to email
                                require("PHPMailer-master/src/PHPMailer.php");
                                require("PHPMailer-master/src/SMTP.php");
                                require("PHPMailer-master/src/Exception.php");

                                //Create an instance; passing `true` enables exceptions
                                $mail = new PHPMailer\PHPMailer\PHPMailer();

                                try {
                                    //Server settings
                                    $mail->SMTPDebug = 0; //Enable verbose debug output
                                    $mail->isSMTP();
                                    $mail->SMTPSecure = 'ssl'; //Send using SMTP
                                    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
                                    $mail->SMTPAuth = true; //Enable SMTP authentication
                                    $mail->Username = 'cuongcamauit@gmail.com'; //SMTP username
                                    $mail->Password = 'vpdfwungmoqnoehr'; //SMTP password
                                    //Enable implicit TLS encryption
                                    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                                    //Recipients
                                    $mail->setFrom('cuongcamauit@gmail.com', 'Admin PTL');
                                    $mail->addAddress($email, $hoten);

                                    //Attachments
                                    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                                    //Content
                                    $mail->isHTML(true); //Set email format to HTML
                                    $mail->Subject = 'Verify email';
                                    $mail->Body = 'Your verify code: ' . "<b>$code</b>";
                                    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                                    $mail->send();
                                    $_SESSION["verify_code"] = $code;
                                    $_SESSION["code_time_stamp"] = time();
                                } catch (Exception $e) {
                                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                }
                            } else {
                                // expired after 3 minutes
                                if (time() - $_SESSION["code_time_stamp"] > 180) {
                                    session_unset();
                                    session_destroy();
                                }
                            }

                    ?>
                            <form action="xulydangky.php" method="post" id="formxacthuc">
                                <input type="hidden" name="mssv" value="<?php print($mssv) ?>">
                                <input type="hidden" name="hoten" value="<?php print($hoten) ?>">
                                <input type="hidden" name="email" value="<?php print($email) ?>">
                                <input type="hidden" name="gioitinh" value="<?php print($gioitinh) ?>">
                                <input type="hidden" name="sothich" value="<?php print($sothich) ?>">
                                <input type="hidden" name="quoctich" value="<?php print($quoctich) ?>">
                                <input type="hidden" name="ghichu" value="<?php print($ghichu) ?>">

                                <h2>XÁC THỰC EMAIL</h2>
                                <label for="">Nhập mã xác thực</label>
                                <input type="text" name="code" id="code">
                                <button type="submit">OK</button>
                            </form>

                            <div id="thongbao">

                            </div>
                <?php
                        }
                    } catch (Throwable $th) {
                        throw $th;
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
            <div class="card"><a href="dangky.php">Đăng Ký</a></div>
        </div>

    </div>
    <div class="footer">
        <h4>Website được nhiều người mua nhất</h4>
    </div>
</body>

</html>