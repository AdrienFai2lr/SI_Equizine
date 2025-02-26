

<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
       <?php echo "<h3>Changer votre mot de passe</h3>"?>
  <?php echo validation_errors(); ?>


        <?php echo form_open('compte/modif_mdp'); ?>


        <label for="mdp1">Votre nouveau mot de passe</label>
        <input type="password" name="mdp1" id="mdp1" /><br />
        <label for="mdp">Confirmez votre nouveau mot de passe</label>
        <input type="password" name="mdp2" id="mdp2"/><br />

        <input type="submit" name="submit" value="Validez" />
    </form>
<br>

        <?php 
        echo echo $this->session->userdata('pseudo');
        if($verif->role_pro=='A'){
            $tmp='Admin';

        }else{
            $tmp='Formateur';
        }


         echo "<h3>Bienvenue Monsieur/Madame $verif->nom_pro</h3>"?>
<br>
        <?php  echo "<h4> Vos informations personnelles : votre role $tmp </h4>"?>

        <br>
       

    <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
        <div class="divider-custom-line"></div>
    </div>


    <!-- Masthead Heading-->
   
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Role</th>
                    <th>Validite</th>
                    <th>Pseudo</th>
                    <th>MDP</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($verif!=NULL){

                    echo "<tr>";

                    echo "<td>";echo $verif->nom_pro;echo "</td>";
                    echo "<td>";echo $verif->prenom_pro;echo "</td>";
                    echo "<td>";echo $verif->role_pro;echo "</td>";
                    echo "<td>";echo $verif->validite_pro;echo "</td>";
                    echo "<td>";echo $verif->pseudo_com;echo "</td>";
                    echo "<td>";echo $verif->mdp_com;echo "</td>";

                    echo "</tr>";


                    if($verif->role_pro=='F'){
                    echo "<table class='table table-bordered'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo"<th>Intitule match</th>";
                    echo"<th>Intitule quiz</th>";
                    echo"<th>question du quiz</th>";
                    echo"<th>reponse </th>";
                    echo"<th>Validite de la rep</th>";
                    echo"<th>score</th>";
                    echo"</tr>";
                    echo"</thead>";
                    echo"<tbody>";
                    
                    foreach ($m_q_q as $m) {                       
                    echo "<tr>";
                    echo "<td>";echo $m['intitule_mat'];echo "</td>";
                    echo "<td>";echo $m['intitule_qui'];echo "</td>";
                    echo "<td>";echo $m['txtq_que'];echo "</td>";
                    echo "<td>";echo $m['libelle_rep'];echo "</td>";
                    echo "<td>";echo $m['validite_rep'];echo "</td>";
                    
                    echo "</tr>";
                }
                    

                    echo"</tbody>";
                    echo"</table>";

                }  
                    } ?>  
    </tbody>
    </table>
    
    <?php
                if($verif->role_pro=='A'){


                    echo "<table class='table table-bordered'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo"<th>Nom</th>";
                    echo"<th>Prénom</th>";
                    echo"<th>Role</th>";
                    echo"<th>Validite</th>";
                    echo"<th>Pseudo</th>";
                    echo"<th>MDP</th>";
                    echo"</tr>";
                    echo"</thead>";
                    echo"<tbody>";
                    
                    foreach ($all as $a) {                       
                    echo "<tr>";
                    echo "<td>";echo $a['nom_pro'];echo "</td>";
                    echo "<td>";echo $a['prenom_pro'];echo "</td>";
                    echo "<td>";echo $a['role_pro'];echo "</td>";
                    echo "<td>";echo $a['validite_pro'];echo "</td>";
                    echo "<td>";echo $a['pseudo_com'];echo "</td>";
                    echo "<td>";echo $a['mdp_com'];echo "</td>";
                    echo "</tr>";
                }
                    

                    echo"</tbody>";
                    echo"</table>";

                }          
            
            
            ?>
    

    <!-- Icon Divider-->
    <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
        <div class="divider-custom-line"></div>
    </div>
    <!-- Masthead Subheading-->


</div>
</header>