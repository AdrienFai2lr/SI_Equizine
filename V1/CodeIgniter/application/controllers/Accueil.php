<?php

/*=============================================================
// Nom du fichier : Acceuil.php
// Auteur : Adrien FAILLER   
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// Page d'acceuil du site internet avec une fonction afficher
// qui permet de recupérer toute les données nécessaire 
// pour l'affichage des actualités et des zones de saisies
// pour l'accès à un match.
// ------------------------------------------------------------
// A noter :
// Nothing.
//=============================================================*/


defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil extends CI_Controller
{   
    public function __construct(){

       parent::__construct();
       $this->load->library('form_validation');
       $this->load->model('db_model');
       $this->load->helper('url_helper');
    }
    //fonction de l'acceuil + toutes les actu du site 
    public function afficher(){   

    $data['titre'] = 'Actualités :';
    $data['actu'] = $this->db_model->get_all_actualite();

    $this->load->view('templates/haut');
    $this->load->view('actualite_afficher',$data);
    $this->load->view('templates/bas');
    }
}


?>