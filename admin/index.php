<?php 
// Hàm khởi tạo session
session_start();
define("ISLOGGED",true);
include_once "../config/DBconnecter.php";

if(isset($_SESSION['user_login'])) {
    include_once "admin.php";
}else{
    include_once "login.php";
}
?>