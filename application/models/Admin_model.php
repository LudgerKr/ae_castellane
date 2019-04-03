<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
  public function __construct() {
    $this->load->database();
  }

  ///////////// Requete SELECT ///////////// 
  public function get_admin()
  {
    $query = $this->db->get('users');
    return $query->result_array();
  } 
  public function get_seance()
  {
    $query = $this->db->get('seance');
    return $query->result_array();
  }
  public function get_questions()
  {
    $query = $this->db->get('questions');
    return $query->result_array();
  }
  public function get_forum_categories()
  {
    $query = $this->db->get('categories');
    return $query->result_array();
  }
  public function count_categories()
  {
    $query = $this->db->count_all('categories');
    return $query;
  }
  public function get_article()
  {
    $query = $this->db->get('articles');
    return $query->result_array();
  }
  public function get_article_info()
  {
    $query = $this->db->get('articles_all_info');
    return $query->result_array();
  }
  public function regroup_user()
  {
    $query = $this->db->get('seance_count');
    return $query->result_array();
  }
  public function get_news()
  {
    $query = $this->db->get('resultat_annonce');
    return $query->result_array();
  }
  public function get_quizzQuestions()
  {
    $query = $this->db->get('quizzQuestions');
    return $query->result_array();
  }
  public function get_quizzAnswers()
  {
    $query = $this->db->get('quizzAnswers');
    return $query->result_array();
  }
  public function get_quizz()
  {
    $query = $this->db->get('resultat_quizz');
    return $query->result_array();
  }
  public function get_certificats()
  {
    $query = $this->db->get('result_certificats');
    return $query->result_array();
  }
  public function get_user_by_email($email)
  {
    $query = $this->db->get_where('users', [strtolower('email') => $email]);
    return $query->row_array();
  }
  public function get_seance_by_datetime($id)
  {
    $query = $this->db->get_where('seance', ['idseance' => $id]);
    return $query->row_array();
  }
  public function get_ban($email)
  {
    $ban = $this->db->get_where('users', ['ban' == '1', strtolower('email')=>$email]);
    return $ban->row_array();
  }
  public function get_admins($email)
  {
    $query = $this->db->get_where('users', [strtolower('email') => $email, 'right'=>'Administrateur']);
    return $query->row_array();
  }

  public function check_ban($email)
  {
    $user = $this->get_ban($email);
    if($user['ban'] == '0')
    {
      return TRUE;
    }
  }
  ///////////// Requete INSERT ///////////// 
  public function insert_date()
  {
    $data = [
      'date' => $this->input->post('date'),
      'time' => $this->input->post('time')
    ];
    $this->db->insert('seance', $data);
    redirect('admin/accueil');
  }
  public function insert_newdate()
  {
    $data = [
      'date' => $this->input->post('i_date'),
      'time' => $this->input->post('i_time')
    ];
    $this->db->insert('seance', $data);
    redirect('admin/seance');
  }
  public function insert_news()
  {
    $data = [
      'title' => $this->input->post('title'),
      'content' => $this->input->post('content'),
      'userid' => $this->input->post('userid')
    ];
    $this->db->insert('news', $data);
    redirect('admin/news');
  }
  public function add_question()
  {
    $data = [
      "question" => $this->input->post('question')
    ];
    $this->db->insert('quizzQuestions', $data);
  }
  public function add_answers()
  {
    $data = [
      "IdQuestion" => $this->input->post('idquestion'),
      "reponse" => $this->input->post('reply'),
      "correct" => $this->input->post('correct')
    ];
    $this->db->insert('quizzAnswers', $data);
  }

  public function insert_categories()
  {
    $data = [
      'name' => $this->input->post('name'),
      'content' => $this->input->post('content')
    ];
    $this->db->insert('categories', $data);
    redirect('admin/forum');
  }

  ///////////// Password ///////////// 
  public function check_password($email, $password)
  {
    $user = $this->get_admins($email);
    if (empty($user))
    {
      return FALSE;
    }
    if (!password_verify($password, $user['password']))
    {
      return FALSE;
    }
    return TRUE;
  }
  ///////////// Requete DELETE ///////////// 
  public function delete_user($id)
  {
    $this->db->where('iduser', $id);
    $this->db->delete('users');
  }
  public function delete_seance($id)
  {
    $this->db->where('idseance', $id);
    $this->db->delete('seance');
  }
  public function delete_question_quizz($id)
  {
    $this->db->where('idQuestion', $id);
    $status = $this->db->delete('quizzAnswers');

    $this->db->where('idQuestion', $id);
    $this->db->delete('quizzQuestions');
  }
  public function delete_categories($id)
  {
    $this->db->where('idcategory', $id);
    $this->db->delete('categories');
  }
  public function delete_article($id)
  {
    $this->db->where('idarticle', $id);
    $this->db->delete('articles');
  }
  public function delete_news($id)
  {
    $this->db->where('idnew', $id);
    $this->db->delete('news');
  }

    ///////////// Requete UPDATE ///////////// 
  public function ban($id)
  {
    $data = [
      'ban' => '1',
    ];
    $this->db->where('iduser', $id);
    $this->db->update('users', $data);    
  }
  public function unban($id)
  {
    $data = [
      'ban' => '0',
    ];
    $this->db->where('iduser', $id);
    $this->db->update('users', $data);
  }
  public function update_users()
  {
    $user = $this->get_user_by_email(strtolower($this->input->post('email')));
    $user['right'] = $this->input->post('right');

    $this->db->where('iduser', $user['iduser']);
    $this->db->update('users', ['right' => $user['right']]);
  }
  public function update_seance()
  {
    $idseance = $this->input->post('idseance');
    $data = [
      'date' => $this->input->post('in_date'),
      'time' => $this->input->post('in_time')
    ];
    $this->db->where('idseance', $idseance);
    $this->db->update('seance', $data);
  }
  public function update_answers()
  {
    $idreponse = $this->input->post('IdReponse');
    $data = [
      'IdQuestion' => $this->input->post('IdQuestion'),
      'reponse' => $this->input->post('reponse'),
      'correct' => $this->input->post('correct')
    ];
    $this->db->where('IdReponse', $idreponse);
    $this->db->update('quizzAnswers', $data);
    redirect('admin/acceuil');
  }
  public function update_categories()
  {
    $idcategory = $this->input->post('idcategory');
    $data = [
      'name' => $this->input->post('name'),
      'content' => $this->input->post('content')
    ];
    $this->db->where('idcategory', $idcategory);
    $this->db->update('categories', $data);
  }
  public function update_news()
  {
    $idnews = $this->input->post('idnews');
    $data = [
      'title' => $this->input->post('title'),
      'content' => $this->input->post('content')
    ];
    $this->db->where('idnew', $idnews);
    $this->db->update('news', $data);
  }
}
