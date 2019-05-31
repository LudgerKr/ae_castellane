<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  //////////////////////////////////// CONSTRUCTEUR //////////////////////////////////// 
  public function __construct() {
    parent::__construct();
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->model('admin_model');
  }
  //////////////////////////////////// PAGE DOSSIER ADMINISTRATEUR //////////////////////////////////// 
  public function admin()
  {
    $data['title'] = 'Administrateur';
    $this->load->view('layouts/header');
    $this->load->view('admin/signin', $data);
    $this->load->view('layouts/footer');
  }
  ///////////// PAGE ACCUEIL///////////// 
  public function accueil()
  { 
    $this->form_validation->set_rules('date', 'Email', 'required');
    $this->form_validation->set_rules('time', 'Email', 'required');

    if ($this->form_validation->run() === FALSE) // si formulaire non rempli OU rempli mais incomplet
    {
      $users = $this->admin_model->get_admin();
      $seance = $this->admin_model->regroup_user();;
      $regroup = $this->admin_model->regroup_user();

      $data['regroup'] = $regroup;
      $data['seance'] = $seance;
      $data['users'] = $users;
      $data['title'] = 'Administrateur';
      
      $this->load->view('layouts/header');
      $this->load->view('admin/accueil', $data);
      $this->load->view('layouts/footer');
    }else{    

      $users = $this->admin_model->get_admin();
      $seance = $this->admin_model->regroup_user();
      $insert_date = $this->admin_model->insert_date();
      
      $data['seance'] = $seance;
      $data['users'] = $users;
      $data['title'] = 'Administrateur';
      $this->load->view('layouts/header');
      $this->load->view('admin/accueil', $data);
      $this->load->view('layouts/footer');
    }
  }
  ///////////// PAGE CONNEXION ///////////// 
  public function signin()
  {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('email', '<b>email</b>', 'required|valid_emails');
    $this->form_validation->set_rules('password', '<b>mot de passe</b>', 'required|min_length[4]|max_length[25]|alpha_numeric');

    if ($this->form_validation->run() == TRUE)
    {
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $admin_id = $this->admin_model->check_password($email, $password);
      if ($admin_id) {
    
        $ban = $this->admin_model->check_ban($email);
        if($ban != TRUE)
        {
          $data['title'] = 'Banni';
          $this->load->view('layouts/header');
          $this->load->view('user/ban', $data);
          $this->load->view('layouts/footer');
        }
        elseif($admin_id != FALSE)
        { 
          $_SESSION['connect_admin'] = TRUE;
          $_SESSION['connect_admin'] = $admin_id;
          redirect('admin/accueil');
        }
      }
      else
      {
        $data['errors'] = 'Mauvais Identifiant';
        $this->load->view('layouts/header');
        $this->load->view('admin/signin', $data);
        $this->load->view('layouts/footer');
      }
    }
    else
    {
      $data['title'] = 'Connexion administrateur';    
      $this->load->view('layouts/header');
      $this->load->view('admin/signin', $data);
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

      $admin_id = $this->admin_model->check_password($email, $password);
      if ($admin_id) {
    
        $ban = $this->admin_model->check_ban($email);
        if($ban != TRUE)
        {
          $data['title'] = 'Banni';
          $this->load->view('layouts/header');
          $this->load->view('user/ban', $data);
          $this->load->view('layouts/footer');
        }
        elseif($admin_id != FALSE)
        { 
          $_SESSION['connect_admin'] = TRUE;
          $_SESSION['connect_admin'] = $admin_id;
          redirect('admin/accueil');
        }
      }
      else
      {
        $data['errors'] = 'Mauvais Identifiant';
        $this->load->view('layouts/header');
		$this->load->view('form/passwordError');
        $this->load->view('admin/signin', $data);
        $this->load->view('layouts/footer');
      }
    }
    else
    {
      $data['title'] = 'Connexion administrateur';    
      $this->load->view('layouts/header');
	  $this->load->view('form/passwordError');
      $this->load->view('admin/signin', $data);
      $this->load->view('layouts/footer');
    }
  }
    ///////////// PAGE FORUM ///////////// 
    public function forum()
    {
      $this->form_validation->set_rules('name', 'Ajouter une nouvelle catégories', 'required');
      $this->form_validation->set_rules('content', 'Ajouter une phrase de contenue', 'required');
  
      if ($this->form_validation->run() === FALSE) // si formulaire non rempli OU rempli mais incomplet
      {
        $count_categories = $this->admin_model->count_categories();
        $get_forum_categories = $this->admin_model->get_forum_categories();
        $get_article_info = $this->admin_model->get_article_info();

        $data['get_article_info'] = $get_article_info;
        $data['count_categories'] = $count_categories;
        $data['get_forum_categories'] = $get_forum_categories;
        $data['title'] = 'Forum';
        $this->load->view('layouts/header');
        $this->load->view('admin/forum', $data);
        $this->load->view('layouts/footer');
      }
      else
      {
        $count_categories = $this->admin_model->count_categories();
        $get_forum_categories = $this->admin_model->get_forum_categories();
        $this->admin_model->insert_categories();
        $get_article_info = $this->admin_model->get_article_info();

        $data['get_article_info'] = $get_article_info;
        $data['count_categories'] = $count_categories;
        $data['get_forum_categories'] = $get_forum_categories;

        $data['title'] = 'Forum';     
        $this->load->view('layouts/header');
        $this->load->view('admin/forum', $data);
        $this->load->view('layouts/footer');
      }
    }
  ///////////// PAGE QUIZZ ///////////// 
  public function quizz()
  {
    $question = $this->form_validation->set_rules('add_question', 'Question', 'required');
    $answers = $this->form_validation->set_rules('add_answers', 'Réponse', 'required');

    if ($this->form_validation->run() === FALSE) // si formulaire non rempli OU rempli mais incomplet
    {
      $get_quizzQuestions = $this->admin_model->get_quizzQuestions();
      $get_quizzAnswers = $this->admin_model->get_quizzAnswers();
      $get_quizz = $this->admin_model->get_quizz();
 
      $data['get_quizz'] = $get_quizz;
      $data['get_quizzQuestions'] = $get_quizzQuestions;
      $data['get_quizzAnswers'] = $get_quizzAnswers;
      $data['title'] = 'Quizz';
      $this->load->view('layouts/header');
      $this->load->view('admin/quizz', $data);
      $this->load->view('layouts/footer');
    }
    else
    {
      $this->admin_model->insertQuestion();
      $this->admin_model->insertAnswers();

      $data['title'] = 'Quizz';     

      $this->load->view('layouts/header');
      $this->load->view('admin/quizz', $data);
      $this->load->view('layouts/footer');
    }
  }
  ///////////// PAGE CERTIFICATS  ///////////// 
  public function certificats()
  {
    $certificats = $this->admin_model->get_certificats();

    $data['certificats'] = $certificats;
    $data['title'] = 'Certificats';
    $this->load->view('layouts/header');
    $this->load->view('admin/certificats', $data);
    $this->load->view('layouts/footer');
  }
  ///////////// PAGE UTILISATEURS ///////////// 
  public function user()
  {
    if ($this->form_validation->run() === FALSE)
    {
      $users = $this->admin_model->get_admin();
      $data['users'] = $users;
      $data['title'] = 'Utilisateur';     
      $this->load->view('layouts/header');
      $this->load->view('admin/user', $data);
      $this->load->view('layouts/footer');
    }
    else
    {
      if ($this->admin_model->update_users());
      {
        redirect('admin/accueil');
      }
    }
  }
  ///////////// PAGE SEANCE  ///////////// 
  public function seance()
  {
    $this->form_validation->set_rules('i_date', 'date', 'required');
    $this->form_validation->set_rules('i_time', 'time', 'required');

    if ($this->form_validation->run() === FALSE) // si formulaire non rempli OU rempli mais incomplet
    {
      $seances = $this->admin_model->regroup_user();

      $data['seances'] = $seances;
      $data['title'] = 'Administrateur';
      $this->load->view('layouts/header');
      $this->load->view('admin/seance', $data);
      $this->load->view('layouts/footer');
    }else{  
      
      $insert_seance = $this->admin_model->insert_newdate();

      $data['title'] = 'Administrateur';
      $this->load->view('layouts/header');
      $this->load->view('admin/seance', $data);
      $this->load->view('layouts/footer');
    }
  } 
    ///////////// PAGE Articles ///////////// 
    public function article()
    {
      $articles = $this->admin_model->get_article();
      $article_all_info = $this->admin_model->get_article_info();

      $data['article_all_info'] = $article_all_info;
      $data['articles'] = $articles;
 
      $data['title'] = 'Articles';     
      $this->load->view('layouts/header');
      $this->load->view('admin/article', $data);
      $this->load->view('layouts/footer');  
    }
  ///////////// PAGE news ///////////// 
  public function news()
  {
    $this->form_validation->set_rules('title', 'Titre', 'required');
   	$this->form_validation->set_rules('content', 'Contenu', 'required');

    if ($this->form_validation->run() === FALSE)
    {
      $news = $this->admin_model->get_news();
      
      $data['news'] = $news;     
      $data['title'] = 'Annonce';     
      $this->load->view('layouts/header');
      $this->load->view('admin/news', $data);
      $this->load->view('layouts/footer');
    }
    else
    {
      $insert_news = $this->admin_model->insert_news();
      $news = $this->admin_model->get_news();
      
      $data['news'] = $news;
      $data['title'] = 'Administrateur';
      $this->load->view('layouts/header');
      $this->load->view('admin/news', $data);
      $this->load->view('layouts/footer');
    }
  } 
  //////////////////////////////////// APPEL AU FONCTIONNALITER ////////////////////////////////////
  ///////////// PAGE DROIT ///////////// 
  public function right()
  {
    $this->form_validation->set_rules('email', 'L\'adresse mail', 'required');
    $this->form_validation->set_rules('right', 'Le rôle', 'required');

    if ($this->form_validation->run() === FALSE)
    {
      $data['title'] = 'Droit';     
      $this->load->view('layouts/header');
      $this->load->view('admin/signin', $data);
      $this->load->view('layouts/footer');
    }
    else
    {
      if ($this->admin_model->update_users());
      {
        redirect('admin/accueil');
      }
    }
  }
  public function update_answers()
  {
    $this->form_validation->set_rules('IdQuestion', 'identifant question', 'required');
    $this->form_validation->set_rules('IdReponse', 'identifant reponse', 'required');
    $this->form_validation->set_rules('reponse', 'réponse', 'required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('correct', '(Bonne / Mauvaise) réponse', 'required');

    if ($this->form_validation->run() === FALSE)
    {
      $get_quizzQuestions = $this->admin_model->get_quizzQuestions();
      $get_quizzAnswers = $this->admin_model->get_quizzAnswers();
      $get_quizz = $this->admin_model->get_quizz();
 
      $data['get_quizz'] = $get_quizz;
      $data['get_quizzQuestions'] = $get_quizzQuestions;
      $data['get_quizzAnswers'] = $get_quizzAnswers;
      $data['title'] = 'quizz';     
      $this->load->view('layouts/header');
      $this->load->view('admin/quizz', $data);
      $this->load->view('layouts/footer');
    }
    else
    {
     $this->admin_model->update_answers();      
    }
  }

  public function add_question()
  {
    $this->form_validation->set_rules('question', 'Question', 'required');

    if ($this->form_validation->run() != FALSE)
    {
      $questions = $this->admin_model->add_question();
    } 
      redirect('admin/quizz');
  }
  public function add_answers()
  {
    $this->form_validation->set_rules('idquestion', 'identifiant de la question', 'required');
    $this->form_validation->set_rules('reply', 'réponse', 'required');
    $this->form_validation->set_rules('correct', 'réponse', 'required');

    if ($this->form_validation->run() != FALSE)
    {
      $answers = $this->admin_model->add_answers();
    } 
      redirect('admin/quizz');
  }
  //////////////////////////////////// UPDATE //////////////////////////////////// 
  public function edit_seance()
  {
    $this->form_validation->set_rules('in_date', 'date', 'required');
    $this->form_validation->set_rules('in_time', 'time', 'required');

    if ($this->form_validation->run() != FALSE)
    {
      $seances = $this->admin_model->update_seance();
    } 
      redirect('admin/seance');
  }
  public function edit_quizz()
  {
    $this->form_validation->set_rules('up_question', 'Question', 'required');
    $this->form_validation->set_rules('up_reply', 'Réponse', 'required');

    if ($this->form_validation->run() != FALSE)
    {
      $seances = $this->admin_model->update_quizz();
    } 
      redirect('admin/quizz');
  }
  public function edit_categories()
  {
    $this->form_validation->set_rules('name', 'nom', 'required');
    $this->form_validation->set_rules('content', 'Description', 'required');

    if ($this->form_validation->run() != FALSE)
    {
      $categories = $this->admin_model->update_categories();
    } 
      redirect('admin/forum');
  }
  public function edit_news()
  {
    $this->form_validation->set_rules('title', 'Titre', 'required');
    $this->form_validation->set_rules('content', 'Contenu', 'required');

    if ($this->form_validation->run() != FALSE)
    {
      $news = $this->admin_model->update_news();
    } 
      redirect('admin/news');
  }
  //////////////////////////////////// BANNISSEMENT //////////////////////////////////// 
  public function ban($id)
  {
    $ban = $this->admin_model->ban($id);
    redirect('admin/accueil');
  }
  public function unban($id)
  {
    $ban = $this->admin_model->unban($id);
    redirect('admin/accueil');
  }
  public function i_ban($id)
  {
    $ban = $this->admin_model->ban($id);
    redirect('admin/user');
  }
  public function i_unban($id)
  {
    $ban = $this->admin_model->unban($id);
    redirect('admin/user');
  }
  //////////////////////////////////// DELETE //////////////////////////////////// 
  public function delete_user($id)
  {
    $this->admin_model->delete_user($id);
    redirect('admin/user');
  }
  public function delete_question_quizz($id)
  {
    $this->admin_model->delete_question_quizz($id);
    redirect('admin/quizz');
  }
  public function delete_seance($id)
  {
    $this->admin_model->delete_seance($id);
    redirect('admin/seance');
  }
  public function delete_categories($id)
  {
    $this->admin_model->delete_categories($id);
    redirect('admin/forum');
  }
  public function delete_article($id)
  {
    $this->admin_model->delete_article($id);
    redirect('admin/article');
  }
  public function delete_news($id)
  {
    $this->admin_model->delete_news($id);
    redirect('admin/news');
  }
// vehicule a
  public function vehicule()
  {
	$this->form_validation->set_rules('', '', 'required');
	  
    if ($this->form_validation->run() === FALSE) // si formulaire non rempli OU rempli mais incomplet
    {
		$get_vehicles = $this->admin_model->get_vehicles();
			
		$data['get_vehicles'] = $get_vehicles;
		$data['title'] = 'Véhicule';      
		
		$this->load->view('layouts/header');
		$this->load->view('admin/vehicule', $data);
		$this->load->view('layouts/footer');
	}
	else
	{
	    $get_vehicles = $this->admin_model->get_vehicles();
			
		$data['get_vehicles'] = $get_vehicles;
		$data['title'] = 'Véhicule';  
		
		$this->load->view('layouts/header');
		$this->load->view('admin/vehicule', $data);
		$this->load->view('layouts/footer');
	}  
  }
public function form_add()
{    
	$this->form_validation->set_rules('idVehicule', 'vehicule', 'required');
	$this->form_validation->set_rules('mileage', 'Kilometrage', 'required');

	$this->admin_model->form_add();
}
 public function edit_vehicles()
  {
    $this->form_validation->set_rules('brand', 'Marque', 'required');
    $this->form_validation->set_rules('mileage', 'Kilometrage', 'required');
	$this->form_validation->set_rules('licenseplate', 'plaque immatriculation', 'required');
    $this->form_validation->set_rules('status', 'statut', 'required');
    $this->form_validation->set_rules('idvehicles', 'identifiant', 'required');
	  
    if ($this->form_validation->run() != FALSE)
    {
      $vehicles = $this->admin_model->update_vehicles();
    } 
      redirect('admin/vehicule');
  }
  public function add_vehicles()
  {
    $this->form_validation->set_rules('brand', 'marque', 'required');
    $this->form_validation->set_rules('mileage', 'kilometrage', 'required');
	$this->form_validation->set_rules('licenseplate', 'plaque immatriculation', 'required');
    $this->form_validation->set_rules('status', 'statut', 'required');
	  
    if ($this->form_validation->run() != FALSE)
    {
      $vehicles = $this->admin_model->add_vehicles();
    } 
      redirect('admin/vehicule');
  }
  //////////////////////////////////// DECONNEXION ////////////////////////////////////
  public function logout()
  {
    $_SESSION = [];
    session_unset ();
    session_destroy();
    redirect();
  }
}