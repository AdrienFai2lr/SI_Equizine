
    

<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
       
        <h1> Création du votre match  </h1>

    <br>     
    <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
        <div class="divider-custom-line"></div>
    </div>



    <!-- Masthead Heading-->


<form method="post" action="<?php echo base_url('index.php/compte/creer')?>">
<label for="quiz">Choisissez le quiz pour votre match</label>  <br>           
<select name="quiz" id="quiz" required> 
   
        <?php 
        foreach ($allqui as $int_qui) {
            if($int_qui['id_que']!=null){
            echo "<option>";
            echo $int_qui['intitule_qui'];
            echo "</option>";}
            else{
                echo "<option disabled>";
            echo $int_qui['intitule_qui'];
            echo "</option>";
            }
        }

        ?>
        
    </select><br>
<label for="intitulematch">Choisissez un titre pour votre match</label>
<input type="text" id="intitulematch "name="intitulematch"><br>
<input type="submit" value="Créer">
</form>


          
    
                    
            
            
            
    

    <!-- Icon Divider-->
    <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
        <div class="divider-custom-line"></div>
    </div>
    <!-- Masthead Subheading-->


</div>
</header>