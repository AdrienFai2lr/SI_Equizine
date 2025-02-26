<?php 

/*=============================================================
// Nom du fichier : actualite_afficher.php
// Auteur : Adrien FAILLER   
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// Page du d'acceuil qui permet l'affichage des actualités et
// des zones de saisies pour l'accès à un match.
// ------------------------------------------------------------
// A noter :
// Nothing.
//=============================================================*/
?>

<header class="masthead bg-primary text-white text-center">
<div class="container d-flex align-items-center flex-column">
<h2> Accéder à un match en ligne </h2>


	<?php

	//form php pour inserer un code de match + pseudo -> action = match/verif

	echo validation_errors();
	echo form_open('match/verif');
	echo form_label('Code du match : ');
	$champ1=array('name'=>'code',
		'required'=>'required');
	echo form_input($champ1);
	echo form_label('Votre pseudo : ');
	$champ2=array('name'=>'pseudo',
		'required'=>'required');
	echo form_input($champ2);
	?>
<input type="submit" name="submit" value="Acceder au match" />
</form>	



<br><br>



<!-- Masthead Avatar Image-->
<h1 color:black></h1>
	
	<?php echo "<h2>"; echo $titre; echo "</h2>";?>
		


<div class="divider-custom divider-light">
<div class="divider-custom-line"></div>
<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
<div class="divider-custom-line"></div>
</div>
<!-- verification des données de $actu-->
<?php if ($actu != NULL){?>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Pseudo</th>
			<th>Actualité</th>
		</tr>
	</thead>
	<tbody>

		<?php
		
// Boucle de parcours de toutes les lignes du résultat obtenu
		foreach($actu as $a){
// Affichage d’une ligne de tableau pour un pseudo non encore traité
			if (!isset($traite[$a["pseudo_com"]])){
				$cpt_id=$a["pseudo_com"];
				echo "<tr>";
				echo "<td>";echo $a["pseudo_com"];echo "</td>";
				echo "<td>";
// Boucle d’affichage des actualités liées au pseudo
		
				foreach($actu as $act){
					echo "<ul>";
					if(strcmp($cpt_id,$act["pseudo_com"])==0){
						echo "<li>";
						echo " -- ";
						echo $act["description_act"];
						echo " -- ";
						echo $act["titre_act"];
						echo " -- ";
						echo $act["date_act"];echo "</li>";
					}
					echo "</ul>";
				}
				echo "</td>";
// Conservation du traitement du pseudo
// (dans un tableau associatif dans cet exemple !)
				$traite[$a["pseudo_com"]]=1;
				echo "</tr>";
			}
		}
	}
	else {
		echo "<br />";
		echo "Aucune actualité pour le moment !";
	}
	?>

	
</tbody>
</table>



<!-- Masthead Heading-->

<!-- Icon Divider-->
<div class="divider-custom divider-light">
<div class="divider-custom-line"></div>
<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
<div class="divider-custom-line"></div>
</div>
<!-- Masthead Subheading-->


</div>
</header>