<?php

/*=============================================================
// Nom du fichier : Match.php
// Auteur : Adrien FAILLER   
// Date de création : Novembre 2022
// Version : V2
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// Page du match avec plusieurs fonctions.
// Une fonction qui va afficher le match.
// Une autre qui va verifier les données d'entrée vers un match.
// Fonctionnalite pour jouer un match
// ------------------------------------------------------------
// A noter :
// Nothing.
//=============================================================*/


defined('BASEPATH') OR exit('No direct script access allowed');


class Match extends CI_Controller {

 public function __construct()
 {
   parent::__construct();
   $this->load->model('db_model');
   $this->load->helper('url_helper');
   $this->load->helper('form');
   $this->load->library('session');
 }

//affiche le match via le code de match recuperer + recuperation de toute les données en lien au match et son code -> quiz-> question -> reponse
 public function match_afficher($code)
 {
   $data['cd_m'] =$code;   
   $data['info_mat'] = $this->db_model->get_match_quiz_wthcode($code);
   $data['inti_matqui']=$this->db_model->get_intutile_mat_quiz($code);
   
   

   

   $this->load->view('templates/haut');
   $this->load->view('match_afficher',$data);
   $this->load->view('templates/bas');
 }

//function verif qui permet de faire les verifications du code + pseudo avec la base de donnée 
//et l'ajout d'un nouveau joueur pour un match + redirection sur le match via le code
 public function verif(){
  $this->load->library('session');
  $this->load->helper('form');
  $this->load->library('form_validation');
  $this->form_validation->set_rules('code', 'code', 'required|max_length[8]|exact_length[8]|alpha_numeric');
  $this->form_validation->set_rules('pseudo', 'pseudo', 'required|max_length[20]');


  if ($this->form_validation->run() == FALSE){// Le formulaire est invalide
    redirect(base_url('index.php/accueil/afficher'));
    echo "Error > impossible de se connecter à un match / formulaire invalide";
  }
  else{// Le formulaire est valide 
    $this->load->helper('url');
    $data['code']=$this->input->post('code');
    $data['pseudo']=$this->input->post('pseudo');



    //verification des syntaxes pour le code et le pseudo
    if(strlen($data['code'])==8 && strlen($data['pseudo'])<=20 && strlen($data['pseudo'])>0){
    
      
      //requete execute via le db_model et la function info_mat
      $data['info_mat']=$this->db_model->info_mat($data['code']);  
      //----------------------------------------------------------------------//
      
      $tmp=0;   

      //donnée trouver via le code de match
      if($data['info_mat']!=null){

        //boucle foreach qui parcous le tableau des données sur le match via le code
        foreach ($data['info_mat'] as $j) {

          //verification des pseudos du match avec celui rentrer
          if($j['pseudo_jou']==$data['pseudo']){
            $tmp=1;
            
          }
          //----------------------------------------------------------------------//

        }

      //----------------------------------------------------------------------//

      //récupération de l'id du match et son etat
        $li_mat=$this->db_model->info_id($data['code']);

      //----------------------------------------------------------------------//

      //verification que aucun joueur du match à le meme pseudo et match active
        if($tmp==0 && $li_mat->etat_mat!='D'){

        //ajout du nouveau joueur lié au match via la function add_jou
          $this->db_model->add_jou($li_mat->id_mat,$data['pseudo']);

        //----------------------------------------------------------------------//
          
        //redirect sur la match avec le pseudo dans l'url
          $session_data = array('pseudo' => $data['pseudo']);
                $this->session->set_userdata($session_data); 
          redirect(base_url('index.php/match/match_afficher/' .$data['code']. ''));
        //----------------------------------------------------------------------//


        }

      //----------------------------------------------------------------------//

      //message d'erreur + redirection automatique si mal fait
        else{
          echo "match desactive / pseudo deja utilisé";
          redirect(base_url('index.php/accueil/afficher'));
          echo "Error > impossible de se connecter à un match / formulaire invalide";
        }
      //----------------------------------------------------------------------//
      }

      //message d'erreur + redirection automatique si mal fait
      else{
        redirect(base_url('index.php/accueil/afficher'));
        echo "Error > impossible de se connecter à un match / Code de match ou pseudo incorrect !";
      }
      //----------------------------------------------------------------------//
    }

  //message d'erreur + redirection automatique si mal fait
    else {
      redirect(base_url('index.php/accueil/afficher'));
      echo "Error > impossible de se connecter à un match / Code de match incorrect !";
    }
  //----------------------------------------------------------------------//

  }
}


public function resultat($code){
    $data['cd_m'] =$code;   
    $data['info_mat'] = $this->db_model->get_match_quiz_wthcode($code);
    $id=$this->db_model->get_intutile_mat_quiz($code);
    $data['inti_matqui']=$this->db_model->get_intutile_mat_quiz($code);
    $this->load->helper('form');
    $this->load->library('form_validation');
    
    $nb_que=0;
    $point=0;
    $var_que=0;

    if($this->input->post('libelle')){
      $checked=$this->input->post('libelle');

        $num=$this->db_model->get_num_quest($code);
        echo $nb_que=$num->id_que;
     
      foreach($checked as $row){
        
        $res=$this->db_model->validation_rep($nb_que,$row);
        echo $res->id_que;
        echo $res->resultat;
        if($res->resultat=='gagner'){
          $point+=1;
          
        }else{          
          $point+=0;
        }
        $var_que+=1;
      $nb_que+=1;
      }
      
      $point=(double)($point/$var_que);
      $point=$point*100;
      
      $data['resultat']=$point;

      $this->db_model->modif_score($this->session->userdata('pseudo'),$point,$id->id_mat);
      
      if($this->session->userdata('pseudo')!=null){
        $this->session->sess_destroy();   
      }
      $this->load->view('templates/haut');
      $this->load->view('afficher_resultat',$data);
      $this->load->view('templates/bas');  



    }else{
      echo "Répondez au question pour connaitre votre score";
      $this->load->view('templates/haut');
      $this->load->view('match_afficher/'.$code,$data);
      $this->load->view('templates/bas');    
    }


  }


public function corriger($code){
   

   $data['cd_m'] =$code;   
   $data['info_mat'] = $this->db_model->get_match_quiz_wthcode($code);
   $data['inti_matqui']=$this->db_model->get_intutile_mat_quiz($code);

   $this->load->view('templates/haut');
   $this->load->view('afficher_corriger',$data);
   $this->load->view('templates/bas');

}
  

}

?>
