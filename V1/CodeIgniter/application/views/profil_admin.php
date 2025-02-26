
    

<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
       
        <h1> Votre profil </h1>

    <br>     
    <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
        <div class="divider-custom-line"></div>
    </div>



    <!-- Masthead Heading-->

                


          <?php 
        if($this->session->userdata('pseudo')!=NULL){  


            ?>     <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    
                    <th>Pseudo</th>
                
                </tr>
            </thead>
            <tbody>
                
<?php  if($info!=NULL){
                    echo "<tr>";

                    echo "<td>";echo $info->nom_pro;echo "</td>";
                    echo "<td>";echo $info->prenom_pro;echo "</td>";
                    
                    echo "<td>";echo $info->pseudo_com;echo "</td>";
                   

                    echo "</tr>";}
}
?>

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