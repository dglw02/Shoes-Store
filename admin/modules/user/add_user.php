<?php 
$role = $_SESSION['user_login']['use_level'];
if ($role == '1') {
	if(isset($_POST['sbm'])) {
		//kiểm email đã được nhập hay chưa
		if(!empty($_POST['use_mail'])) {
			$email = trim($_POST['use_mail']);
		}else{
			$error['use_mail'] = "Bạn chưa nhập email";
		}
		//Kiểm tra password đã được nhập hay chưa
		if(!empty($_POST['use_pass'])) {
			$pass = $_POST['use_pass'];
		}else{
			$error['use_pass'] = "Bạn chưa nhập mật khẩu";
		}
		//Kiểm tra tên đã được nhập hay chưa
		if(!empty($_POST['use_full'])) {
			$name = $_POST['use_full'];
		}else{
			$error['use_full'] = "Bạn chưa nhập tên";
		}
		//Kiểm tra re_pass
		if(!empty($_POST['re_pass'])) {
			$re_pass = $_POST['re_pass'];
		}else{
			$error['re_pass'] = "Bạn chưa nhập lại mật khẩu";
		}
		if ($pass!=$re_pass) {
			$error['re_pass'] = "Bạn nhập lại mật khẩu chưa chính xác";
		}
		$type = $_POST['use_level'];
	
		$sql_email = "SELECT * FROM users WHERE use_mail = '$email'";
		$resultcheck = mysqli_query($conn, $sql_email);
		$check = mysqli_num_rows($resultcheck);
		if ($check>0) {
			$error['use_mail'] = "Email đã tồn tại";
		}
	
		//Khi không có lỗi xảy ra
		if(!isset($error['use_mail']) &&  !isset($error['use_pass']) &&  !isset($error['use_full']) &&  !isset($error['re_pass'])) {
			//trường hợp thỏa mãn tài khoản đăng nhập
			$sqlid = "SELECT * FROM users";
			$resultid = mysqli_query($conn, $sqlid);
			$countid = mysqli_num_rows($resultid);
			$use_id = $countid + 1;
			$sql = "INSERT INTO users(use_id,use_full, use_mail, use_pass, use_level) VALUES
					('$use_id','$name', '$email', '$pass', '$type')";
			if(mysqli_query($conn, $sql)) {
				header("location: index.php?page=user");
			}else{
				$error['invalid'] = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
			}
		}
	}
} else {
	$error['invalid'] = '<div class="alert alert-danger">Đây là quyền hạn của Admin !</div>';
}



?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li><a href="user.php">Quản lý thành viên</a></li>
			<li class="active">Thêm thành viên</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Thêm thành viên</h1>
		</div>
	</div><!--/.row-->
	<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-md-8">
						<?php if(isset($error['invalid'])) echo $error['invalid']; ?>
						<form role="form" method="post">
							<div class="form-group">
								<label>Họ & Tên</label>
								<input name="use_full" required class="form-control" placeholder="">
								<span style="color: red"><?php if(isset($error['use_full'])) echo $error['use_full']; ?></span>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input name="use_mail" required type="text" class="form-control">
								<span style="color: red"><?php if(isset($error['use_mail'])) echo $error['use_mail']; ?></span>
							</div>                       
							<div class="form-group">
								<label>Mật khẩu</label>
								<input name="use_pass" required type="password"  class="form-control">
								<span style="color: red"><?php if(isset($error['use_pass'])) echo $error['use_pass']; ?></span>
							</div>
							<div class="form-group">
								<label>Nhập lại mật khẩu</label>
								<input name="re_pass" required type="password"  class="form-control">
								<span style="color: red"><?php if(isset($error['re_pass'])) echo $error['re_pass']; ?></span>
							</div>
							<div class="form-group">
								<label>Quyền</label>
								<select name="use_level" class="form-control">
									<option value=1>Admin</option>
									<option value=2>Staff</option>
								</select>
							</div>
							<button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
							<button type="reset" class="btn btn-default">Làm mới</button>
						</div>
					</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
	
</div>	<!--/.main-->	

