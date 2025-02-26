


<header class="masthead bg-primary text-white text-center">
	<div class="container d-flex align-items-center flex-column">
		<!-- Masthead Avatar Image-->


<div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
        <div class="divider-custom-line"></div>
    </div>
    <!-- Masthead Heading-->  

		<h1 color:black>


			<?php 


			//affichage du code + intitule du match + quiz
			echo "code du match $cd_m";
			echo "<br>";
			$res=round($resultat,2);
			if($resultat<50){
				echo "pas ouf hein ! ";
				echo "<br>";
				echo "ton resultat : $res %";
			}else{
				echo "bien joué ! :D";
				echo "<br>";
				echo "ton resultat : $res %";
			}
			
			echo "<br>";	?>




		</h1>

<?php if($info_mat != null){

	echo "Intitule du quiz : $inti_matqui->intitule_qui";
	echo "<br>Intitule du match : $inti_matqui->intitule_mat";


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
		if($inti_matqui->etat_corriger_qui=='A'){
		echo "<strong>Si tu veux voir le corriger c'est ici ! </strong> ";
		echo "<br>";
		 echo "<a class='btn btn-info' href="; echo base_url('index.php/match/corriger/'.$cd_m); echo ">Voir la correction</a>"; 


		}
		else{
			echo "Pas de corriger pour ce quiz ! ";		
		}


		?>
		
	</div>
</header>