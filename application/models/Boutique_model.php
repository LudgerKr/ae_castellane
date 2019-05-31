<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Boutique_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }
  public function get_boutiques()
  {
    $query = $this->db->get('shops');
    return $query->result_array();
  }
  public function get_paymentResult()
  {
    $query = $this->db->get('result_payments');
    return $query->result_array();
  }
}