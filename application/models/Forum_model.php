<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }

  public function get_Categorie()
  { 
    $query = $this->db->get('categories');
    return $query->result_array();
  }
  public function get_Article()
  {
    $query = $this->db->get('articles_all_info');
    return $query->result_array();
  }
  public function get_comments()
  {
    $query = $this->db->get('resultat_comments');
    return $query->result_array();
  }
  public function insert_article()
  {
    $data = [
      'title' => $this->input->post('title'),
      'categoryid' => $this->input->post('categoryid'),
      'content' => $this->input->post('content'),
      'usersid' => $_SESSION['userid']
    ];
    $this->db->insert('articles', $data);
    redirect('forum/forum');
  }

  public function delete_article($id)
  {
    $this->db->where('idarticle', $id);
    $this->db->delete('articles');
  }
  public function delete_commentaires($id)
  {
    $this->db->where('idcomments', $id);
    $this->db->delete('comments');
  }

  public function update_article()
  {
    $idarticle = $this->input->post('idarticle');
    $data = [
      'title' => $this->input->post('title'),
      'categoryid' => $this->input->post('categoryid'),
      'content' => $this->input->post('content'),
      'usersid' => $_SESSION['userid']
    ];
    $this->db->where('idarticle', $idarticle);
    $this->db->update('articles', $data);
  }
  public function insert_comment()
  {
    $data = [
      'content' => $this->input->post('content'),
      'userid' => $this->input->post('userid'),
      'categorieid' => $this->input->post('categorieid'),
      'articleid' => $this->input->post('articleid'),
    ];
    $this->db->where('articleid', $article);
    $this->db->insert('comments', $data);
    redirect('forum');
  }
} 