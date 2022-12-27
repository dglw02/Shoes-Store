<?php 
    include_once("../../../config/DBconnecter.php");
    session_start();
    if(isset($_SESSION['user_login'])) {
        define("ISLOGGED",true);
        if(isset($_GET['prd_id'])) {
            $prd_id = $_GET['prd_id'];
            $sql_delete2 = "DELETE FROM product_detail WHERE product_detail.prd_id=$prd_id";
            mysqli_query($conn, $sql_delete2);
            $sql_delete1 = "DELETE FROM product WHERE product.prd_id=$prd_id";
            mysqli_query($conn, $sql_delete1);
            header("location: /project1final/admin/index.php?page=product");
        }
    }
?>