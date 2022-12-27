<?php
	$rowPerPage = 5; //Số order trên 1 trang.
    $sql_prorder = "SELECT * FROM orders
	INNER JOIN customer ON orders.cus_id = customer.cus_id
	WHERE orders.ord_status = 2
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
    $sql_pagination = "SELECT * FROM orders
	INNER JOIN customer ON orders.cus_id = customer.cus_id
	WHERE orders.ord_status = 2
	ORDER BY orders.ord_id DESC LIMIT $start,$rowPerPage";
    $resultPagination = mysqli_query($conn, $sql_pagination);

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
			<h3> Đơn hàng đã xử lý </h3>
		</div>
	</div><!--/.row-->
	<div id="toolbar" class="btn-group">
		<a href="index.php?page=order" class="btn btn-success">
			<i class="glyphicon glyphicon-plus"></i> Đơn chưa xử lý
		</a>
	</div>
	<div class="row">
		<div class="col-md-12">
				<div class="panel panel-default">
						<div class="panel-body">
						<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Tìm ID đơn hàng">
							<table 
								data-toolbar="#toolbar"
								data-toggle="table"
								id="myTable">
	
								<thead>
								<tr>
									<th data-field="id" data-sortable="true">ID</th>
									<th>Tên khách hàng</th>
									<th>Email</th>
									<th>Số điện thoại</th>
									<th>Địa chỉ</th>
									<th>Tổng tiền</th>
									<th>Hành động</th>
								</tr>
								</thead>
								<tbody>
								<?php  if(mysqli_num_rows($resultPagination) > 0) {
                                        while ($row = mysqli_fetch_assoc($resultPagination)) {
                            	?> 
									<tr>
										<td style=""><?php echo $row['ord_id'] ?></td>
										<td style=""><?php echo $row['cus_name'] ?></td>
										<td style=""><?php echo $row['cus_email'] ?></td>
										<td style=""><?php echo $row['cus_tel'] ?></td>
										<td style=""><?php echo $row['cus_address'] ?></td>
										<td style="">$<?php echo $row['ord_total'] ?></td>
										<td class="form-group">
										<a href="index.php?page=order_detail&ord_id=<?php echo $row['ord_id']; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i></a>
											<a onclick="return confirmDel();" href="modules/orders/order_del.php?ord_id=<?php echo $row['ord_id']; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
										</td>
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
<script>
    function confirmDel() {
        return confirm("Bạn có chắc chắn xóa?");
    }
</script>
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>