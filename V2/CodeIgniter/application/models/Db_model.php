<?php

/*=============================================================
// Nom du fichier : Db_model.php
// Auteur : Adrien FAILLER   
// Date de création : Novembre 2022
// Version : V2
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// Page model, qui permet de réaliser toute fonction liée avec la 
// base de données via des requêtes.
// ------------------------------------------------------------
// A noter :
// Nothing.
//=============================================================*/

class Db_model extends CI_Model {
    
    public function __construct()
    {
       $this->load->database();
    }
    //function qui recupere tout les pseudo des comptes 
    public function get_all_compte()
    {
    $query = $this->db->query("SELECT pseudo_com FROM t_COMPTE_com;");
    return $query->result_array();
    }    


    //function qui va recupérer toutes les actualités et leur créateur(pseudo)
    public function get_all_actualite(){

    $query=$this->db->query("SELECT pseudo_com,titre_act,date_act,description_act from t_ACTUALITE_act
        left outer join t_COMPTE_com USING(id_com);");
    return $query->result_array();
    }
    public function get_id_quiz_with_int($intitule){
        $query=$this->db->query("SELECT id_qui from t_QUIZ_qui where intitule_qui='".$intitule."'");
        return $query->row();

    }
    public function get_intutile_quiz(){
        $query=$this->db->query("SELECT DISTINCT *  from t_QUIZ_qui
        left OUTER JOIN t_QUESTION_que USING(id_qui)
        LEFT OUTER join t_REPONSE_rep USING (id_que)
        group by intitule_qui;");
        return $query->result_array();

    }

    public function modif_score($pseudo,$score,$id){
        $query=$this->db->query("update t_JOUEUR_jou
        set score_jou='".$score."' where pseudo_jou='".$pseudo."' && id_mat='".$id."';");
                return $query;

    }

    //function qui va récuperer les informations d'un match,des quiz,des questions avec leurs reponses via un code de match
    public function get_match_quiz_wthcode($code){

        $query=$this->db->query("SELECT id_que,txtq_que,id_rep,libelle_rep,intitule_mat,intitule_qui,datefin_mat,validite_rep from t_QUESTION_que
        left OUTER join t_REPONSE_rep USING(id_que)
        left OUTER join t_QUIZ_qui USING (id_qui)
        LEFT OUTER JOIN t_MATCH_mat USING (id_qui)
        where code_mat='".$code."';");
        return $query->result_array();
    }
      public function get_match_quiz_wthcodelimit($code){

        $query=$this->db->query("SELECT id_que,txtq_que,id_rep,libelle_rep,intitule_mat,intitule_qui,datefin_mat from t_QUESTION_que
        left OUTER join t_REPONSE_rep USING(id_que)
        left OUTER join t_QUIZ_qui USING (id_qui)
        LEFT OUTER JOIN t_MATCH_mat USING (id_qui)
        where code_mat='".$code."' limit 1;");
        return $query->row();
    }

    //function qui va recupérer toute les données d'un match + leurs joueurs via le code de match
    public function info_mat($code_mat){

    $query=$this->db->query("SELECT * from t_MATCH_mat left OUTER join t_JOUEUR_jou using (id_mat) where code_mat='".$code_mat."';");
    return $query->result_array();
    }

    //function qui va recupérer en une ligne l'id et l'etat du match via un code
    public function info_id($code_mat){

        $query=$this->db->query("SELECT id_mat,etat_mat from t_MATCH_mat where code_mat='".$code_mat."' limit 1;");
        return $query->row();

    }

    //function qui va ajouter un nouveau joueur pour un match via son id et son pseudo donnée en paramètre
    public function add_jou($id,$pseudo){

        $query=$this->db->query("INSERT into t_JOUEUR_jou values (null,'".$pseudo."',null,".$id.");");
            return $query;
    }

    //function qui va récuperer les informations d'un match,des quiz,des questions avec leurs reponses via un code de match sur une seule ligne
    public function get_intutile_mat_quiz($code){

        $query=$this->db->query("SELECT id_que,txtq_que,id_rep,libelle_rep,intitule_mat,intitule_qui,id_qui,etat_corriger_qui,id_mat from t_QUESTION_que
        left OUTER join t_REPONSE_rep USING(id_que)
        left OUTER join t_QUIZ_qui USING (id_qui)
        LEFT OUTER JOIN t_MATCH_mat USING (id_qui)
        where code_mat='".$code."'
        limit 1;");
        return $query->row();
    }

    //function qui va récuperer les informations d'un compte via pseudo + mdp 
    public function get_info_compte(){
   
        $this->load->helper('url');
        $pseudo=$this->input->post('pseudo');
        $mdp=$this->input->post('mdp');
        //on ajoute du sel
        $salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
        $password=hash('sha256', $salt.$mdp);

        $query=$this->db->query("SELECT * from t_COMPTE_com 
        left outer JOIN t_PROFIL_pro USING(id_com)
        where pseudo_com='".$pseudo."' and mdp_com='".$password."';");
        return $query->row();
    }

    // Fonction qui recupère toutes les informations des match/quiz/rep via pseudo
    public function get_all_forcompte(){

    
        $this->load->helper('url');
        $id=$this->input->post('id');
        $mdp=$this->input->post('mdp');
        $req=";";
        $query = $this->db->query($req);
        return ($query);
    }

       public function get_all_info_compte(){
        $query=$this->db->query("SELECT distinct * from t_COMPTE_com
            left outer join t_PROFIL_pro USING(id_com)");
        return $query->result_array();

    }
    // Fonction qui recupère toutes les informations des match/quiz/rep/question via pseudo
    public function get_all_info_match($pseudo){

        $query=$this->db->query("SELECT intitule_mat,intitule_qui,txtq_que,libelle_rep,validite_rep from t_QUIZ_qui 
        LEFT OUTER join t_COMPTE_com USING(id_com) 
        LEFT OUTER join t_MATCH_mat USING(id_qui) 
        LEFT OUTER join t_QUESTION_que USING(id_qui) 
        LEFT OUTER join t_REPONSE_rep USING(id_que)
        where pseudo_com='".$pseudo."';");
        return $query->result_array();
    }




    //Fonction qui recupère vos match et vos 


    public function modificationmdp($mdp,$pseudo){
        //on ajoute du sel
        $salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
        $password=hash('sha256', $salt.$mdp);

        $query=$this->db->query("UPDATE t_COMPTE_com set mdp_com='".$password."' where pseudo_com='".$pseudo."'; ");
    }

    public function get_info_onecompte($pseudo){
        
        $query=$this->db->query("SELECT * from t_COMPTE_com
        left OUTER JOIN t_PROFIL_pro USING(id_com)
        where pseudo_com='".$pseudo."';");
            return $query->row();

    }


    public function get_all_profil(){

        $query=$this->db->query("SELECT * from t_COMPTE_com left OUTER JOIN t_PROFIL_pro USING (id_com);");

        return $query->result_array();


    }

    public function urematch($pseudo){

        $query=$this->db->query("SELECT *,avg(score_jou) as moyenne_du_match from t_MATCH_mat left outer join t_COMPTE_com USING (id_com)
        LEFT OUTER JOIN t_JOUEUR_jou USING (id_mat) where 
            pseudo_com='".$pseudo."' group by id_mat;");

        return $query->result_array();
    }

    public function urequestionnaire($id){

        $query=$this->db->query("SELECT * from t_MATCH_mat left outer join t_COMPTE_com USING (id_com) where 
        pseudo_com='".$pseudo."';");
    }

     public function urescoreformatch($id){

        $query=$this->db->query("SELECT * from t_MATCH_mat left outer join t_COMPTE_com USING (id_com) where 
        pseudo_com='".$pseudo."';");
    }
    public function getquestionnairefromcode($code){
        $query=$this->db->query("SELECT intitule_qui,txtq_que,libelle_rep,validite_rep from t_QUIZ_qui 
        left outer join t_MATCH_mat using (id_mat)
        left outer join t_QUESTION_que USING (id_qui) 
        left outer join t_REPONSE_rep using (id_que) 
        where code_mat='".$code."'; ");

        return $query->result_array();


    }
  


    public function quiz_match(){
        $query=$this->db->query("
        SELECT id_mat,code_mat,etat_mat,datefin_mat,datedebut_mat,pseudo(P.id_com) as auteur_quiz,intitule_qui,pseudo(S.id_com) as auteur_match,intitule_mat from t_QUIZ_qui P
        left outer join t_MATCH_mat S using (id_qui);");

        return $query->result_array();

    }
    public function moyenne($code){
        $query=$this->db->query("SELECT avg(score_jou) as moyenne_mat from t_JOUEUR_jou left outer join t_MATCH_mat using(id_mat) where code_mat='".$code."';");  
        return $query->row();
          }
  

    public function suppri_jou($code){
        $query=$this->db->query("                     
        delete from t_JOUEUR_jou
        where id_mat=get_id_mat('".$code."');");

        return $query;

        }
    public function suppri_mat($code){
        $query=$this->db->query("delete from t_MATCH_mat
        where code_mat='".$code."';");

        return $query;

        }
    public function etatmatchcode($code){

        $query=$this->db->query("SELECT etat_mat from t_MATCH_mat where code_mat='".$code."';");
        return $query->row();


    }
    public function suppri_act($code){
        $query=$this->db->query("update t_MATCH_mat
        set etat_mat='A'
        where code_mat='".$code."';");

        return $query;

        }
    public function suppri_desac($code){
        $query=$this->db->query("update t_MATCH_mat
        set etat_mat='D'
        where code_mat='".$code."';");

        return $query;

        }
    public function razz($id){
        $query=$this->db->query(" update t_MATCH_mat set datedebut_mat=ADDDATE(now(), 1),datefin_mat=null where id_mat='".$id."';");
        return $query;
    }
     public function creation($id_qui,$intitule_mat,$id_pseudo){
            
        $query=$this->db->query("insert into t_MATCH_mat values (null,code_rand(),'".$intitule_mat."','D',now(),null,$id_qui,$id_pseudo);");
        return $query;

        }


    public function get_num_quest($code){
        $query=$this->db->query("SELECT id_qui,id_que from t_QUIZ_qui
LEFT OUTer JOIN t_QUESTION_que USING(id_qui)
left outer join t_MATCH_mat USING(id_qui)
where code_mat='".$code."' limit 1;");
        return $query->row();
    }

    public function validation_rep($num,$intitule){
        $query=$this->db->query("SELECT if(validite_rep='V','gagner','perdu') as resultat,id_que from t_QUESTION_que
        left OUTER JOIN t_REPONSE_rep USing(id_que)
    left outer join t_QUIZ_qui using(id_qui)
    left outer join t_MATCH_mat using(id_qui)
        where id_que='".$num."' and libelle_rep='".$intitule."' limit 1;");


        return $query->row();
    }



}
?>