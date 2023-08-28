<?php
    require_once('connectmysql.php');
    // contain attribute and method of a user
    class thanhvien
    {
        var $mssv = null;
        var $hoten = null;
        var $email = null;
        var $gioitinh = null;
        var $sothich = null;
        var $quoctich = null;
        var $ghichu = null;
        function __construct()
        {
            if (func_num_args() == 7) {
                $this->mssv = func_get_arg(0);
                $this->hoten = func_get_arg(1);
                $this->email = func_get_arg(2);
                $this->gioitinh = func_get_arg(3);
                $this->sothich = func_get_arg(4);
                $this->quoctich = func_get_arg(5);
                $this->ghichu = func_get_arg(6);
            }
        }

        function is_exist()
        {
            $db = new connect();
            $query = "select * from thanhvien where mssv = '" . $this->mssv . "'";
            try {
                $is_exist = $db->getInstance($query) != null;
                if ($is_exist) {
                    return true;
                } else {
                    return false;
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        
        function is_exist_email() {
            $db = new connect();
            $query = "select * from thanhvien where email = '" . $this->email . "'";
            try {
                $is_exist = $db->getInstance($query) != null;
                if ($is_exist) {
                    return true;
                } else {
                    return false;
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        function insert()
        {
            $db = new connect();
            $query = "insert into thanhvien values('" . $this->mssv . "', '" . $this->hoten . "', '" . $this->email . "', " . $this->gioitinh . ", '" . $this->sothich . "', '" . $this->quoctich . "', '" . $this->ghichu . "')";
            try {
                //code...
                $db->execute($query);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }
?>