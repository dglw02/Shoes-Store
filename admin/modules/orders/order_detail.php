<?php
    if (isset($_GET['ord_id'])) {
        $ord_id = $_GET['ord_id'];
        $sql = "SELECT cus_name, cus_address, cus_email, cus_tel, product.prd_id, prd_name, prd_image, prd_price, clr_name, siz_number, ord_quantity FROM orders
        INNER JOIN customer ON orders.cus_id = customer.cus_id
        INNER JOIN orders_detail ON orders.ord_id = orders_detail.ord_id
        INNER JOIN product ON orders_detail.prd_id = product.prd_id
        INNER JOIN color ON orders_detail.clr_id = color.clr_id
        INNER JOIN size ON orders_detail.siz_id = size.siz_id
        WHERE orders.ord_id = $ord_id
        ";
        $result = mysqli_query($conn, $sql);
        $cusresult = mysqli_fetch_array($result);
	$rowPerPage = 5; //Số order trên 1 trang.
    $sql_prorder = "SELECT cus_name, cus_address, cus_email, cus_tel, product.prd_id, prd_name, prd_image, prd_price, clr_name, siz_number, ord_quantity FROM orders
	INNER JOIN customer ON orders.cus_id = customer.cus_id
	INNER JOIN orders_detail ON orders.ord_id = orders_detail.ord_id
    INNER JOIN product ON orders_detail.prd_id = product.prd_id
    INNER JOIN color ON orders_detail.clr_id = color.clr_id
    INNER JOIN size ON orders_detail.siz_id = size.siz_id
	WHERE orders.ord_id = $ord_id
	";
    $resultAll = mysqli_query($conn, $sql_prorder);
    $totalRecords = mysqli_num_rows($resultAll); //số bản ghi lấy được.
    //Tổng số trang
    $totalPage = ceil($totalRecords/$rowPerPage);

    //lấy trang hiện tại từ đường dẫn.
    if(isset($_GET['current_page'])) {
        $current_page = $_GET['current_page'];
    }else{
        $current_page = 1;
    }
    
    if($current_page < 1) {
        $current_page = 1;
    }

    if($current_page > $totalPage && $totalPage>0) {
        $current_page = $totalPage;
    }
    // SELECT * FROM table_name LIMIT $start,$rowPerPage;
    $start = ($current_page - 1)*$rowPerPage;
	var_dump($current_page);
    $sql_pagination = "SELECT cus_name, cus_address, cus_email, cus_tel, product.prd_id, prd_name, prd_image, prd_price, clr_name, siz_number, ord_quantity FROM orders
	INNER JOIN customer ON orders.cus_id = customer.cus_id
	INNER JOIN orders_detail ON orders.ord_id = orders_detail.ord_id
    INNER JOIN product ON orders_detail.prd_id = product.prd_id
    INNER JOIN color ON orders_detail.clr_id = color.clr_id
    INNER JOIN size ON orders_detail.siz_id = size.siz_id
	WHERE orders.ord_id = $ord_id
	ORDER BY orders.ord_id DESC LIMIT $start,$rowPerPage";
    $resultPagination = mysqli_query($conn, $sql_pagination);
    } else {
        header("Location: index.php?page=order");
    }
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Quản lý đơn hàng</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Quản lý đơn hàng</h1>
		</div>
	</div><!--/.row-->
	<div class="row">
        <div class="col-12">
            <ul>
                <li>Tên khách hàng: <?php echo $cusresult['cus_name']?></li>
                <li>Địa chỉ: <?php echo $cusresult['cus_address']?></li>
                <li>Email: <?php echo $cusresult['cus_email']?></li>
                <li>Điện thoại: <?php echo $cusresult['cus_tel']?></li>
            </ul>
        </div>
		<div class="col-md-12">
				<div class="panel panel-default">
						<div class="panel-body">
							<table  data-toolbar="#toolbar"data-toggle="table">
                                <thead>
                                    <tr>
                                        <th data-field="id" data-sortable="true">ID</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Màu sắc</th>
                                        <th>Kích cỡ</th>
                                        <th>Hình ảnh</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                    </tr>
                                </thead>
								<tbody>
                                <?php  if(mysqli_num_rows($resultPagination) > 0) {
                                        while ($row = mysqli_fetch_assoc($resultPagination)) {
                            	?>
                                <tr>
                                        <td style=""><?php echo $row['prd_id'] ?></td>
                                        <td style=""><?php echo $row['prd_name'] ?></td>
                                        <td style=""><?php echo $row['clr_name']; ?> </td>
                                        <td style=""><?php echo $row['siz_number']; ?> </td>
                                        <td style="text-align: center"><img width="130" height="180" src="images/<?php echo $row['prd_image']; ?>" /></td>
                                        <td style="">$<?php echo $row['prd_price'] ?></td>
                                        <td><?php echo $row['ord_quantity'] ?></td>
                                    </tr>
                                <?php         
                                    }
                                } 
                                ?>
								</tbody>
							</table>
						</div>
                        <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <!-- Hiển thị nút trở về trang trước -->
                            <?php if($current_page > 1) { ?>
                                <li class="page-item"><a class="page-link" href="index.php?page=product&current_page=<?php echo $current_page-1; ?>">&laquo;</a></li>
                            <?php }else { ?>
                                <li class="page-item disabled"><a class="page-link" href="">&laquo;</a></li>
                           <?php } ?>
                            <!-- Page menu item -->
                            <?php for($i = 1; $i <= $totalPage; $i++) { 
                                    if($i > $current_page - 3 && $i < $current_page + 3) { 
                                        if($i == $current_page) {   
                            ?>
                                            <li class="page-item active"><a class="page-link" href="index.php?page=product&current_page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                        <?php }else { ?>
                                            <li class="page-item"><a class="page-link" href="index.php?page=product&current_page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

                            <?php 
                                    }
                                }
                            }
                            ?>
                            <!-- Hiển thị nút next trang -->
                            <?php if($current_page < $totalPage) { ?>
                                <li class="page-item"><a class="page-link" href="index.php?page=product&current_page=<?php echo $current_page + 1; ?>">&raquo;</a></li>
                            <?php }else {?>
                                <li class="page-item disabled"><a class="page-link disabled" href="">&raquo;</a></li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
				</div>
		</div>
	</div><!--/.row-->
</div>	<!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>	
