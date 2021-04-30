<?php
session_start();
var_dump($_SESSION);

require_once('../model/Users_dao.php');
$dao = new Users_dao();
$message = '';
if(isset($_POST['btnInscription'])){
	if(isset($_POST['username']) && $_POST['username'] !=''
	&&isset($_POST['password']) && $_POST['password'] !=''){
			$_SESSION['username']=$_POST['username'];
			$_SESSION['password']=$_POST['password'];
			$_SESSION['argent']=0;

			$nom=$_POST['username'];
			$mdp=$_POST['password'];

			$dao->createUser($nom,$mdp);
			$message ='<p>Ce nom est déjà utilisé</p>';
		}			
	}

include('../view/start.php');
include('../view/inscription/header.php');
include('../view/main_start.php');
include('../view/inscription/form.php');
include('../view/main_end.php');
include('../view/end.php');