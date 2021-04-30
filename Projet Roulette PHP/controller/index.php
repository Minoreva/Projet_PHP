<?php
session_start();
require_once('../model/Users_dao.php');
require_once('../model/Game_dao.php');
require_once('../model/fonctions.php');
$module='connexion';
$dao = new Users_dao();
$dao_game = new Game_dao();


/*---------------traitement des $_POST-----------------------*/
/*----Connexion----*/

if(isset($_POST['btnValider'])){
	if(isset($_POST['username']) && $_POST['username'] !=''
	&&isset($_POST['password']) && $_POST['password'] !=''){
		$dao->connectUser($_POST['username'],$_POST['password']);
		$module='roulette';
	}
}

/*----Inscription----*/

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
		}
			
}

/*---------------------traitement des $_GET-------------------*/
/*-deconnexion-*/
if(isset($_GET['deco'])){
	unset($_SESSION['username']);
	unset($_SESSION['password']);
	unset($_SESSION['argent']);	
	unset($_SESSION['id']);
}

/*-passage vers l'index inscription-*/
if(isset($_GET['inscription'])){
	$module='inscription';
}

if(isset($_GET['usernameused'])){
	$module='inscription';
	$message ='<p>Ce nom est déjà utilisé</p>';
}

/*-passage vers l'index connexion-*/
if(isset($_GET['co'])){
	$module='connexion';
}



/*---------------ROULETTE---------------------------*/

if(isset($_GET['btnRoulette'])) {
		if(!isset($_GET['mise'])&& 
		!isset($_GET['nombre_choisi'])&& 
		!isset($_GET['parite']) ) {
			echo 'ERREUR, un numéro est manquant ou éronné';

		}

		$victoire='';
		$tirage_officiel = tirage();
		#mise=0
		//var_dump($tirage_officiel);
		//var_dump($_GET);            # utilisé pour le debug uniquement
		$numeros_trouves = 0;
			$numero_joueur = $_GET['nombre_choisi'];
			$id_user=$_SESSION['id'];
			$bet=$_GET['mise'];	
			if($numero_joueur == $tirage_officiel){
				$_SESSION['argent']=$_GET['mise']*2 + $_SESSION['argent'];			
				$money_a_update=$_GET['mise']*2 + $_SESSION['argent'];
				$nom=$_SESSION['username'];

				$dao->updatePlayerMoney($money_a_update,$nom);
				$bet=$_GET['mise'];
				$dao_game->updateGamesLogs($id_user,$bet);
				$victoire='<center>Vous avez trouvé <strong> le bon nombre </strong> du tirage officiel !</center>';
			}else{
				$dao_game->BinaryPerduTheGame($id_user,$bet);
				$victoire='<center>Vous avez <strong> PERDU The Game </strong> le tirage officiel !</center>';
			}
			/*The Game est un jeu que l'on perd dès qu'on y pense. D'ailleurs, vous avez PERDU. :/
			Il existe deux règles fondamentales : (car j'aime pas la troisième)
			-	Tout le monde joue au Jeu (parfois restreint en : « tous les gens qui connaissent le Jeu y jouent », ou alors en « Tu joues continuellement au Jeu ») ;
			-	Qui pense au Jeu y perd immédiatement. Si vous lisez ceci, vous avez donc perdu ;
			https://fr.wikipedia.org/wiki/Le_Jeu_(divertissement)
			*/			
	
}


/*----------------'auto-redirection' quand connecté ---------------*/

if(isset($_SESSION['username'])){
	$module='roulette';
}

//var_dump($_SESSION);


/*---------------------Gestion des views--------------------------*/

switch ($module) {
    case 'connexion':
        include('../view/start.php');
		include('../view/connexion/header.php');
		include('../view/main_start.php');
		include('../view/connexion/form.php');
		include('../view/main_end.php');
		include('../view/end.php');
        break;
    case 'inscription':
		include('../view/start.php');
		include('../view/inscription/header.php');
		include('../view/main_start.php');
		include('../view/inscription/form.php');
		include('../view/main_end.php');
		include('../view/end.php');
        break;
    case 'roulette':
		include('../view/start.php');
		include('../view/roulette/header.php');
		include('../view/main_start.php');
		include('../view/roulette/roulette.php');
		include('../view/main_end.php');
		include('../view/end.php');
        break;
}