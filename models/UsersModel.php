<?php 

include_once "connect/Config.php";


class UsersModel extends Config{
	private int $id;
	private string $username;
	private string $password;
	private string $remember_token;

	public function __construct(){
		parent::__construct();
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setUsername($username){
		$this->username = $username;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function setRemember_token($remember_token){
		$this->remember_token = $remember_token;
	}

	public function getId(){
		return $this->id;
	}

	public function getUsername(){
		return $this->username;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getRemember_token(){
		return $this->remember_token;
	}


	public function login($user){
		$username = $user->getUsername();
		$password = $user->getPassword();
		$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
		return mysqli_query($this->conn,$sql);
			}

	public function updateToken($user){
		$token = $user->getPassword();
		$username= $user->getUsername();
		setcookie('user_token',$token,time()+3600,'/');
		$sql = "UPDATE users SET remember_token = '$token' WHERE username = '$username' AND password = '$token' ";
		return mysqli_query($this->conn,$sql);
	}

	public function logout(){
		session_destroy();
		//unset($_COOKIE['user_token']);
		setcookie('user_token',"",time()-3600,'/');
	}

	public function checkToken($token){
		$sql = "SELECT * FROM users WHERE remember_token = '$token' ";
		$q  = mysqli_query($this->conn,$sql);
		return mysqli_fetch_assoc($q);
	}




}

 ?>