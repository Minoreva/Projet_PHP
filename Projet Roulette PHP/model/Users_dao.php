<?php
require_once('Users_dto.php');

class Users_dao
{
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

	
	public function getByUsername($username) {
		$sql = 'SELECT * FROM users WHERE username like ?';
		$req = $this->bdd->prepare($sql);
		$req->execute([$username]);
		$data = $req->fetch();
		$users = new Users_dto($data['id'],$username,$data['password'],$data['money']);
		if($data!=null){
			return $users;
		}else{
			return null;
		}
	}	

	public function connectUser($nom, $mdp){
		try{				
					$user = $this->getByUsername($nom);
					if($user!=null){

						$usern=$user->getUsername();
						$passw=$user->getPassword();
						$argent=$user->getMoney();
						$id_pl=$user->getId();
			
						if($nom == $usern && $mdp == $passw){

							$_SESSION['username']=$nom;
							$_SESSION['password']=$mdp;
							$_SESSION['argent']=$argent;
							$_SESSION['id']=$id_pl;
							
						}else{
							echo 'Comment t as fait pour avoir ce message d erreur ?';
						}

					}else{
						echo 'erreur lors de la saisie';
					}

		} catch (Exception $e){
				die('Erreur : '.$e->getMessage());
		}
	}

	public function createUser($nom,$mdp){
				$argent=0;

				$user = $this->getByUsername($nom);
				if($user != null){
					unset($_SESSION['username']);
					unset($_SESSION['password']);
					unset($_SESSION['argent']);
					header('Location: index.php?usernameused');					
				} else {					
				///////////////////////////////////////////////
				//realisation de la requête SQL INSERT
				$requete = 'INSERT INTO users(username, password, money) VALUES (:t_nom,:t_mdp,:t_argent)';
				$req = $this->bdd->prepare($requete);
				$req->execute( array(
					't_nom' => $nom, //equivalent à $user->getUsername
					't_mdp' => $mdp, // mutatis mutandis
					't_argent' => $argent
				));						
				//////////////////////////////////////////////			
				}
	}

	public function updatePlayerMoney($money,$nom){
				$user = $this->getByUsername($nom);
				if($user!=null){
					$user->setMoney($money);
					$requete = 'UPDATE users SET money = ? where username like ?';
					$req = $this->bdd->prepare($requete);
					$req->execute(array($user->getMoney(),$user->getUsername()));
				}else{
					echo 'erreur lors de la saisie';
					return null;
				}
	}

}