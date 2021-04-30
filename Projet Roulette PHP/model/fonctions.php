<?php

function formulaireRoulette() {
	echo '<form method="get" action="index.php?formu">
	<h2>Information de jeu :</h2>
	Mise :<input type="number" name="mise" placeholder="1" min="1" /><br>
	Nombre choisi :<input type="number" name="nombre_choisi" min="1" max="36"/><br>
	Pair :<input type="radio" id="Pair" name="parite" value="Pair">
	Impair :<input type="radio" id="Impair" name="parite" value="Impair">
	<button name="btnRoulette">Valider</button>
	</form>
	';
}

function tirage() {
	$tirage = rand(1, 1); //1,1 pour débug et faire des réussites sures :)
	return $tirage;
}

function loto() {

	$tirages = tirage();
	echo 'Numéro '. $tirages .'</th>';

}

