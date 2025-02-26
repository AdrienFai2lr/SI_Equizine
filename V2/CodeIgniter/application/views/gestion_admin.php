<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->   
       <h1>PAGE DE GESTION DES COMPTES</h1>

       <br><div><h3>Vous avez accès à tout les comptes & profils du site.</h3></div>
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
                    
                    
                </tr>
            </thead>
            <tbody>

                <?php if($this->session->userdata('pseudo')!=NULL){
                
     if($compte!=NULL){


                foreach ($compte as $cpt) {                    
                
                    echo "<tr>";
                    echo "<td>";echo $cpt['nom_pro'];echo "</td>";
                    echo "<td>";echo $cpt['prenom_pro'];echo "</td>";
                    echo "<td>";echo $cpt['role_pro'];echo "</td>";
                    echo "<td>";echo $cpt['validite_pro'];echo "</td>";
                    echo "<td>";echo $cpt['pseudo_com'];echo "</td>";
                    

                    echo "</tr>";}}}

?>
                    
    </tbody>
    </table>












    <!-- Icon Divider-->
    <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
        <div class="divider-custom-line"></div>
    </div>
    <!-- Masthead Subheading-->


</div>
</header>