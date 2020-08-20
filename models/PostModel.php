<?php 
	
	include_once "connect/Config.php";

	
	class PostModel extends Config{

		private int $id;
		private string $title;
		private string $content;
		private string $time;
		private string $url_thumbnail;
		private string $tag;
		private int $id_user;
		

		public function __construct(){
			parent::__construct();
		}


		public function construct_all($id,$title,$content,$time,$url_thumbnail,$tag,$id_user){
			$ins = new self();
			$ins->setId($id);
			$ins->setTitle($title);
			$ins->setContent($content);
			$ins->setTime($time);
			$ins->setUrl_thumbnail($url_thumbnail);
			$ins->setTag($tag);
			return $ins;
		}

		public function setId($id){
			$this->id =$id;
		}

		public function setTitle($title){
			$this->title =$title;
		}

		public function setContent($content){
			$this->content =$content;
		}

		public function setTime($time){
			$this->time =$time;
		}

		public function setUrl_thumbnail($url_thumbnail){
			$this->url_thumbnail =$url_thumbnail;
		}

		public function setTag($tag){
			$this->tag =$tag;
		}

		public function setId_user($id_user){
			$this->id_user =$id_user;
		}

		public function getId(){
			return $this->id;
		}

		public function getTitle(){
			return $this->title;
		}

		public function getContent(){
			return $this->content;
		}

		public function getTime(){
			return $this->time ;
		}

		public function getUrl_thumbnail(){
			return $this->url_thumbnail;
		}

		public function getTag(){
			return $this->tag;
		}

		public function getId_user(){
			return $this->id_user;
		}

		


		public function getPost(){
// 			 if(isset($_SESSION['user_token'])){
// 			 				 	echo "<pre>";
// print_r(unserialize(serialize($_SESSION['user_token'])));
// echo "</pre>";die();
// 			 }

				$id_user = unserialize(serialize($_SESSION['user_token']))->getId();
			$sql = "SELECT * FROM post WHERE id_user = $id_user ORDER BY id DESC";
			$q = mysqli_query($this->conn,$sql);
			$data = array();

			if($q->num_rows > 0){

				while($k = mysqli_fetch_assoc($q)){
					$post = new self();
					$post->setId($k['id']);
					$post->setTitle($k['title']);
					$post->setContent($k['content']);
					$post->setTime($k['time']);
					$post->setUrl_thumbnail($k['url_thumbnail']);
					$post->setTag($k['tag']);
					$post->setId_user($k['id_user']);
					$data[] = $post;

				}
			}

			return $data;
		}


		public function editForm($id){
			$sql = "SELECT * FROM post WHERE id = $id";
			$q = mysqli_query($this->conn,$sql);
			$data = mysqli_fetch_assoc($q);
			$post = new self();
			$post->setId($data['id']);
			$post->setTitle($data['title']);
			$post->setContent($data['content']);
			$post->setTime($data['time']);
			$post->setUrl_thumbnail($data['url_thumbnail']);
			$post->setTag($data['tag']);
			return $post;
		}

		public function saveEditPost($data) {
			$title = $data->getTitle();
			$content = $data->getContent();
			$url_img = $data->getUrl_thumbnail();
			$tag = $data->getTag();
			$id = $data->getId();
			
			if(!empty($_FILES["img_edit"]["tmp_name"])){
			if (move_uploaded_file($_FILES["img_edit"]["tmp_name"], $url_img)) {
				    $sql = "UPDATE post SET title ='$title', content= '$content',url_thumbnail='$url_img',tag ='$tag' WHERE id =$id";
			return mysqli_query($this->conn,$sql);
			  } }
			  else {
			  	$sql = "UPDATE post SET title ='$title', content= '$content',tag ='$tag' WHERE id =$id";
			return mysqli_query($this->conn,$sql);
			  }

			
		}

		public function saveNewPost($data){

			$title = $content =$url_img = $tag=$id_user="";

			if(!empty($data)){
				$title = $data->getTitle();
				$content = $data->getContent();
				$url_img = $data->getUrl_thumbnail();
				$tag = $data->getTag();
				$id_user = $data->getId_user();
			}

			// echo "<pre>";
			// print_r($data);
			// echo "</pre>";die();
				
			if (move_uploaded_file($_FILES["url_img"]["tmp_name"], $url_img)) {
				    $sql = "INSERT INTO post (title,content,url_thumbnail,tag,id_user) 
				VALUES('$title','$content','$url_img','$tag',$id_user)";
				return mysqli_query($this->conn,$sql);
			  } 

			
				
			}


			public function delete($id){
				$sql  = "DELETE FROM post WHERE id = $id";

				return mysqli_query($this->conn,$sql);
			}

			public function search_data($data){
				$sql = "SELECT * FROM post WHERE title='$data'";
				$rs = mysqli_query($this->conn,$sql);
				if(mysqli_num_rows($rs)>=1) return true;
				return false;
			}

			public function search_data_edit($data,$id){
				$sql = "SELECT title FROM post WHERE id= $id";
				$q = mysqli_query($this->conn,$sql);
				$rs = mysqli_fetch_assoc($q);
				$t_o = $rs['title'];
				if($data==$t_o) return false;
				else{
					return $this->search_data($data);
				}
				
				
			}


		}


 ?>