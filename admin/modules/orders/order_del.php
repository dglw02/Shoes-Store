<?php 
    session_start();
    if(isset($_SESSION['user_login'])) {
        define("ISLOGGED",true);
        include_once "../../../config/DBconnecter.php";
        if(isset($_GET['ord_id'])) {
            $ord_id = $_GET['ord_id'];
            $sql_delete1 = "DELETE FROM orders WHERE orders.ord_id = $ord_id";
            $sql_delete2 = "DELETE FROM orders_detail WHERE orders_detail.ord_id = $ord_id";
            mysqli_query($conn, $sql_delete2);
            mysqli_query($conn, $sql_delete1);
            header("location: /project1final/admin/index.php?page=order");
        }        
    }
?>