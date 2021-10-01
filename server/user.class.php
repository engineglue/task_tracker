<?php
	
	//logged in user information
	class user{

		public $user_id;
		
		public $username;
		
		public $roles;

		public $email;
		
		public $password;
	
		public function __construct(){

		}

		public function showUserID(){
		  echo $this->user_id;
		}

		public function showUsername(){
		  echo $this->username;
		}
		
		public function showRole(){
		  echo $this->roles;
		}
		
		public function showEmail(){
		  echo $this->email;
		}
		
		public function showPassword(){
		  echo $this->password;
		}

	}
	
	//only engage if the user is logged in
	if(isset($_SESSION['user_id'])){
		$user = new user;
		$user->user_id = $_SESSION['user_id'];
		$user->username = get_user_detail($user->user_id, "username");
		$user->roles = get_user_roles($user->user_id);
		$user->email = get_user_detail($user->user_id, "email");
		$user->password = get_user_detail($user->user_id, "password");
	}
	
?>