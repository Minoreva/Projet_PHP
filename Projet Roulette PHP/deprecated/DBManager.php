<?php
class DBManager{
	
private $bdd;


	public function __construct(){
		try {
			$this->bdd = new PDO('mysql:host=localhost;dbname=roulette;charset=utf8',
				'Minoreva', //username
				'SdGoW04QH2SmM44c'	//password
		);
		} catch (Exception $e){
			die('Erreur : '.$e->getMessage());
		}

	}



	public function connectUser($nom, $mdp){
	try{				
				$requete ='SELECT username,password,money from users where username like :t_nom'; //renvoie ligne de user=nom
				$req = $this->bdd->prepare($requete);
					$req->execute( array( 
						't_nom' => $nom
					));

				$data = $req->fetch();
				$usern=$data['username'];		//stocke rep username
				$passw=$data['password'];		//stocke rep password
				$argen=$data['money'];			//stocke rep money 
				$req->closeCursor();

				if($nom == $usern && $mdp == $passw){

					$_SESSION['username']=$nom; // on pourrait mettre usern
					$_SESSION['password']=$mdp; // on pourrait mettre passw mais ?
					$_SESSION['argent']=$argen;
					header('Location: roulette.php');
				} else {
					echo 'erreur lors de la saisie';
				}

			} catch (Exception $e){
			die('Erreur : '.$e->getMessage());
			}
	}

	public function createUser($nom,$mdp){
				$argent=0;
				////////////////////////////////////////////////
				// SQL SELECT PLAYER USERNAME AND PASSWORD TO CHEKC IF SESSION USER AND PASSWORD == DATABASE USER AND PASSWORD
				$requete ='Select username from users where username like :t_nom'; //and password like :t_password
				$req = $this->bdd->prepare($requete);
					$req->execute( array( 
						't_nom' => $_SESSION['username']
					));

				$data = $req->fetch();
				$select_user=$data['username'];
				$req->closeCursor();
				////////////////////////////////////////////////
				
				if($select_user==$nom){
				unset($_SESSION['username']);
				unset($_SESSION['password']);
				unset($_SESSION['argent']);	
				
				// afficher un message d'erreur dans le HTML avec une variable php $echo_msg = et if existe en bas, tout ça
				} else {
				///////////////////////////////////////////////
				//realisation de la requête SQL INSERT
					var_dump($data);
				$requete = 'INSERT INTO users(username, password, money) VALUES (:t_nom,:t_mdp,:t_argent)';

				$req = $this->bdd->prepare($requete);
				$req->execute( array(
					't_nom' => $nom,
					't_mdp' => $mdp,
					't_argent' => $argent
				));						
				//////////////////////////////////////////////			
				header('Location: roulette.php');
				}
	}

	public function updatePlayerMoney($money,$nom){
				$requete = 'UPDATE users SET money = ? where username like ?';
				$req = $this->bdd->prepare($requete);
				$req->execute(array($money,$nom));
	}

	public function updateGamesLogs($id_user,$bet){
				$profit=$bet*2;
				$requete = 'INSERT INTO game(player, date, bet, profit) VALUES (:id_player,NOW(),:bet,:profit)';
				$req = $this->bdd->prepare($requete);
				$req->execute( array(
					'id_player' => $id_user,
					'bet' => $bet,
					'profit' => $profit
				));	
	}

	public function BinaryPerduTheGame($id_user,$bet){
				$profit=0;
				$requete = 'INSERT INTO game(player, date, bet, profit) VALUES (:id_player,NOW(),:bet,:profit)';
				$req = $this->bdd->prepare($requete);
				$req->execute( array(
					'id_player' => $id_user,
					'bet' => $bet,
					'profit' => $profit
				));	
	}

	public function getPlayerId($nom){
			$requete ='SELECT id from users where username like :t_nom';
			$req = $this->bdd->prepare($requete);
				$req->execute( array( 
					't_nom' => $nom
				));

			$data = $req->fetch();
			$id_user=$data['id'];
			$req->closeCursor();
			return $id_user;
	}



	public function unsetUser(){
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		unset($_SESSION['argent']);	
	}



}