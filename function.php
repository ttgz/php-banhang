<?php
    session_start();
    class func{
        private $hostnamedb = 'localhost';
        private $usernamedb = 'root';
        private $passworddb = '';
        private $namedb = 'quanliduan';
        public $connect;
        //hàm khởi tạo kết nối database
        public function __construct()
        {
            $this->connect = $this->connectdb($this->hostnamedb,$this->usernamedb,$this->passworddb,$this->namedb);
            if(!$this->connect)
                echo 'fail connect database';

        }
        //hàm hủy: hủy kết nối database
        public function __destruct()
        {
            mysqli_close($this->connect);
        }
        //hàm kết nối database, nếu kết nối thành công: trả về 1, ngược lại 0
        public function connectdb($hostnamedb,$usernamedb,$passworddb,$namedb)
        {
            return mysqli_connect($hostnamedb,$usernamedb,$passworddb,$namedb);        
        }
        //hàm login
        public function login($email,$password)
        {
            //truy vấn 
            $sql = "select * from account where email = '{$email}' and password ='{$password}'";
            $result_query = mysqli_query($this->connect,$sql); //thực hiện truy vấn
            $total = mysqli_num_rows($result_query); //đếm số bộ mà truy vấn trả về
            if($total==1)
            {          
                $row = mysqli_fetch_assoc($result_query);
                $_SESSION['loginname'] = $row['name'];       
                $_SESSION['loginid'] = $row['id'];       
                $_SESSION['loginemail'] = $row['email'];       
                $_SESSION['loginphone'] = $row['phone'];       
                $_SESSION['loginpassword'] = $row['password'];       
                $_SESSION['logingioitinh'] = $row['gioi_tinh'];       
                $_SESSION['loginstatus'] = true;
            }      
            else
                $_SESSION['loginstatus'] = false;
            return $_SESSION['loginstatus'];
        }
        //hàm logout
        public function logout($cmd, $logout = 'logout')
        {
            if(isset($_GET[$cmd]) && $_GET[$cmd] == $logout)
            {   
                $_SESSION['loginstatus'] = false;
                header('location: laucher.php');
            }
        }
    }
    $f = new func;
    
?>