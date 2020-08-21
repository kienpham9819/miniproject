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
		  $data =  preg_replace('/\s+/',' ', $data);
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

				$array_err = array();
				

				if(empty($title)){
				$array_err['title_err'] = "Không được bỏ trống ";
			 	}

			 	if(empty($content)){
				$array_err['content_err'] = "Không được bỏ trống ";
			 	}

			 	if(empty($tag)){
				$array_err['tag_err'] = "Không được bỏ trống ";
			 	}
				
				if(strlen($title)>50){
						$array_err['title_err'] = 'Không được vượt quá 50 kí tự';
					}

				if(strlen($content)>500){
						$array_err['content_err'] = 'Không được vượt quá 500 kí tự';
					}
				if(strlen($tag)>50){
						$array_err['tag_err'] = 'Không được vượt quá 50 kí tự';
					}

			 	if($this->route->search_data_edit($title,$id)!==false){
					$array_err['title_err'] = "Title đã tồn tại ";
				}

				if(!empty($array_err)){
					$post =new PostModel();
					$post->setId($id);
					$post->setTitle($title);
					$post->setContent($content);
					$post->setUrl_thumbnail($_POST['reverse_url']);
					$post->setTag($tag);
					$_SESSION['err_edit'] = $array_err;
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
				}
				else {
					$_SESSION['noti_edit_post'] =2;
				}
				header('Location:index.php?ctl=Post&action=getPost');
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
				$array_err = array();
				

				if(empty($title)){
					
					$array_err['title_err'] = "Không được bỏ trống";
					
				}
				if(empty($content)){
					
					$array_err['content_err'] = "Không được bỏ trống";
					
				}
				if(empty($url_img)){
					
					$array_err['url_img_err'] = "Vui lòng chọn ảnh đại diện";
					
				}
				if(empty($tag)){
					
					$array_err['tag_err'] = "Không được bỏ trống";
					
				}


				if(strlen($title)>50){
						$array_err['title_err'] = 'Không được vượt quá 50 kí tự';
					}
				if(strlen($content)>500){
						$array_err['content_err'] = 'Không được vượt quá 500 kí tự';
					}
				if(strlen($tag)>50){
						$array_err['tag_err'] = 'Không được vượt quá 50 kí tự';
					}

				
				if($this->route->search_data($title)!==false){
					$array_err['title_err'] = "Title đã tồn tại ";
				}

				if(!empty($array_err)){
					$post =new PostModel();
					$post->setTitle($title);
					$post->setContent($content);
					$post->setUrl_thumbnail($url_img);
					$post->setTag($tag);
					$_SESSION['err_add'] = $array_err;
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
					
					$status = $this->route->saveNewPost($post);
					if($status!==false){
						$_SESSION['noti_add_post'] =1;
					}
					else {
						$_SESSION['noti_add_post'] =2;
					}

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