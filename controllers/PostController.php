<?php 
	
	declare(strict_types = 1);
	include_once "models/PostModel.php";
	include_once "views/PostView.php";
	include_once "models/UsersModel.php";
	

	class PostController{

		
		private $route;
		private $view;
	

		public function __construct(){
			$this->route = new PostModel();
			$this->view = new PostView();
		}

		public function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
	

		public function getPost()
		{
			
			$data = $this->route->getPost();
			
			$this->view->showPost($data);
			
		}

		public function edit(){

				$id = $_GET['id'];
				$data = $this->route->editForm($id);
				$this->view->showFormEdit($data);
				

		}

		public function saveEdit(){
			
			$title = $content =$url_img = $tag="";

		
			
			 if(isset($_POST['btn_edit_post'])){
			 
				$title = $this->test_input($_POST['title']);
				$content = $this->test_input($_POST['content']);

				$url_img = !empty($_FILES['img_edit']['name'])? "images/".time().$_FILES['img_edit']['name']:$_POST['reverse_url'];
				$tag = $this->test_input($_POST['tag']);
				$id = $this->test_input($_POST['id_post']);

				if(empty($title)||empty($content)||empty($tag)){
				$post =new PostModel();
				$post->setId($id);
				$post->setTitle($title);
				$post->setContent($content);
				$post->setUrl_thumbnail($_POST['reverse_url']);
				$post->setTag($tag);
				$_SESSION['err_edit'] = "Không được bỏ trống các trường *";
				$this->view->showFormEdit($post);
				 unset($_SESSION['err_edit']);
			}

			else{
				
				$post =new PostModel();
				$post->setId($id);
				$post->setTitle($title);
				$post->setContent($content);
				$post->setUrl_thumbnail($url_img);
				$post->setTag($tag);

				$status = $this->route->saveEditPost($post);
				if($status!==false){
					$_SESSION['noti_edit_post'] =1;
					header('Location:index.php?ctl=Post&action=getPost');
				}

			}
			}

		

			
			


			
		}

		public function addPost()
		{
			$this->view->addPostView($data="");
		}


		public function saveNewPost(){

			$title = $content =$url_img = $tag=$id_user="";

			if(isset($_POST['btn_add_post'])){
				$title = $this->test_input($_POST['title']);
				$content = $this->test_input($_POST['content']);
				$url_img = !empty($_FILES["url_img"]["name"])?"images/".time().$_FILES["url_img"]["name"]:"";
				$tag = $this->test_input($_POST['tag']);
				$id_user= unserialize(serialize($_SESSION['user_token']))->getId();
				

				if(empty($title)||empty($content)||empty($url_img)||empty($tag)||empty($url_img)){
					$post =new PostModel();
					$post->setTitle($title);
					$post->setContent($content);
					$post->setUrl_thumbnail($url_img);
					$post->setTag($tag);
					$_SESSION['err_add'] = "Không được bỏ trống các trường *";
					  
					$this->view->addPostView($post);
					unset($_SESSION['err_add']);
				}
				else{

					 $post =new PostModel();
					 $post->setTitle($title);
					 $post->setContent($content);
					 $post->setUrl_thumbnail($url_img);
					 $post->setTag($tag);
					 $post->setId_user($id_user);
					
					$this->route->saveNewPost($post);
					$_SESSION['noti_add_post'] =1;
					header("Location:index.php?ctl=Post&action=getPost");

				}
			 
			}
			
		}

		public function delete(){
			$id = "";
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				$this->route->delete($id);
				$_SESSION['noti_delete_post'] =1;
				header("Location:index.php?ctl=Post&action=getPost");
			}


		}



	}

 ?>