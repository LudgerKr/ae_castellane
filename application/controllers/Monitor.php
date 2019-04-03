<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitor extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('form'); // form_open()
    $this->load->library('form_validation'); // validation_errors()
    $this->load->model('monitor_model');
  }

  public function signin()
  {
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Mot de passe', 'required');

    if ($this->form_validation->run() === FALSE) // si formulaire non rempli OU rempli mais incomplet
    {
      $data['title'] = 'Connexion Moniteur';
      $this->load->view('layouts/header');
      $this->load->view('monitor/signin', $data);
      $this->load->view('layouts/footer');
    }
    else 
    {
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $monitor_id = $this->monitor_model->check_password($email, $password);
      if ($monitor_id) {
    
        $ban = $this->monitor_model->check_ban($email);
        if($ban != TRUE)
        {
          $data['title'] = 'Banni';
          $this->load->view('layouts/header');
          $this->load->view('user/ban', $data);
          $this->load->view('layouts/footer');
        }
        else
        if($monitor_id != FALSE)
        {
          $_SESSION['connect_monitor'] = TRUE;
          $_SESSION['connect_monitor'] = $monitor_id;
          redirect('monitor/accueil');
        } 
        else
        {
        $data['title'] = 'Connexion monitor';
        $data['error_msg'] = 'Identifiant ou mot de passe incorrect';      
        $this->load->view('layouts/header');
        $this->load->view('monitor/signin', $data);
        $this->load->view('layouts/footer');
        }
      }
    }
  }

  public function accueil()
  {
    
    $data['title'] = 'Accueil Moniteur';      
    $this->load->view('layouts/header');
    $this->load->view('monitor/accueil', $data);
    $this->load->view('layouts/footer');
  }

  public function seance()
  {
    
    $data['title'] = 'Accueil Moniteur';      
    $this->load->view('layouts/header');
    $this->load->view('monitor/seance', $data);
    $this->load->view('layouts/footer');
  }
}