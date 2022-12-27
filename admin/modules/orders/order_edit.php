<?php 
 //Lấy các thông tin của sản phẩm cần sửa
if(isset($_GET['ord_id'])) {
     $ord_id = $_GET['ord_id'];
    
    $sqlUpdate = "UPDATE orders SET
            ord_status = 2
            WHERE ord_id = $ord_id
    ";
    if(mysqli_query($conn, $sqlUpdate)) {
        header("location: index.php?page=order_processed");
    }else{
        echo "<script>alert('Cập nhật danh mục không thành công');</script>";
    }
}else{
    header('location: index.php?page=order');
}
?>