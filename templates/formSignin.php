<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>LOGIN</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/mycss.css">
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/myjs.js"></script>
</head>
<body>

	<?php
			if(isset($_SESSION['err_login'])&&$_SESSION['err_login']==1){
		?>
			<div class="alert alert-danger view_noti">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Username or password is wrong@@</strong> 
		</div>
		<?php
			unset($_SESSION['err_login']);
			}
		?>	

	<div class="container">

		<div class="row">
			<div class="col-md-6">
				<form action="?ctl=Users&action=login" method="POST" role="form">
					<legend>Form Signin</legend>
					
					<div class="form-group">
						<label for="username_u">Username</label><span class="err"><?php if(isset($data['username_er'])&&!empty($data['username_er'])) echo $data['username_er']; ?></span>
						<input type="email" class="form-control" required="" id="username_u"  name="username" placeholder="Type your username" value="<?php echo $data['username']; ?>">
					</div>

					<div class="form-group">
						<label for="password_u">Password</label><span class="err"><?php if(isset($data['password_er'])&&!empty($data['password_er'])) echo $data['username_er']; ?></span>
						<input type="password" class="form-control" required=""  id="password_u" name="password" placeholder="********">
						
					</div>
					
					<!-- <input type="checkbox" name="remember_pass"> <span>Nhớ mật khẩu</span></br></br> -->
				
					<button type="submit" name="btn_signin" class="btn btn-primary">Signin</button>
					
					
				</form>
				
			</div>
		</div>
	</div>
	
</body>
</html>
