<?php
require_once('Game_dto.php');

class Game_dao
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

	
					//updateGamesLogsLoose($id_user,$bet){...}
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











}