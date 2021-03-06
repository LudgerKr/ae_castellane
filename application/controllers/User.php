<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

  //CONSTRUCT
  public function __construct() {
    parent::__construct();
    $this->load->helper('form'); // form_open()
    $this->load->library('form_validation'); // validation_errors()
    $this->load->model('user_model');
  }

  // PAGE SIGNUP
  public function signup()
  {
    $this->form_validation->set_rules('lastname', '<b>nom</b>', 'required|min_length[2]|max_length[50]|alpha');
    $this->form_validation->set_rules('firstname', '<b>prénom</b>', 'required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('email', '<b>email</b>', 'required|valid_emails|is_unique[users.email]');
    $this->form_validation->set_rules('password', '<b>mot de passe</b>', 'required|min_length[6]|max_length[25]|alpha_numeric');
    $this->form_validation->set_rules('age', '<b>age</b>', 'required|numeric|min_length[2]|max_length[3]');
    $this->form_validation->set_rules('sexe', '<b>civiliter</b>', 'required');
    $this->form_validation->set_rules('phone', '<b>numéro de portable</b>', 'required|integer|min_length[10]|max_length[10]');
    $this->form_validation->set_rules('idquestion', '<b>question</b>', 'required');
    $this->form_validation->set_rules('reply', '<b>réponse</b>', 'required|min_length[2]|max_length[50]|alpha');
    $this->form_validation->set_rules('terms','<b>les conditions d\'utilisation</b>','required|numeric');
	 
    if ($this->form_validation->run() === FALSE)
    {
      $questions = $this->user_model->get_questions();
      $data['questions'] = $questions;
      $data['title'] = 'Inscription';
      $this->load->view('layouts/header');
      $this->load->view('user/signup', $data);
      $this->load->view('layouts/footer');
    }
    else
    {
      $email = $this->input->post('email');

      if (empty($this->user_model->get_users($email)))
      {
          $this->user_model->insert_users();

          $this->load->view('layouts/header');
          $this->load->view('form/formsuccess');
          $this->load->view('user/signin');
          $this->load->view('layouts/footer');
        }
        else
        {
          $data['title'] = 'Inscription';

          $this->load->view('layouts/header');
          $this->load->view('user/signup', $data);
          $this->load->view('layouts/footer');
        }
      }
    }
	
  public function formError()
  {
  $data['title'] = 'Inscription';

  $this->load->view('layouts/header');
  $this->load->view('form/formError');  
  $this->load->view('user/signup', $data);
  $this->load->view('layouts/footer'); 
  }
  //PAGE SIGNIN
  public function signin()
  {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('email', '<b>email</b>', 'required|valid_emails');
    $this->form_validation->set_rules('password', '<b>mot de passe</b>', 'required|min_length[4]|max_length[25]|alpha_numeric');

    if ($this->form_validation->run() == TRUE)
    {
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $user_id = $this->user_model->check_password($email, $password);

      $ban = $this->user_model->check_ban($email);
      if($ban != TRUE)
      {
        $data['title'] = 'Banni';
        $this->load->view('layouts/header');
        $this->load->view('user/ban', $data);
        $this->load->view('layouts/footer');
      }
      elseif($user_id != FALSE)
      {
        $_SESSION['connect'] = TRUE;
        $_SESSION['userid'] = $user_id;
        redirect();
      }
      else
      {
        $data['title'] = 'Connexion';
        $data['error_msg'] = 'Identifiant ou mot de passe incorrect';
        $this->load->view('layouts/header');
		  
		  
        $this->load->view('user/signin', $data);
        $this->load->view('layouts/footer');
      }
    }
    else
    {
      $users = $this->user_model->getuser();

      $data['title'] = 'Connexion';
      $this->load->view('layouts/header');
      $this->load->view('user/signin', $data);
      $this->load->view('layouts/footer');
    }
  }
  public function passwordError()
  {
	$this->load->library('form_validation');

    $this->form_validation->set_rules('email', '<b>email</b>', 'required|valid_emails');
    $this->form_validation->set_rules('password', '<b>mot de passe</b>', 'required|min_length[4]|max_length[25]|alpha_numeric');

    if ($this->form_validation->run() == TRUE)
    {
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $user_id = $this->user_model->check_password($email, $password);

      $ban = $this->user_model->check_ban($email);
      if($ban != TRUE)
      {
        $data['title'] = 'Banni';
        $this->load->view('layouts/header');
        $this->load->view('user/ban', $data);
        $this->load->view('layouts/footer');
      }
      elseif($user_id != FALSE)
      {
        $_SESSION['connect'] = TRUE;
        $_SESSION['userid'] = $user_id;
        redirect();
      }
      else
      {
        $data['title'] = 'Connexion';
        $data['error_msg'] = 'Identifiant ou mot de passe incorrect';
		
        $this->load->view('layouts/header');
		$this->load->view('form/passwordError');
        $this->load->view('user/signin', $data);
        $this->load->view('layouts/footer');
      }
    }
    else
    {
      $users = $this->user_model->getuser();

      $data['title'] = 'Connexion';
      $this->load->view('layouts/header');
	  $this->load->view('form/passwordError');
      $this->load->view('user/signin', $data);
      $this->load->view('layouts/footer');
    }
  }
  //PAGE GENERATE
  public function generer()
  {
	$this->form_validation->set_rules('mail', '<b>email</b>', 'required');
    $this->form_validation->set_rules('idquestion', '<b>question</b>', 'required');
    $this->form_validation->set_rules('reply', '<b>réponse</b>', 'required|min_length[2]|max_length[50]|alpha');
    
	if($this->form_validation->run() == TRUE)
    {
	  $mail = $this->input->post('mail');
	  $question = $this->input->post('idquestion');
	  $reponse = $this->input->post('reply');
		
      $questions = $this->user_model->get_questions();
      $result = $this->user_model->genere($mail, $question, $reponse);
		
		$password = "";
		$chaine = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

		$password .= $chaine [rand(0,25)];
		$password .= $chaine [rand(0,25)];
		$password .= $chaine [rand(0,25)];
		$password .= $chaine [rand(26,31)];
		$password .= $chaine [rand(26,31)];
		$password .= $chaine [rand(26,31)];
		$password .= $chaine [rand(32,52)];
		$password .= $chaine [rand(32,52)];
		$password .= $chaine [rand(32,52)];
		
		$passwordA = str_shuffle($password);
		
		$changepassword = $this->user_model->changePassword($passwordA);
		
		$data['questions'] = $questions;
	    $data['passwordA'] = $passwordA;
	    $data['title'] = 'Récuperation de mot de passe';
		
	    $this->load->view('layouts/header');
	    $this->load->view('form/change', $data);
	    $this->load->view('user/generer', $data);
	    $this->load->view('layouts/footer');

    }
    else
    {
      $questions = $this->user_model->get_questions();
      $data['questions'] = $questions;

      $data['title'] = 'Récuperation de mot de passe';
      $this->load->view('layouts/header');
      $this->load->view('user/generer', $data);
      $this->load->view('layouts/footer');
      }
  }
   //PAGE error
   public function error()
   {
    $data['title'] = 'Erreur';
    $this->load->view('layouts/header');
    $this->load->view('form/error');
    $this->load->view('accueil', $data);
    $this->load->view('layouts/footer');
   }
  //PAGE PROFIL
  public function profil()
  {
    $this->form_validation->set_rules('insert_session', '', 'required');

    if ($this->form_validation->run() === FALSE)
    {
      $sessions = $this->user_model->get_seance();
      $get_article = $this->user_model->get_article();
      $get_users = $this->user_model->getuser();
      $questions = $this->user_model->get_questions();
      $get_seances = $this->user_model->get_seances();
      $get_resultQuizz = $this->user_model->get_resultQuizz();
	  $payment = $this->user_model->get_paymentResult();
      $seances_user = array_column($get_seances, 'idseance');
      $certificats = $this->user_model->get_certificats();
	  $registerSeance = $this->user_model->get_registerSeance();
      $get_appointment = $this->user_model->get_appointment();
		  
      $data['get_appointment'] = $get_appointment;
	  $data['registerSeance'] = $registerSeance;
	  $data['certificats'] = $certificats;
	  $data['payment'] = $payment;
      $data['get_resultQuizz'] = $get_resultQuizz;
      $data['get_seances'] = $get_seances;
      $data['questions'] = $questions;
      $data['get_users'] = $get_users;
      $data['get_article'] = $get_article;
      $data['sessions'] = $sessions;
      $data['title'] = 'Inscription';
		
      $this->load->view('layouts/header');
      $this->load->view('user/profil', $data);
      $this->load->view('layouts/footer');
    }
    else
    {
      $user = $_SESSION['userid'];

      $this->user_model->insert_session();
      $sessions = $this->user_model->get_seance();
      $get_article = $this->user_model->get_article();
      $get_users = $this->user_model->getuser();
      $questions = $this->user_model->get_questions();
      $get_seances = $this->user_model->get_seances();
	  $payment = $this->user_model->get_paymentResult();
	  $registerSeance = $this->user_model->get_registerSeance();
	  $get_resultQuizz = $this->user_model->get_resultQuizz();
      $get_appointment = $this->user_model->get_appointment();

      $data['get_appointment'] = $get_appointment;
	  $data['registerSeance'] = $registerSeance;
	  $data['payment'] = $payment;
	  $data['get_resultQuizz'] = $get_resultQuizz;
      $data['get_seances'] = $get_seances;
      $data['questions'] = $questions;
      $data['get_users'] = $get_users;
      $data['get_article'] = $get_article;
      $data['sessions'] = $sessions;
      $data['title'] = 'profil';

      $this->load->view('layouts/header');
      $this->load->view('user/profil', $data);
      $this->load->view('layouts/footer');
      }
    }

  public function quizz()
  {
    $quizzQuestion = $this->user_model->get_quizzQuestions();
    $quizzAnswers = $this->user_model->get_quizzAnswers();
    $row = $this->user_model->get_resultQuizz();

    $data['quizzQuestion'] = $quizzQuestion;
    $data['quizzAnswers'] = $quizzAnswers;
    $data['row'] = $row;

    $data['title'] = 'Bienvenue au Quizz';
    $this->load->view('layouts/header');
    $this->load->view('user/quizz', $data);
    $this->load->view('layouts/footer');
    }
  public function terms()
  {
	  $data['title'] = 'conditions d\'utilisation';
      $this->load->view('layouts/header');
      $this->load->view('user/terms', $data);
      $this->load->view('layouts/footer');
  }
  public function quizz_error()
  {
    $this->form_validation->set_rules('insert_session', '', 'required');

    if ($this->form_validation->run() === FALSE)
    {
      $sessions = $this->user_model->get_seance();
      $get_article = $this->user_model->get_article();
      $get_users = $this->user_model->getuser();
      $questions = $this->user_model->get_questions();
      $get_seances = $this->user_model->get_seances();
      $get_resultQuizz = $this->user_model->get_resultQuizz();
	  $payment = $this->user_model->get_paymentResult();

	  $seances_user = array_column($get_seances, 'idseance');

	  $data['payment'] = $payment;
      $data['get_resultQuizz'] = $get_resultQuizz;
      $data['get_seances'] = $get_seances;
      $data['questions'] = $questions;
      $data['get_users'] = $get_users;
      $data['get_article'] = $get_article;
      $data['sessions'] = $sessions;

      $data['title'] = 'Inscription';
      $this->load->view('layouts/header');
      $this->load->view('form/quizz_error');
      $this->load->view('user/profil', $data);
      $this->load->view('layouts/footer');
    }
    else
    {
      $user = $_SESSION['userid'];

      $this->user_model->insert_session();
      $sessions = $this->user_model->get_seance();
      $get_article = $this->user_model->get_article();
      $get_users = $this->user_model->getuser();
      $questions = $this->user_model->get_questions();
      $get_seances = $this->user_model->get_seances();

      $data['get_seances'] = $get_seances;
      $data['questions'] = $questions;
      $data['get_users'] = $get_users;
      $data['get_article'] = $get_article;
      $data['sessions'] = $sessions;
      $data['title'] = 'profil';

      $this->load->view('layouts/header');
      $this->load->view('user/profil', $data);
      $this->load->view('layouts/footer');
      }

  }

  public function payment()
  {
    $boutiques = $this->user_model->get_boutiques();
	$payment = $this->user_model->get_paymentResult();

    $data['payment'] = $payment;
    $data['boutiques'] = $boutiques;
    $data['title'] = 'Boutique';
	  
    $this->load->view('layouts/header');
    $this->load->view('user/payment', $data);
    $this->load->view('layouts/footer');
  }

public function note()
{
  $note = $_SESSION['note'];
  $this->user_model->insert_note();

}
  public function verifReponse()
  {
    $idquestion = $this->input->post('idQuestion');
    $idreponse = $this->input->post('idReponse');

    $reponses = $this->user_model->verifreponse($idquestion, $idreponse);
  if (gettype($reponses) != "NULL")
  {
    $_SESSION['note'] += 1;
  }

    $_SESSION['currentQuestion'] += 1;
    $nbQuestions = $this->user_model->quizzQuestions();

    if ($_SESSION['currentQuestion'] > $nbQuestions) {
    error_log("----------------------> FINISH <---------------------");
    echo json_encode(["rep" => "finish", "note" => $_SESSION['note']]);

    } else {
    error_log("-----------------------> NEXT <--------------------------");
    echo json_encode(["rep" => "next"]);
    }

  }
   public function appointment()
   {
	$this->form_validation->set_rules('idMonitor', 'moniteur', 'required');
  	$this->form_validation->set_rules('titre', 'Titre', 'required');
  	$this->form_validation->set_rules('object', 'Objet', 'required');
	$this->form_validation->set_rules('content', 'Message', 'required');
  	$this->form_validation->set_rules('date', 'Date', 'required');
	$this->form_validation->set_rules('time', 'Horraire', 'required');
	$this->form_validation->set_rules('heureConduite', 'Heure demander', 'required');
	   
    if ($this->form_validation->run() === FALSE)
    {
	  $userMonitor = $this->user_model->getuser();
	  
	  $data['userMonitor'] = $userMonitor;
	  $data['title'] = 'Rendez-vous';

      $this->load->view('layouts/header');
      $this->load->view('user/appointment', $data);
      $this->load->view('layouts/footer');
    }
    else
    {
	  $insert_appointment = $this->user_model->insert_appointment();
	  $userMonitor = $this->user_model->getuser();
	  
	  $data['userMonitor'] = $userMonitor;
      $data['title'] = 'Rendez-vous';

      $this->load->view('layouts/header');
      $this->load->view('user/appointment', $data);
      $this->load->view('layouts/footer');
     }
   }
	
  //PAGE finish
  public function finish()
  {
    $data['title'] = 'Bravo vous avez terminer';

    $this->load->view('layouts/header');
    $this->load->view('user/finish', $data);
    $this->load->view('layouts/footer');
  }
  //PAGE Quizz_Question
  public function answers_quizz()
  {
    $this->form_validation->set_rules('radio', '', 'required');
    $this->form_validation->set_rules('quizzid', '', 'required');

    if ($this->form_validation->run() === FALSE)
    {
      $questions = $this->user_model->get_question_quizz();
      $result = $this->user_model->get_result();

      $data['result'] = $result;
      $data['questions'] = $questions;
      $data['title'] = 'Répondre au question';
      $this->load->view('layouts/header');
      $this->load->view('user/quizz', $data);
      $this->load->view('layouts/footer');
    }
    else
    {
      $questions = $this->user_model->get_question_quizz();
      $this->user_model->insert_answers();

      $data['questions'] = $questions;
      $data['title'] = 'Réponse quizz';
      $this->load->view('layouts/header');
      $this->load->view('user/quizz', $data);
      $this->load->view('layouts/footer');
      }
    }

  public function edit_users()
  {
    $this->form_validation->set_rules('email', 'Email', 'required|valid_emails');
    $this->form_validation->set_rules('phone', 'Téléphone', 'required|integer|min_length[10]|max_length[10]');
    $this->form_validation->set_rules('question', 'Question', 'required');
    $this->form_validation->set_rules('reply', 'Réponse', 'required|min_length[2]|max_length[50]|alpha');

    if ($this->form_validation->run() != FALSE)
    {
      $users = $this->user_model->update_users();
    }
      redirect('user/profil');
  }
  public function delete_seance($id)
  {
    $this->user_model->delete_seance($id);
    redirect('user/profil');
  }
  //DISCONNECT
  public function logout()
  {
    $_SESSION = [];
    session_unset ();
    session_destroy();
    redirect();
  }
}
