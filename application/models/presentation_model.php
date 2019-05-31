<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presentation_model extends CI_Model{
    
    function __construct() {
        $this->load->database();  
    }



  //add article
  public function insert_article()
  {
    $data = [
      "titre" => $this->input->post('titre'),
      "contenu" =>  $this->input->post('contenu'),
	  "userPost" => $this->input->post('userid')
    ];
    $this->db->insert('presentation', $data);
  }
}