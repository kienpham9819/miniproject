<?php 
 session_start();
 ob_start();
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	
	
$controller_name ="UsersController";
$action ="checkLogin";

if(isset($_GET['ctl'])&&!empty($_GET['ctl'])){
			$controller_name = $_GET['ctl']."Controller";
		}

if(isset($_GET['action'])&&!empty($_GET['action'])){
			$action = $_GET['action'];
		}



	if(isset($_SESSION['user_token'])){

		include_once "controllers/".$controller_name.".php";
		$route  = new $controller_name();
		$route->$action();
			}

		else if(isset($_COOKIE['user_token'])){
			$token = $_COOKIE['user_token'];
			include_once "models/UsersModel.php";
			$user = new UsersModel();
			$rs = $user->checkToken($token);
			
			if(!empty($rs)){
				
				$user->setId($rs['id']);
				$user->setUsername($rs['username']);
				$user->setPassword($rs['password']);
				$user->setRemember_token($rs['remember_token']);

				$_SESSION['user_token'] = $user;
			
				include_once "controllers/".$controller_name.".php";
				$route  = new $controller_name();
				$route->$action();
			}
			else{
				if($controller_name!="UsersController"&&$action!="checkLogin"){
					$controller_name = "UsersController";
					$action ="checkLogin";
				}
				include_once "controllers/".$controller_name.".php";
				$route  = new $controller_name();
				$route->$action();
			}
			
		}

		else if($controller_name!="UsersController"&&$action!="checkLogin"){
			$controller_name = "UsersController";
			$action ="checkLogin";
			include_once "controllers/".$controller_name.".php";
			$route  = new $controller_name();
			$route->$action();
		}

	else {
		include_once "controllers/".$controller_name.".php";
		$route  = new $controller_name();
		$route->$action();
	}	



// echo "<pre>";
// print_r($this->user);
// echo "</pre>";


 ob_end_flush();


?>
