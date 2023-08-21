<?php
    include "connectmysql.php";
    include "thanhvien.php";
    $thanhvien = new thanhvien($_POST["mssv"], $_POST["hoten"], $_POST["email"], $_POST["gioitinh"], implode(", ", $_POST["sothich"]), $_POST["quoctich"], $_POST["ghichu"]);
    try {
        if ($thanhvien->is_exist()) {
            echo "Bạn đã đăng ký trước đó rồi";
        } else
            if ($thanhvien->is_exist_email()) {
                echo "Email đã được sử dụng";
            } else {
                $thanhvien->insert();
                echo "Đăng ký thành công";
            }
    } catch (\Throwable $th) {
        throw $th;
    }
?>