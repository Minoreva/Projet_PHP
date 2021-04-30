<?php

class Users_DTO {
	private $id;
	private $username;
	private $password;
	private $money;

	public function __construct($i, $u, $p,$m) {
		$this->id = $i;
		$this->username = $u;
		$this->password = $p;
		$this->money =$m;
	}

	public function getUsername(){
		return $this->username;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getMoney(){
		return $this->money;
	}

	public function getId(){
		return $this->id;
	}

	public function setMoney($att){
		$this->money=$att;
	}

	public function setId($att){
		$this->id=$att;
	}

	public function setUsername($att){
		$this->username=$att;
	}

	public function setPassword($att){
		$this->password=$att;
	}	
}


