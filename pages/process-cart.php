<?php 
session_start();
$action = $_GET['action'];
switch ($action) {
    case 'add':
        if(isset($_GET['prd_id'])) {
            $prd_id = $_GET['prd_id'];
        }
        if(isset($_GET['clr_id'])) {
            $clr_id = $_GET['clr_id'];
        }
        $_SESSION['color'][$prd_id] = $clr_id;
        
        if(isset($_GET['siz_id'])) {
            $siz_id = $_GET['siz_id'];
        }
        $_SESSION['size'][$prd_id] = $siz_id;
        if(isset($_SESSION['cart'][$prd_id])) {
            $_SESSION['cart'][$prd_id]++;
        }else{
            $_SESSION['cart'][$prd_id] = 1;
        }
        
        header("location: ../cart.php");
        break;
    
    case 'del':
        if(isset($_SESSION['cart'][$_GET['prd_id']])) {
            unset($_SESSION['cart'][$_GET['prd_id']]);
        }

        if(empty($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }

        header("location: ../cart.php");
        break;
    case 'submit':
        if(isset($_POST['update_cart'])) {
            //Cập nhật giỏ hàng.
            foreach ($_POST['quantity'] as $prd_id => $qty) {
                $_SESSION['cart'][$prd_id] = $qty; //$qty là giá trị ở ô input.
                if($qty == 0) {
                    unset($_SESSION['cart'][$prd_id]);
                }
            }
            header("location: ../cart.php");
        }

        if(isset($_POST['insert_cart'])) {
            include_once "../config/DBconnecter.php";
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            //Thêm vào bảng order
                $prdId_list = "";
                foreach ($_SESSION['cart'] as $prd_id => $qty) {
                  $prdId_list .= $prd_id.",";
                }
                $clr_id=$_SESSION['color'][$prd_id];
                $siz_id=$_SESSION['size'][$prd_id];
                // $prdId_list = 2,6,
                $prdId_list = rtrim($prdId_list,","); //$prdId_list = 2,6
                $sqlCart = "SELECT product.prd_id, prd_image, prd_name, prd_price, cat_name, clr_name, siz_number FROM product INNER JOIN category ON product.cat_id = category.cat_id 
                INNER JOIN product_detail ON product.prd_id = product_detail.prd_id
                INNER JOIN color ON product_detail.clr_id = color.clr_id 
                INNER JOIN size ON product_detail.siz_id = size.siz_id 
                WHERE product.prd_id IN($prdId_list) AND product_detail.clr_id = $clr_id AND product_detail.siz_id = $siz_id  ";
                $queryCart = mysqli_query($conn, $sqlCart);
                $price_unit = 0;
                $total_price = 0;
                while($cart_item = mysqli_fetch_assoc($queryCart)){
                $price_unit = $_SESSION['cart'][$cart_item['prd_id']] * $cart_item['prd_price'];
                $total_price += $price_unit;
            $cus_name = $_POST['cus_name'];
            $cus_tel = $_POST['cus_tel'];
            $cus_email = $_POST['cus_email'];
            $cus_address = $_POST['cus_address'];
            // $ord_total = $_POST['total_price'];
            $ord_total = $total_price;
            $ord_status = 1;
            $ord_date = date('Y-m-d'); //datetime
            $sqlCustomer = "INSERT INTO customer(cus_name, cus_tel, cus_email, cus_address)
                VALUES ('$cus_name', '$cus_tel', '$cus_email', '$cus_address')";
            mysqli_query($conn, $sqlCustomer);
            $cus_id = mysqli_insert_id($conn);
            $sqlOrder = "INSERT INTO orders(cus_id, ord_total, ord_date, ord_status) 
                        VALUES($cus_id, $ord_total, '$ord_date', $ord_status)";
            // echo $sqlOrder;
            mysqli_query($conn, $sqlOrder);
            $ord_id = mysqli_insert_id($conn);
            //Thêm vào bảng orderdetail
            $sqlDetail = "INSERT INTO orders_detail(ord_id, prd_id, clr_id, siz_id, ord_quantity) VALUES";
            foreach($_SESSION['cart'] as $prd_id => $qty) {
                $sqlDetail .= "($ord_id, $prd_id, $clr_id, $siz_id, $qty),";
            }
            $sqlDetail = rtrim($sqlDetail,","); //cắt ký tự "," bên phải cùng sql.
            mysqli_query($conn, $sqlDetail);
            
            unset($_SESSION['cart']);
            header("location: ../thankyou.php");
        }
        break;
}
}
?>
