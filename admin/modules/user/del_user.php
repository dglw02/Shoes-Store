<?php 
    session_start();
    $role = $_SESSION['user_login']['use_level'];
    if ($role == '1') {
        if(isset($_SESSION['user_login'])) {
            define("ISLOGGED",true);
            include_once "../../../config/DBconnecter.php";
            if(isset($_GET['prd_id'])) {
                $prd_id = $_GET['prd_id'];
                $sql_delete = "DELETE FROM users WHERE use_id=$prd_id";
                mysqli_query($conn, $sql_delete);
                header("location: /project1final/admin/index.php?page=user");
            }
        }
    } else {
	    header("location: /project1final/admin/index.php?page=user&err=1");
    }

?>