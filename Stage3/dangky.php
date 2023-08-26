<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place for life</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dangky.css">
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
            <h2>ĐĂNG KÍ THÀNH VIÊN</h2>
            <div class="container">
                <form action="xacthucemail.php" name="register-form" onsubmit="return check();" method="post">
                    <p>
                        <label for="">Mã sinh viên</label> <br>
                        <input type="text" name="mssv" id="student-id" placeholder="Nhập mã số sinh viên">
                    </p>

                    <p>
                        <label for="">Họ và tên</label> <br>
                        <input type="text" name="hoten" id="fullname" placeholder="Nhập họ và tên">
                    </p>

                    <p>
                        <label for="">Email</label> <br>
                        <input type="email" name="email" id="email" placeholder="Nhập email">
                    </p>

                    <p>
                        <label for="">Giới tính</label>
                        <div class="gender-container">
                            <input type="radio" name="gioitinh" id="male" value="1"> Nam
                            <input type="radio" name="gioitinh" id="female" value="0"> Nữ
                        </div>
                    </p>

                    <p>
                        <label for="">Sở thích</label>
                            <div class="hobby-container">
                                <input type="checkbox" name="sothich[]" id="hobby-1" value="Đọc sách"> Đọc sách
                                <input type="checkbox" name="sothich[]" id="hobby-2" value="Du lịch"> Du lịch
                                <input type="checkbox" name="sothich[]" id="hobby-3" value="Âm nhạc"> Âm nhạc
                                <input type="checkbox" name="sothich[]" id="hobby-4" value="Ẩm thực"> Ẩm thực
                                <input type="checkbox" name="sothich[]" id="hobby-others" value="Khác"> Khác
                            </div>
                    </p>

                    <p>
                        <label for="">Quốc tịch</label> <br>
                        <select name="quoctich" id="nationality">
                            <option value="">Chọn quốc tịch</option>
                            <option value="Việt Nam">Việt Nam</option>
                            <option value="Anh">Anh</option>
                            <option value="Pháp">Pháp</option>
                            <option value="Mỹ">Mỹ</option>
                            <option value="Khác">Khác</option>
                        </select>
                    </p>
                    <p>
                        <label for="">Ghi chú</label> <br>
                        <textarea name="ghichu" id="note" cols="50" rows="4"></textarea>
                    </p>

                    <p><button type="submit"> Đăng ký</button></p>

                    <div id="message">

                    </div>
                </form>
            </div>

        </div>
        <div class="rightcolumn">
            <div class="card">
                <h2>Giới thiệu</h2>
                <iframe width="250" height="130" src="https://www.youtube.com/embed/2jeqQ6Py-o8"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
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