<?php 
	include_once "../config/DBconnecter.php";
    $sql_prd = "SELECT * FROM product";
    $resultprd = mysqli_query($conn, $sql_prd);
    $totalprd = mysqli_num_rows($resultprd); //số bản ghi lấy được.

	$sql_cat = "SELECT * FROM category";
    $resultcat = mysqli_query($conn, $sql_cat);
    $totalcat = mysqli_num_rows($resultcat); //số bản ghi lấy được.

	$sql_user = "SELECT * FROM users";
    $resultuser = mysqli_query($conn, $sql_user);
    $totaluser = mysqli_num_rows($resultuser); //số bản ghi lấy được.

	$sql_successOrder = "SELECT * FROM orders
	WHERE orders.ord_status = 2";
	$resultsuccessOrder = mysqli_query($conn, $sql_successOrder);
    $totalsuccessOrder = mysqli_num_rows($resultsuccessOrder); //số bản ghi lấy được.
    
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Trang chủ quản trị</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Trang chủ quản trị</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $totalprd ?></div>
							<div class="text-muted">Sản Phẩm</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked open folder"><use xlink:href="#stroked-open-folder"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $totalcat ?></div>
							<div class="text-muted">Danh mục</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $totaluser ?></div>
							<div class="text-muted">Thành Viên</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $totalsuccessOrder ?></div>
							<div class="text-muted">Đơn hàng đã bán</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>	