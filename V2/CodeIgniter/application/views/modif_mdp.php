

<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
        <?php echo validation_errors(); ?>
        <?php echo form_open('compte/verif_mdp'); ?>


        <label for="mdp1">Votre nouveau mot de passe</label>
        <input type="password" name="mdp1" id="mdp1" required/><br />
        <label for="mdp">Confirmez votre nouveau mot de passe</label>
        <input type="password" name="mdp2" id="mdp2" required/><br />

        <input type="submit" name="submit" value="Validez"  />

    </form>
     
    <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
        <div class="divider-custom-line"></div>
    </div>
    
    <?php 

        if(isset($var)){
            if($var==1){
                echo "changement de mot de passe valide";
            }
            elseif($var==0){
                echo "erreur changement de mot de passe";
            }
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


</div>
</header>

