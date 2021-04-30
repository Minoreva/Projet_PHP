				<section>
				<h3>Roulette :</h3>
				<?php
					loto();
					formulaireRoulette();
					if(isset($affiche_win)){echo $affiche_win;}
					if(isset($victoire)){echo $victoire;}
				?>
				</section>