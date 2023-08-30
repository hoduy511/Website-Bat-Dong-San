create database webbatdongsan;
CREATE TABLE `thanhvien` (
 `mssv` varchar(20) NOT NULL,
 `hoten` varchar(250) NOT NULL,
 `email` varchar(250) NOT NULL,
 `gioitinh` tinyint(1) NOT NULL DEFAULT 0,
 `sothich` varchar(255) NOT NULL,
 `quoctich` varchar(255) NOT NULL,
 `ghichu` varchar(255) NOT NULL,
 PRIMARY KEY (`mssv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4