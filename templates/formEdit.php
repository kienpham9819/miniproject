<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>POST</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/mycss.css">
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/myjs.js"></script>
</head>
<body>
	<?php 
// 	echo "<pre>";
// print_r($_SESSION['err_edit']);
// echo "</pre>";	 ?>

	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<form action="?ctl=Post&action=saveEdit" method="POST" role="form" enctype="multipart/form-data">
		<legend>Form Edit</legend>
		<input type="number" hidden="" name="id_post" value="<?php echo $data->getId(); ?>">
		<div class="form-group">
			<label for="">Title</label><span class="edit_err">* <?php if(isset($_SESSION['err_edit']['title_err'])) echo $_SESSION['err_edit']['title_err']; ?></span>
			<input type="text" class="form-control" id="" maxlength='50' name="title" required="" value="<?php echo $data->getTitle(); ?>">
		</div>

		<div class="form-group">
			<label for="">Content</label><span class="edit_err">*<?php if(isset($_SESSION['err_edit']['content_err'])) echo $_SESSION['err_edit']['content_err']; ?></span>
			<textarea name="content" id="" required="" maxlength='500'  class="form-control" cols="20" rows="5" ><?php echo $data->getContent(); ?></textarea>
		</div>

		<div class="form-group">
			<label for="img_edit"><span>Image</span><br><img src="<?php echo $data->getUrl_thumbnail();?>" width="100" id="url_edit" alt=""></label>
			
			<input type="file" class="form-control"  style="display: none;"  id="img_edit" name="img_edit"  >
			
		</div>

		<div class="form-group">
			<label for="">Tag</label><span class="edit_err">* <?php if(isset($_SESSION['err_edit']['tag_err'])) echo $_SESSION['err_edit']['tag_err']; ?></span>
	<input type="text" class="form-control" maxlength='50'  id="" name="tag" required="" value="<?php echo $data->getTag(); ?>">

		</div>
	
		<input type="hidden" name="reverse_url" value="<?php echo $data->getUrl_thumbnail() ; ?>">

		<a type="button" href="?ctl=Post&action=edit&id=<?php echo $data->getId(); ?>" class="btn btn-danger">Reset</a>
		<button type="submit" name="btn_edit_post" class="btn btn-primary">Save</button>

		<a type="button" href="?ctl=Post&action=getPost" class="btn btn-info">List</a>
		
	</form>
			</div>
		</div>
	</div>
	
</body>
</html>
