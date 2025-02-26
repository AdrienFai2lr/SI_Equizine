<header class="masthead bg-primary text-white text-center">
	<div class="container d-flex align-items-center flex-column">
		<!-- Masthead Avatar Image-->
		<h1 color:black>
			<?php 
			//affichage du code + intitule du match + quiz
			echo "Code du match $cd_m";
			echo "<br>";
			echo "Corriger du match";	
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
							
							if($ir['validite_rep']=='V'){

							echo "<h3 style='color:#FFFF00;'>"; echo "Bonne réponse ---> "; echo $ir['libelle_rep'];echo"</h3>";

						}
							else{
								echo $ir['libelle_rep'];
							}
							


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
		<?php echo "<a class='btn btn-info' href="; echo base_url('index.php/accueil/afficher'); echo ">Accueil Ici</a>"; ?>
		
	</div>
</header>