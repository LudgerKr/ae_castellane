<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }
  //ALL_SELECT
  public function get_certificats()
  {
    $query = $this->db->get('result_certificats');
    return $query->result_array();
  }
  public function get_questions()
  {
    $query = $this->db->get('questions');
    return $query->result_array();
  } 
  public function get_resultQuizz()
  {
    $query = $this->db->get('result_quizz');
    return $query->result_array();
  }
  public function get_registerSeance()
  {
    $query = $this->db->get('register_seance');
    return $query->result_array();
  }
  public function get_seance()
  {  
    $query = $this->db->get('seance');
    return $query->result_array();
  }
  public function get_seances()
  { 
    $query = $this->db->get('seance_all');
    return $query->result_array();
  }
  public function get_article()
  { 
    $query = $this->db->get('articles_all_info');
    return $query->result_array();
  }
  public function quizzQuestions()
  {
    $query = $this->db->count_all('quizzQuestions');
    return $query;
  }
  public function getuser()
  { 
    $query = $this->db->get('users');
    return $query->result_array();
  }
  public function get_quizzAnswers()
  { 
    $query = $this->db->get('quizzAnswers');
    return $query->result_array();
  }
  public function get_quizzQuestions()
  {
    $query = $this->db->get('quizzQuestions');
    return $query->result_array();
  }
  public function get_appointment()
  {
    $query = $this->db->get('appointment');
    return $query->result_array();
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
  public function verifreponse($idquestion, $idreponse)
  {
    $reponses = $this->db->get_where('quizzAnswers', ['idQuestion' => $idquestion, 'idReponse'=> $idreponse, 'correct' => '1']);
    return $reponses->row_array();
  }
  public function genere($email, $idQuestion, $reponse)
  {
    $reponse = $this->db->get_where('users', ['email' => $email, 'idquestion'=> $idQuestion, 'reply' => $reponse]);
    return $reponse->row_array();
  }
   public function Get_seanceVerif($iduser, $idseance)
  {
    $reponses = $this->db->get_where('register_seance', ['userid' => $iduser, 'seanceid'=> $idseance]);
    return $reponses->row_array();
  }
  public function get_users($email) {
    $query = $this->db->get_where('users', ['email' => $email]);
    return $query->row_array();
  }
  public function get_ban($email)
  {
    $ban = $this->db->get_where('users', ['ban' == '1', 'email'=>$email]);
    return $ban->row_array();
  }

  //ALL VERIF
  public function check_password($email, $password) {
    $user = $this->get_users($email);

		if (!password_verify($password, $user['password']))
		{
		  redirect('user/passwordError');
		}
    return $user['iduser'];
  }
  
  public function check_ban($email)
  {
    $user = $this->get_ban($email);
    if($user['ban'] == '0')
    {
      return TRUE;
    } 
  } 
 
  //ALL_Insert
  public function insert_users()
  {
	if($this->input->post('age') < 18)
	{
		redirect('user/formError');
	}
	else{ 
		$data = [
		  "firstname" => $this->input->post('firstname'),
		  "lastname" => strtoupper($this->input->post('lastname')),
		  "age" => $this->input->post('age'),
		  "sexe" => $this->input->post('sexe'),
		  "idquestion" => $this->input->post('idquestion'),
		  "reply" => strtoupper($this->input->post('reply')),
		  "email" => strtolower($this->input->post('email')),
		  "phone" => $this->input->post('phone'),
		  "password" => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
		  "termsUse" => $this->input->post('terms')
		];
		$this->db->insert('users', $data);
	}
  }
  public function insert_session()
  {
	$idseance = $this->input->post('insert_session');
	$iduser = $_SESSION['userid'];
	$dd = $this->Get_seanceVerif($iduser, $idseance);
	  if($dd['seanceid'] != $this->input->post('insert_session')  )
	  {
		$data = [
		  "userid" => $_SESSION['userid'],
		  "seanceid" => $this->input->post('insert_session'),
		];
		$this->db->insert('register_seance', $data);
	  }
  }
  public function insert_note()
  {
    $countQuestions = $_SESSION['currentQuestion']-1;
    $data = [
      "userid" => $_SESSION['userid'],
      "note" => $_SESSION['note'],
      "nbQuestion" => $countQuestions
    ];
    $this->db->insert('result_quizz', $data);
    redirect('user/profil');
  }
  public function delete_seance($id)
  {
    $this->db->delete('register_seance', array('seanceid' => $id, 'userid' => $_SESSION['userid'])); 
  }
 
  //Update 
  public function update_users()
  {
    $iduser = $this->input->post('iduser');
    $data = [
      'email' => strtolower($this->input->post('email')),
      'phone' => $this->input->post('phone'),
      'idquestion' => $this->input->post('question'),
      'reply' => $this->input->post('reply')
    ];
    $this->db->where('iduser', $iduser);
    $this->db->update('users', $data);
  }
  public function changePassword($password)
  {
    $data = [
      'email' => strtolower($this->input->post('mail')),
      'idquestion' => $this->input->post('question'),
      'reply' => strtoupper($this->input->post('reply')),
	  'password' => password_hash($password, PASSWORD_BCRYPT)
    ];
    $this->db->where('email', strtolower($this->input->post('mail')));
    $this->db->update('users', $data);
  }
  public function insert_appointment()
  {
	$data = [
	  "iduser"       => $_SESSION['userid'],
	  "idMonitor"    => $this->input->post('idMonitor'),
	  "title"        => $this->input->post('titre'),
	  "object"       => $this->input->post('object'),
	  "content"      => $this->input->post('content'),
	  "date"         => $this->input->post('date'),
	  "horraire"     => $this->input->post('time'),
	  "timeConduite" => $this->input->post('heureConduite')
	];
	$this->db->insert('appointment', $data); 
	redirect('user/profil');
  }
}