<?php
    include_once("../../../config/DBconnecter.php");
    //Thêm danh mục
    if(isset($_POST['sbm'])) {
        if(empty($_POST['cat_name'])) {
            echo "Bạn chưa nhập tên danh mục!";
        }else{
            $cat_name = $_POST['cat_name'];
        }
		$sqlid = "SELECT * FROM category";
			$resultid = mysqli_query($conn, $sqlid);
			$countid = mysqli_num_rows($resultid);
			$cat_id = $countid + 1;
        $sqlInsert = "INSERT INTO category(cat_id, cat_name) VALUES 
        ('$cat_id', '$cat_name')";

        if(mysqli_query($conn, $sqlInsert)) {
            header("location: index.php?page=category");
        }else{
            echo "<script>alert('Thêm danh mục không thành công');</script>";
        }
}   
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li><a href="category.php">Quản lý danh mục</a></li>
			<li class="active">Thêm danh mục</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Thêm danh mục</h1>
		</div>
	</div><!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-md-8">
						<form role="form" method="post">
						<div class="form-group">
							<label>Tên danh mục:</label>
							<input required type="text" name="cat_name" class="form-control" placeholder="">
						</div>
						<button type="submit" name="sbm" class="btn btn-success">Thêm mới</button>
						<button type="reset" class="btn btn-default">Làm mới</button>
					</div>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
</div>	<!--/.main-->	
