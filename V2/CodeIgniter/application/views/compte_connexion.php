

<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
        <?php echo validation_errors(); ?>
        <?php echo form_open('compte/compte_connecter'); ?>
        <label for="pseudo">Identifiant</label>
        <input type="input" name="pseudo" id="pseudo" /><br />
        <label for="mdp">Mot de passe</label>
        <input type="password" name="mdp" id="mdp"/><br />

        <input type="submit" name="submit" value="Connexion" />
    </form>

    <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
        <div class="divider-custom-line"></div>
    </div>



    <!-- Masthead Heading-->
    <h1 class="masthead-heading text-uppercase mb-0">PAGE DE CONNECTION</h1>
    <!-- Icon Divider-->
    <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
        <div class="divider-custom-line"></div>
    </div>
    <!-- Masthead Subheading-->


</div>
</header>

