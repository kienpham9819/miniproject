<?php 
	
	class Config{

		protected $conn;
		public function __construct(){
				$this->conn = mysqli_connect('localhost','root','123','blog')or die("Can't connect db!");
				if($this->conn){
		        mysqli_set_charset($this->conn,"utf8");
		        //echo "connect success";
		    }
		}
	}


 ?>