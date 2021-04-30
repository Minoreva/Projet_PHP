<?php

class Game_dto {
	private $player;
	private $date;
	private $bet;
	private $profit;

	public function __construct($p, $d, $b, $pr) {
		$this->player = $p;
		$this->date = $d;
		$this->bet = $b;
		$this->profit = $pr;
	}


	public function getPlayer(){
		return $this->player;
	}

	public function getDate(){
		return $this->date;
	}

	public function getBet(){
		return $this->bet;
	}		

	public function getProfit(){
		return $this->profit;
	}

	public function setPlayer($att){
		$this->player=$att;
	}

	public function setDate($att){
		$this->date=$att;
	}

	public function setProfit($att){
		$this->profit=$att;
	}

	public function setBet($att){
		$this->bet=$att;
	}			
}