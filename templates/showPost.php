<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>POST</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/mycss.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/myjs.js"></script>
</head>
<body>

	<h3><?php echo unserialize(serialize($_SESSION['user_token']))->getUsername(); ?></h3>
	<?php
	// echo "<pre>";
	// print_r();
	// echo "</pre>";
			if(isset($_SESSION['noti_edit_post'])&&$_SESSION['noti_edit_post']==1){
		?>
			<div class="alert alert-success view_noti">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Bạn đã edit thành công</strong> 
		</div>
		<?php
			unset($_SESSION['noti_edit_post']);
			}

			if(isset($_SESSION['noti_add_post'])&&$_SESSION['noti_add_post']==1){
		?>
			<div class="alert alert-success view_noti">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Bạn đã add thành công</strong> 
		</div>
		<?php
			unset($_SESSION['noti_add_post']);
			}
			if(isset($_SESSION['noti_delete_post'])&&$_SESSION['noti_delete_post']==1){
		?>
			<div class="alert alert-success view_noti">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Bạn đã delete thành công</strong> 
		</div>
		<?php
			unset($_SESSION['noti_delete_post']);
			}
		 ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div >
		
			<div class="btn1">
				<a class="btn btn-primary" href="?ctl=Post&action=addPost"  type="button">Add</a>
			
				<a class="btn btn-danger" type="button"  href="?ctl=Users&action=logout">Logout</a>
			</div>
		
	</div>

	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Content</th>
					<th>Time</th>
					<th>Avatar</th>
					<th>Tag</th>
					
					<th colspan="2" style="text-align: center;">Option</th>

				</tr>
			</thead>
			<tbody>
				<?php $stt=0; foreach ($data as $key => $value){$stt++;?>

					<tr>

					<td><?php echo $stt; ?></td>

					<td><?php echo $value->getTitle(); ?></td>

					<td><?php echo $value->getContent(); ?></td>

					<td><?php echo $value->getTime(); ?></td>

					<td><img src="<?php echo $value->getUrl_thumbnail(); ?>" alt="img_alt" width="150"></td>

					<td><?php echo $value->getTag(); ?><td>

					<td><a href="?ctl=Post&action=edit&id=<?php echo $value->getId(); ?>"><i class="fa fa-edit" style="font-size:20px;"></i></a></td>

					<td><a href="?ctl=Post&action=delete&id=<?php echo $value->getId(); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o" style="font-size:20px;color:red"></i></a></td>
					
				</tr>

				<?php } ?>
				
			</tbody>
		</table>
	</div>
			</div>
		</div>
	</div>
	
</body>
</html>