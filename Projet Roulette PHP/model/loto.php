<?php
require_once('fonctions.php');
if(isset($_GET['btnRoulette'])) {
	# La boucle suivante vérifie que chacun des champs du formulaire existe et a bien été rempli

		if(!isset($_GET['mise'])&& 
		!isset($_GET['nombre_choisi'])&& 
		!isset($_GET['parite']) ) {
			echo 'ERREUR, un numéro est manquant ou éronné';
			# Si un champs est mauvais, le programme s'arrête

		}


	$tirage_officiel = tirage();
	var_dump($tirage_officiel); # Affichages rapides des tableaux
	var_dump($_GET);            # utilisé pour le debug uniquement
	$numeros_trouves = 0;
		$numero_joueur = $_GET['nombre_choisi'];
		if(in_array($numero_joueur, $tirage_officiel))
			$numeros_trouves++;


	echo 'Vous avez trouvé <strong>'.$numeros_trouves.'</strong> du tirage officiel !';
}