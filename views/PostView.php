<?php 
 
 class PostView{
 	public function showPost($data){
		 include_once "templates/showPost.php";
 	 }

 	 public function addPostView($data){
 	 	include_once "templates/addPostView.php";
 	 }

 	 public function showFormEdit($data){
 	 	include_once "templates/formEdit.php";
 	 }

 	 
 }


 ?>