<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Compte extends CI_Controller {


   public function __construct()
   {
       parent::__construct();
       $this->load->model('db_model');
       $this->load->helper('url_helper');

   }

   public function lister()
   {
       $data['titre'] = 'Liste des pseudos :';
       $data['pseudos'] = $this->db_model->get_all_compte();

       $this->load->view('templates/haut');
       $this->load->view('compte_liste',$data);
       $this->load->view('templates/bas');
   }



   public function connexion()
   {

    $this->load->helper('form');
    $this->load->view('templates/haut');
    $this->load->view('compte_connexion');
    $this->load->view('templates/bas');

}


public function compte_connecter(){

    $this->load->library('session');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('pseudo', 'pseudo', 'required');
    $this->form_validation->set_rules('mdp', 'mdp', 'required','password');



    if ($this->form_validation->run() == FALSE){// Le formulaire est invalide
        
        redirect(base_url('index.php/compte/connexion'));
        echo "Error > impossible de se connecter à un match / formulaire invalide";
    }
    else{
        $this->load->helper('url');

        $data['pseudo']=$this->input->post('pseudo');
        $data['mdp']=$this->input->post('mdp');
      

        $verif=$this->db_model->get_info_compte($data['pseudo'],$data['mdp']);

        if($verif==NULL){
            redirect(base_url('index.php/compte/connexion'));
            echo "error authentification";

        }
        else{
            if($verif->validite_pro=='A' && $verif->role_pro=='F'){

                $session_data = array('pseudo' => $data['pseudo']);
                $this->session->set_userdata($session_data); 
                $data['verif']=$this->db_model->get_info_compte($data['pseudo'],$data['mdp']);
                $data['m_q_q']=$this->db_model->get_all_info_match($data['pseudo']);
                $data['info']=$this->db_model->get_info_onecompte($data['pseudo']);

                $this->load->view('templates/haut_connecter',$data);
                $this->load->view('page_formateur',$data);
                $this->load->view('templates/bas');



            }
            elseif($verif->validite_pro=='A' && $verif->role_pro=='A'){
                $session_data = array('pseudo' => $data['pseudo']);
                $this->session->set_userdata($session_data); 
                $data['verif']=$this->db_model->get_info_compte($data['pseudo'],$data['mdp']);
                $data['all']=$this->db_model->get_all_info_compte();
                $data['info']=$this->db_model->get_info_onecompte($data['pseudo']);

                $this->load->view('templates/haut_connecter',$data);
                $this->load->view('page_admin',$data);
                $this->load->view('templates/bas');
            }
            else{
                redirect(base_url('index.php/compte/connexion'));
                echo "compte desactive";
            }

        }
    }

}

public function deco(){

    if($this->session->userdata('pseudo')!=null){
     $this->session->sess_destroy();
     redirect(base_url('index.php/accueil/afficher'));
    }
}


public function modif_mdp(){


if($this->session->userdata('pseudo')!=null){

    $this->load->library('session');
    $this->load->helper('form');
    $this->load->library('form_validation');
    
    $this->load->library('session');
    $data['pseudo']=$this->session->userdata('pseudo');
    $data['info']=$this->db_model->get_info_onecompte($data['pseudo']);
    $data['mdp1']=$this->input->post('mdp1');
    $data['mdp2']=$this->input->post('mdp2');
    $this->load->view('templates/haut_connecter',$data);
    $this->load->view('modif_mdp');
    $this->load->view('templates/bas');}

else{

    redirect(base_url('index.php/compte/connexion'));

}}


public function verif_mdp(){   

    echo $this->session->userdata('pseudo');

    $this->load->library('session');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('mdp1', 'mdp1', 'required','password');
    $this->form_validation->set_rules('mdp2', 'mdp2', 'required','password');
    $data['var']=0;
    echo $this->input->post('mdp1');
    echo $this->input->post('mdp2');
    $data['pseudo']=$this->session->userdata('pseudo');
    $data['info']=$this->db_model->get_info_onecompte($data['pseudo']);

    if($this->input->post('mdp1')==$this->input->post('mdp2')){
        $this->db_model->modificationmdp($this->input->post('mdp2'),$this->session->userdata('pseudo'));
        $data['var']=1;
        $this->load->view('templates/haut_connecter',$data);
        echo "changement de mot de passe validé !";
        $this->load->view('modif_mdp',$data);
        $this->load->view('templates/bas');
        
        

    }else{
        $this->load->view('templates/haut_connecter',$data);
        echo "erreur sur le changement de mot de passe veuillez rééssayer";
        $this->load->view('modif_mdp',$data);
        $this->load->view('templates/bas');
        
    }


}
public function profil(){

    $this->load->library('session');
    $data['pseudo']=$this->session->userdata('pseudo');
    
    $data['info']=$this->db_model->get_info_onecompte($data['pseudo']);
    if($this->session->userdata('pseudo')!=null){
    if($data['info']->role_pro=='F'){
        $this->load->view('templates/haut_connecter',$data);
        $this->load->view('profil_formateur',$data);
        $this->load->view('templates/bas');
    }
    elseif($data['info']->role_pro=='A'){
        $this->load->view('templates/haut_connecter',$data);
        $this->load->view('profil_admin',$data);
        $this->load->view('templates/bas');
    }}else{
redirect(base_url('index.php/compte/connexion'));}
}

public function gestion_des_comptes(){
    $this->load->library('session');
    $data['pseudo']=$this->session->userdata('pseudo');
    $data['info']=$this->db_model->get_info_onecompte($data['pseudo']);
    $profil=$this->db_model->get_info_onecompte($data['pseudo']);

    $data['compte']=$this->db_model->get_all_profil();

    if($this->session->userdata('pseudo')!=null){
        if($profil->role_pro=='A'){
    $this->load->view('templates/haut_connecter',$data);
    $this->load->view('gestion_admin',$data);
    $this->load->view('templates/bas');}
        else{
            redirect(base_url('index.php/compte/connexion'));
        }
    }

    else{
        redirect(base_url('index.php/compte/connexion'));
    }


}
public function gestion_des_matchs(){


    $this->load->library('session');
    $data['pseudo']=$this->session->userdata('pseudo');



    $data['info']=$this->db_model->get_info_onecompte($data['pseudo']);

    $profil=$this->db_model->get_info_onecompte($data['pseudo']);
    
    
    $res=$this->db_model->quiz_match();
    $data['allqui']=$this->db_model->quiz_match();
    if($this->session->userdata('pseudo')!=null){
        if($profil->role_pro=='F'){
            echo $this->session->userdata('pseudo');
            $this->load->view('templates/haut_connecter',$data);
            $this->load->view('gestion_match',$data);
            $this->load->view('templates/bas');}
            else{
                redirect(base_url('index.php/compte/connexion'));
            }
}
    else{
        redirect(base_url('index.php/compte/connexion'));
    }


}





public function questionnaire($code){
    $this->load->library('session');
    $data['cd_m'] =" numero de match : $code";  
    $data['pseudo']=$this->session->userdata('pseudo');
    $data['info']=$this->db_model->get_info_onecompte($data['pseudo']);
    $data['all']=$this->db_model->get_match_quiz_wthcode($code);
    $data['inti_matqui']=$this->db_model->get_intutile_mat_quiz($code);
    $data['all_limit']=$this->db_model->get_match_quiz_wthcodelimit($code);

    

    if($data['all']!=NULL){
    $data['moyenne']=$this->db_model->moyenne($code);
    echo $this->session->userdata('pseudo');
    $this->load->view('templates/haut_connecter',$data);
    $this->load->view('gestion_questionnaire',$data);
    $this->load->view('templates/bas');
}
else{

    redirect(base_url('index.php/compte/gestion_des_matchs/'));
}

}

public function delete($code){

    if($this->session->userdata('pseudo')!=null){
        $this->db_model->suppri_jou($code);
        $this->db_model->suppri_mat($code);
        redirect('compte/gestion_des_matchs');
     
    }else {

        redirect(base_url('index.php/accueil/afficher'));
    }

}

public function act_desac($code){

    if($this->session->userdata('pseudo')!=null){
        $etat=$this->db_model->etatmatchcode($code);

        if ($etat->etat_mat=='A') {
            $this->db_model->suppri_desac($code);
        }else{
            $this->db_model->suppri_act($code);            
        }
        redirect('compte/gestion_des_matchs');
     
    }else {

        redirect(base_url('index.php/accueil/afficher'));
    }


}
public function raz($id){


 if($this->session->userdata('pseudo')!=null){
       $this->db_model->razz($id);
       redirect('compte/gestion_des_matchs');
     
    }else {

        redirect(base_url('index.php/accueil/afficher'));
    }


}
public function ajouter_match(){


 if($this->session->userdata('pseudo')!=null){
        $data['pseudo']=$this->session->userdata('pseudo');
        $data['info']=$this->db_model->get_info_onecompte($data['pseudo']);
        $data['allqui']=$this->db_model->get_intutile_quiz();
        $this->load->view('templates/haut_connecter',$data);
        $this->load->view('formulaire_creer',$data);
        $this->load->view('templates/bas');
     
    }else {

        redirect(base_url('index.php/accueil/afficher'));
    }


}


public function creer(){


 if($this->session->userdata('pseudo')!=null){
    
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('quiz', 'quiz', 'required');
    $this->form_validation->set_rules('intitulematch', 'intitulematch', 'required');
    $id_pseu=$this->db_model->get_info_onecompte($this->session->userdata('pseudo'));
    echo $id_pseu->id_com;
    echo $this->input->post('quiz');
    echo $this->input->post('intitulematch');
    $id_qui=$this->db_model->get_id_quiz_with_int($this->input->post('quiz'));

    $this->db_model->creation($id_qui->id_qui,$this->input->post('intitulematch'),$id_pseu->id_com);
    redirect('compte/gestion_des_matchs');

    }else {

        redirect(base_url('index.php/accueil/afficher'));
    }


}

}
?>
