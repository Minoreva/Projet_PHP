<?php
session_start();
require_once('../model/fonctions.php');
require_once('../model/Users_dao.php');
require_once('../model/Game_dao.php');
$dao_users = new Users_dao();
$dao_game = new Game_dao();

var_dump($_SESSION);

if(!isset($_SESSION['username'])){
	header('Location: connexion.php');
}

if(isset($_GET['win'])){
	$affiche_win= '<center>Vous avez trouvé <strong> le bon nombre </strong> du tirage officiel !</center>';
}

if(isset($_GET['btnRoulette'])) {
		if(!isset($_GET['mise'])&& 
		!isset($_GET['nombre_choisi'])&& 
		!isset($_GET['parite']) ) {
			echo 'ERREUR, un numéro est manquant ou éronné';

		}


	$tirage_officiel = tirage();
	#mise=0
	var_dump($tirage_officiel); 
	var_dump($_GET);            # utilisé pour le debug uniquement
	$numeros_trouves = 0;
		$numero_joueur = $_GET['nombre_choisi'];
		$id_user=$dao_users->getPlayerId($_SESSION['username']);
		var_dump($id_user);
		$bet=$_GET['mise'];	

		if($numero_joueur == $tirage_officiel){
			$_SESSION['argent']=$_GET['mise']*2 + $_SESSION['argent'];			
			$money_a_update=$_GET['mise']*2 + $_SESSION['argent'];
			$nom=$_SESSION['username'];

			$dao_users->updatePlayerMoney($money_a_update,$nom);
			$bet=$_GET['mise'];
			$dao_game->updateGamesLogs($id_user,$bet);
			header('Location: roulette.php?win');
		}else{
			$dao_game->BinaryPerduTheGame($id_user,$bet);
			header('Location: roulette.php');
		}
}


include('../view/start.php');
include('../view/roulette/header.php');
include('../view/main_start.php');
include('../view/roulette/roulette.php');
include('../view/main_end.php');
include('../view/end.php');
