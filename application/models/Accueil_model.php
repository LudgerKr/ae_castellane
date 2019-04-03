<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil_model extends CI_Model
{
  public function getArticle()
  {
    $query = $this->db->get_where('article', ['email' => $email, 'question_id' => $question, 'reponse' => $reponse, 'student_id'=>$student_id]);
    return $query->row_array();
  }
  public function get_news()
  {
    $query = $this->db->get('news');
    return $query->result_array();
  }
  

}
 