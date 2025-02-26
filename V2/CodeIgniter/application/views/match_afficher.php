<?php

/*=============================================================
// Nom du fichier : match_afficher.php
// Auteur : Adrien FAILLER   
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// Page du match, sur cette page, les informations liées au match
// son afficher (intitule,question & reponses).
// ------------------------------------------------------------
// A noter :
// Nothing.
//=============================================================*/

?>


<header class="masthead bg-primary text-white text-center">
	<div class="container d-flex align-items-center flex-column">
		<!-- Masthead Avatar Image-->




		<h1 color:black>


			<?php 


			//affichage du code + intitule du match + quiz
			echo "Code du match $cd_m";
			
			
			
			
			echo "<br>";	?>




		</h1>

<?php if($info_mat != null){echo "Intitule du quiz : $inti_matqui->intitule_qui";
			echo "<br>Intitule du match : $inti_matqui->intitule_mat<br>";
		echo "<div class='divider-custom divider-light'>";
			echo "<div class='divider-custom-line'></div>";
			echo "<div class='divider-custom-icon'><i class='fas fa-star'></i></div>";
			echo "<div class='divider-custom-line'></div>";
		echo "</div>";
	
			//variable pour compteur
			$nb_q=0;
			$nb_r=0;
			// Boucle de parcours de toutes les lignes du résultat obtenu
			foreach($info_mat as $iq){
				// Affichage d’une ligne de tableau pour un question non encore traité
				if (!isset($traite[$iq["txtq_que"]])){
					
					$txt=$iq["txtq_que"];
					$nb_q+=1;

					echo "<strong>question numero ".$nb_q." : "; echo $iq["txtq_que"]; echo"</strong>";
					

							

					// Boucle d’affichage des reponses liées au question
					foreach($info_mat as $ir){
						//verification de la question traite pour l'affichage de ses reps
						if(strcmp($txt,$ir["txtq_que"])==0){
							echo "<br>";
							
							echo form_open(base_url('index.php/match/resultat/'.$cd_m));
							echo $ir['libelle_rep'];
							echo form_checkbox('libelle[]', $ir['libelle_rep']);
							echo "<br>";

						}

					}echo "<br>";
					$nb_r=0;

// Conservation du traitement de la question
// (dans un tableau associatif dans cet exemple !)
					$traite[$iq["txtq_que"]]=1;

				}
			}
		}		
		else{
			echo "<br>";
			echo " Aucune question pour ce match pour l'instant";
		}
		?>
		<!-- Masthead Heading-->

		<!-- Icon Divider-->
		<div class="divider-custom divider-light">
			<div class="divider-custom-line"></div>
			<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
			<div class="divider-custom-line"></div>
		</div>
		<!-- Masthead Subheading-->
		<?php 
		
		echo form_submit('reponse', 'Validez vos réponses'); ?>
		
	</div>
</header>