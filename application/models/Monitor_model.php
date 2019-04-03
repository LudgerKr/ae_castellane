<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitor_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }

  public function check_password($email, $password)
  {
    $monitor_id = $this->get_monitors($email);
    if (empty($monitor_id))
    {
      return FALSE;
    }
    if (!password_verify($password, $monitor_id['password']))
    {
      return FALSE;
    }
    return TRUE;
  }
 
  public function get_ban($email)
  {
    $ban = $this->db->get_where('users', ['ban' == '1', 'email'=>$email]);
    return $ban->row_array();
  }
  public function get_monitors($email)
  {
    $query = $this->db->get_where('users', ['email' => $email, 'right'=>'Moniteur']);
    return $query->row_array();
  }

  public function check_ban($email)
  {
    $monitor_id = $this->get_ban($email);
    if($monitor_id['ban'] == '0')
    {
      return TRUE;
    }
  }
}