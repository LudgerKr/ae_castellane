<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Boutique extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('form'); // form_open()
    $this->load->library('form_validation'); // validation_errors()
    $this->load->model('boutique_model');
  }

  public function boutique()
  {
    $boutiques = $this->boutique_model->get_boutiques();
	$payment = $this->boutique_model->get_paymentResult();
	  
    $data['payment'] = $payment;  
    $data['boutiques'] = $boutiques;
    $data['title'] = 'Boutique';
    $this->load->view('layouts/header');
    $this->load->view('pages/boutique', $data);
    $this->load->view('layouts/footer');
  }
}