<?php
 
   session_start();
    class funct{
        private $hostname = 'localhost';
        private $username = 'root';
        private $pass = '';
        private $namedatabase = 'quanliduan';
        public $connection;

        public function __construct()
        {
            $this->connection = $this->connectDatabse($this->hostname,$this->username,$this->pass,$this->namedatabase);
            if(!$this->connection)
                echo 'ket noi khong thanh cong!';
        }
        public function __destruct()
        {
            mysqli_close($this->connection);
        }
        public function connectDatabse($hostname,$username,$pass,$namedatabase)
        {
            return mysqli_connect($hostname,$username,$pass,$namedatabase);
        }
        public function login($username,$password)
        {
            $sql = "select username, password from admin where username = '{$username}' and password = '{$password}'";
            $result = mysqli_query($this->connection,$sql);
            $total = mysqli_num_rows($result);
           
            if($total == 1)
            {
                $rows = mysqli_fetch_assoc($result);
                $_SESSION['loginadmin_name'] = $rows['username'];
                $_SESSION['loginstatus_admin'] = true;
            }else
                $_SESSION['loginstatus_admin'] = false;
            return $_SESSION['loginstatus_admin'];
        }

        public function logout($cmd, $status = 'logout')
        {
            if(isset($_GET[$cmd]) && $_GET[$cmd]==$status)
            {
                unset($_SESSION['loginstatus_admin']);
                header('location: login_admin.php');
            }
        }
        public function upload($img)//hàm upload sẽ upload file lên server và trả tên file khi upload thành công
        {
          $target_dir = "upload/";
          $target_file = $target_dir . basename($_FILES[$img]["name"]); //upload/dowload.jpg
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));//jpg
          $array = array("jpg", "png", "gif");
          $check = true;
          $filesize=$_FILES[$img]["size"];//Lấy kích thước file ảnh upload
          if(!in_array($imageFileType,$array))
            $check=false;
          if($filesize>5000000)
            $check=false;
        if($check==true)
        {
            if (move_uploaded_file($_FILES[$img]["tmp_name"], $target_file)) 
            {
              return htmlspecialchars(basename( $_FILES[$img]["name"]));
            } 
            else 
            {
              return 'noimage.jpg';
            }
        }
          
        }  
    }
    $f_admin = new funct;
?>