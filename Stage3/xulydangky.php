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
if (isset($_POST["sothich"])) $sothich = implode(', ',$_POST["sothich"]);
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
            require("PHPMailer-master/src/SMTP.php");
            require("PHPMailer-master/src/Exception.php");

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer\PHPMailer\PHPMailer();

            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();
                $mail->SMTPSecure = 'ssl';                                   //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'cuongcamauit@gmail.com';                     //SMTP username
                $mail->Password   = 'vpdfwungmoqnoehr';                               //SMTP password
                //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('cuongcamauit@gmail.com', 'Mailer');
                $mail->addAddress($email, 'Joe User');     //Add a recipient
                //$mail->addAddress('ellen@example.com');               //Name is optional
                // $mail->addReplyTo('2051120209@ut.edu.vn', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Verify email';
                $mail->Body    = 'Your verify code: ' . "<b>$code</b>";
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

    ?>
            <script>

            </script>
            <h2>XÁC THỰC EMAIL</h2>
            <label for="">Nhập mã xác thực</label>
            <input type="text" name="" id="code">
            <button onclick="javascript:(function () {
                code = document.getElementById('code').value; if (code==<?php print($code) ?>) { document.getElementById('thongbao').innerHTML = 'Đăng Ký thành công'; <?php $thanhvien->insert(); ?>} else document.getElementById('thongbao').innerHTML = 'Vui lòng nhập lại mã xác thực';})()">Kiểm tra</button>
            <div id="thongbao">

            </div>
<?php
            
        }
    } catch (\Throwable $th) {
        throw $th;
    }
}

?>