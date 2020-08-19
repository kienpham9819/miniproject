<?php 
 session_start();
 ob_start();
	date_default_timezone_set('Asia/Ho_Chi_Minh');
$controller_name ="UsersController";
$action ="checkLogin";



if(isset($_GET['ctl'])){
	$controller_name = $_GET['ctl']."Controller";
}

if(isset($_GET['action'])){
	$action = $_GET['action'];
}

if(!isset($_SESSION['user_token'])&&empty($_COOKIE['user_token'])&&$controller_name!="UsersController"&&$action!="checkLogin"){
	header("Location:?ctl=Users&action=checkLogin");
}
else {
	include_once "controllers/".$controller_name.".php";
	$route  = new $controller_name();
	$route->$action();

}

// echo "<pre>";
// print_r($this->user);
// echo "</pre>";
echo "vuong";

 ob_end_flush();
?>
