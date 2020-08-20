<?php 
declare(strict_types = 1);
include_once "models/UsersModel.php";
include_once "views/UsersView.php";

class UsersController {
	public $route;
	public $view;


	public function __construct(){
		$this->route = new UsersModel();
		$this->view = new UsersView();
	}

	public function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data =  preg_replace('/\s+/',' ', $data);
		  $data = htmlspecialchars($data);
		  return $data;
		}

	public function checkLogin(){

		
		if(isset($_SESSION['user_token'])&&!empty($_SESSION['user_token'])||isset($_COOKIE['user_token'])&&!empty($this->route->checkToken($_COOKIE['user_token'])))
			header('Location:?ctl=Post&action=getPost');

			else{
			 $this->view->loginView($data="");
			 unset($_SESSION['err_login']);
			 }
	
		}
		
	

	public function login(){
		
		if(isset($_SESSION['user_token'])&&!empty($_SESSION['user_token'])||isset($_COOKIE['user_token'])&&!empty($this->route->checkToken($_COOKIE['user_token'])))
			header("Location:?ctl=Post&action=getPost");
		
		$username= $password =$remember_pass = "";
		$username_er=$password_er="";
		if(isset($_POST['btn_login_post'])){
			$username = $this->test_input($_POST['username']);
			$password = $this->test_input($_POST['password']);
			if(isset($_POST['remember_pass']))
				$remember_pass = $_POST['remember_pass'];
		}



		$password = md5($password);
		$user = new UsersModel();
		$user->setUsername($username);
		$user->setPassword($password);

		$q = $this->route->login($user);
		$rs = mysqli_fetch_assoc($q);
		$num= mysqli_num_rows($q);
		if($num==1) {  
			$user->setId($rs['id']);
			
			$user->setRemember_token(!empty($rs['remember_token'])?$rs['remember_token']:"");
			$_SESSION['user_token'] = $user;
			
			if($remember_pass=='on'){
				$this->route->updateToken($user);
			header("Location:?ctl=Post&action=getPost");
			}else{
				$_SESSION['user_token'] = $user;
				header("Location:?ctl=Post&action=getPost");
			}
			

		}
		else {
		
				$data = array(
				'username'=>$username,
				'password'=>$password,
				'user_pass_er'=>"Username or Password is wrong",
				
				);

				$_SESSION['err_login']= $data;
				header("Location:?ctl=Users&action=Checklogin");
			
		}
	}

	public function logout(){
		$this->route->logout();
		header("Location:?ctl=Users&action=checkLogin");
	}

	public function addUser(){
		$this->view->addUser();
	}



}

 ?> 
