<?php 
 //Lấy các thông tin của sản phẩm cần sửa
 if(isset($_GET['cat_id'])) {
     $cat_id = $_GET['cat_id'];
     $sqlCate = "SELECT * FROM category WHERE cat_id = $cat_id";
     $resultCate = mysqli_query($conn, $sqlCate);
     $cateEdit = mysqli_fetch_assoc($resultCate);
     //Sửa sản phẩm
     //Lấy thông tin mới
    if(isset($_POST['sbm'])) {
        if(empty($_POST['cat_name'])) {
            echo "Bạn chưa nhập tên danh mục!";
        }else{
            $cat_name = $_POST['cat_name'];
        }
        $sqlUpdate = "UPDATE category SET
                cat_name = '$cat_name',
                WHERE cat_id = $cat_id
        ";
        if(mysqli_query($conn, $sqlUpdate)) {
            header("location: index.php?page=category");
        }else{
            echo "<script>alert('Cập nhật danh mục không thành công');</script>";
        }
    }
 }else{
     header('location: index.php?page=category');
 }
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li><a href="category.php">Quản lý danh mục</a></li>
			<li class="active"><?php echo $cateEdit['cat_name'];?></li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Danh mục:<?php echo $cateEdit['cat_name'];  ?></h1>
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
							<input type="text" name="cat_name" required value="<?php echo $cateEdit['cat_name'];  ?>" class="form-control" placeholder="">
						</div>
						<button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
						<button type="reset" class="btn btn-default">Làm mới</button>
					</div>
				</form>
				</div>
			</div>
		</div><!-- /.col-->
</div>	<!--/.main-->	