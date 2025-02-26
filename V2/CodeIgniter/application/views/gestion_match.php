
<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->   
        <h1>PAGE DE GESTION DE VOS MATCHS</h1>

        <br><div><h3>Vous avez accès à tout vos matchs + questionnaires et leur score !</h3></div>

        <br>
        <h3>Pour l'ajout d'un match</h3><br>
        
            <a class='btn btn-outline-success' href="<?php echo base_url('index.php/compte/ajouter_match');?>"> Créer un nouveau match</a>



        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Heading-->   
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>intitule du quiz</th>
                    <th>Auteur du quiz</th>
                    <th>Auteur du match</th>
                    <th>Code du match</th>
                    <th>Intitule du match</th>
                    <th>Etat du match</th>
                    <th>Date de debut du match</th>
                    <th>Date de fin du match   </th>                    
                    <th> RAZ du match </th>
                    <th> Supprimer votre match </th>
                    <th> activer/desactiver votre match </th>
                    
                    
                    
                    
                </tr>
            </thead>
            <tbody>

                <?php if($this->session->userdata('pseudo')!=NULL){

                   if($allqui!=NULL){
                    
                          
                    foreach ($allqui as $mtc ) {        

                       

                        echo "<td>";echo $mtc['intitule_qui'];echo "</td>";

                        echo "<td>";echo $mtc['auteur_quiz'];echo "</td>";
                        if($mtc['intitule_mat']!=null){
                        echo "<td>";echo $mtc['auteur_match'];echo "</td>";}

                        if($mtc['auteur_match']==$info->pseudo_com){
                        echo "<td>";echo "<a href='https://obiwan.univ-brest.fr/difal3/zfaillead/V2/CodeIgniter/index.php/compte/questionnaire/".$mtc['code_mat']."'/a>";echo $mtc['code_mat'];echo "</td>";}
                        else{
                            echo "<td>"; $mtc['code_mat'];  "</td>";
                        }

                        echo "<td>";echo $mtc['intitule_mat'];echo "</td>";
                        echo "<td>";echo $mtc['etat_mat'];echo "</td>";
                        echo "<td>";echo $mtc['datedebut_mat'];echo "</td>";
                        echo "<td>";echo $mtc['datefin_mat'];echo "</td>";
                        
                        if($mtc['auteur_match']==$info->pseudo_com && $mtc['code_mat']!=null){
                            $url=$mtc['code_mat'];
                            $id=$mtc['id_mat'];
                        
                        

                        echo "<td>"; echo "<a class='btn btn-info' href="; echo base_url('index.php/compte/raz/'.$id); echo ">raz</a>"; echo "</td>";

                        echo "<td>"; echo "<a class='btn btn-danger' href="; echo base_url('index.php/compte/delete/'.$url); echo ">delete</a>"; echo "</td>";

                         echo "<td>"; echo "<a class='btn btn-warning' href="; echo base_url('index.php/compte/act_desac/'.$url); echo ">activer/desactiver</a>"; echo "</td>";


                        

                       }
                         echo "</tr>";}
                         
                          
                         


                     }}

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