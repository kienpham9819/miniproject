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
// print_r($_SESSION['err_add']);
// echo "</pre>";
	 ?>
	
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<form action="?ctl=Post&action=saveNewPost" method="POST" role="form" enctype="multipart/form-data">
		<legend>Form Add</legend>
		
		<div class="form-group">
			<label for="">Title</label><span class="err">* <?php if(isset($_SESSION['err_add']['title_err'])) echo $_SESSION['err_add']['title_err'] ; ?></span>
			<input type="text" class="form-control" id=""  value="<?php if(!empty($data)) echo $data->getTitle() ; ?> "  maxlength='50' required  name="title" placeholder="Type title">
		</div>

		<div class="form-group">
			<label for="">Content</label><span class="err">* <?php if(isset($_SESSION['err_add']['content_err'])) echo $_SESSION['err_add']['content_err'] ; ?></span>
			<textarea name="content" id=""   maxlength='500' required  class="form-control" cols="20" rows="5" placeholder="Type content"><?php if(!empty($data)) echo $data->getContent() ;?></textarea>
		</div>

		<div class="form-group">
			<label for="url_img"><span>Image</span><span class="err">*<?php if(isset($_SESSION['err_add']['url_img_err'])) echo $_SESSION['err_add']['url_img_err'] ; ?> </span><br><img src="images/icon/choose_img.png" width="60" id="lab_url" alt=""></label>
			<input type="file" class="form-control" style="display: none;"  id="url_img" name="url_img"  >
			<img src="#" id="img_add" alt="" width="100">
			
		</div>

		<div class="form-group">
			<label for="">Tag</label><span class="err">* <?php if(isset($_SESSION['err_add']['tag_err'])) echo $_SESSION['err_add']['tag_err'] ; ?></span>
			<input type="text" class="form-control" required value="<?php if(!empty($data)) echo $data->getTag() ;?>" id="" name="tag" maxlength='50' placeholder="Type tag">

		</div>
	
		
		<a href="?ctl=Post&action=addPost" type="button" class="btn btn-danger">Reset</a>
		<button type="submit" name="btn_add_post" class="btn btn-primary">Save</button>
		<a href="?ctl=Post&action=getPost" type="button" class="btn btn-info">List</a>
	</form>
	
			</div>
		</div>
	</div>
	
</body>
</html>
