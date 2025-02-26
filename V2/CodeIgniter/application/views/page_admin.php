
<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->   
        <br>
        <br>
    <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
        <div class="divider-custom-line"></div>
    </div>
    <!-- Masthead Heading-->   
   <?php 
        if($this->session->userdata('pseudo')!=NULL){
            echo "<h4> Votre role : Admin </h4>";
            echo "<br>";
             echo "<h3>Bienvenue Monsieur/Madame $verif->nom_pro</h3>";      } 
         else{
                redirect(base_url('index.php/compte/connexion'));
                echo "probleme de connexion";
            }
?> <!-- Icon Divider-->
    <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
        <div class="divider-custom-line"></div>
    </div>
    <!-- Masthead Subheading-->


</div>
</header>