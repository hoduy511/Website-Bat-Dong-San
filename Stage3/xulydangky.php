<?php
include "connectmysql.php";
include "thanhvien.php";
$mssv = $_POST["mssv"];
$hoten = $_POST["hoten"];
$email = $_POST["email"];
$gioitinh = $_POST["gioitinh"];
$sothich = implode(", ", $_POST["sothich"]);
$quoctich = $_POST["quoctich"];
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <div class="col-8 m-auto">
            <div class="alert alert-danger mt-5 text-center ">
                <?= $loi ?>
                <button class="btn btn-primary" onclick="history.back()">Trở lại</button>
            </div>
        </div>
    </div>
<?php } else {
    // authentication
    $thanhvien = new thanhvien($_POST["mssv"], $_POST["hoten"], $_POST["email"], $_POST["gioitinh"], implode(", ", $_POST["sothich"]), $_POST["quoctich"], $_POST["ghichu"]);
    try {
        if ($thanhvien->is_exist()) {
            echo "Bạn đã đăng ký trước đó rồi";
        } else
            if ($thanhvien->is_exist_email()) {
                echo "Email đã được sử dụng";
            } else {
                $code = random_int(1000, 9999);
                // send code to email
                require("PHPMailer-master/src/PHPMailer.php");
                require("PHPMailer-master/src/Exception.php");
                require("PHPMailer-master/src/OAuth.php");
                require("PHPMailer-master/src/SMTP.php");
                $mail = new PHPMailer\PHPMailer\PHPMailer(true);
                try {
                    $mail->SMTPDebug = 2; //chế độ full debug, khi mọi thứ ok thì chỉnh lại 0
                    $mail->isSMTP(); // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com'; // Server gửi thư
                    $mail->SMTPAuth = true;
                    $mail->Username = 'cuoncamauit@gmail.com'; // ví dụ: abc@gmail.com
                    $mail->Password = 'rhbqvattwsijrmzq';
                    $mail->SMTPSecure = 'ssl'; //TLS hoặc `ssl` 
                    $mail->Port = 465; // 587 hoặc 465
                    $mail->CharSet = "UTF-8";
                    $mail->smtpConnect(
                        [
                            "ssl" => [
                                "verify_peer" => false,
                                "verify_peer_name" => false,
                                "allow_self_signed" => true
                            ]
                        ]
                    );
                    //Khai báo người gửi và người nhận mail        
                    $mail->setFrom($email, 'Ban quản trị website');
                    $mail->addAddress("{$email}", 'Quý khách');
                    $mail->isHTML(true); // nội dung của email có mã HTML
                    $mail->Subject = 'Cấp lại mật khẩu mới';
                    $mail->Body = "Đây là mã xác thực của bạn <b> {$code} </b>";
                    $mail->send();
                    $thongbao .= "Đã gửi mail thành công<br>";
                } catch (Exception $e) {
                    $thongbao .= "Lỗi khi gửi thư: " . $mail->ErrorInfo;
                }


                ?>
                <h2>XÁC THỰC EMAIL</h2>
                <label for="">Nhập mã xác thực</label>
                <input type="text" name="" id="code">
                <button>Kiểm tra</button>
                <?php
                //$thanhvien->insert();
                echo "Đăng ký thành công";
            }
    } catch (\Throwable $th) {
        throw $th;
    }
}

?>