

<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
       

        <?php 
        if($this->session->userdata('pseudo')!=NULL){  ?> 


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
                    
                </tr>
            </thead>
            <tbody>
                
<?php  if($info!=NULL){
                    echo "<tr>";

                    echo "<td>";echo $info->nom_pro;echo "</td>";
                    echo "<td>";echo $info->prenom_pro;echo "</td>";
                    echo "<td>";echo $info->role_pro;echo "</td>";
                    echo "<td>";echo $info->validite_pro;echo "</td>";
                    echo "<td>";echo $info->pseudo_com;echo "</td>";
                    

                    echo "</tr>";}}

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