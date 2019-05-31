<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends CI_Controller
{
  public function __construct() {
    parent::__construct();
    $this->load->helper('form'); // form_open()
    $this->load->library('form_validation'); // validation_errors()
    $this->load->model('forum_model');
  }

  public function articles()
  {
    $articles = $this->forum_model->get_Article();
    $categories = $this->forum_model->get_Categorie();
    $comments = $this->forum_model->get_comments();

    $data['comments'] = $comments;
    $data['categories'] = $categories;
    $data['articles'] = $articles;

    $data['title'] = 'Forum';
    $this->load->view('layouts/header');
    $this->load->view('pages/articles', $data);
    $this->load->view('layouts/footer');
  }

  public function forum()
  {
    $this->form_validation->set_rules('title', '<b>titre</b>', 'required|min_length[2]|max_length[50]|alpha_numeric_spaces');
    $this->form_validation->set_rules('categoryid', '<b>catégorie</b>', 'required');
    $this->form_validation->set_rules('content', '<b>contenue</b>', 'required');

    if ($this->form_validation->run() == FALSE)
    {
      $categories = $this->forum_model->get_Categorie();

      $data['categories'] = $categories;

      $data['title'] = 'Forum';
      $this->load->view('layouts/header');
      $this->load->view('pages/forum', $data);
      $this->load->view('layouts/footer');
    }
    elseif($_SESSION['userid'] === FALSE)
    { 
      $categories = $this->forum_model->get_Categorie();

      $data['categories'] = $categories;
      $data['title'] = 'Erreur';
      $this->load->view('layouts/header');
      $this->load->view('pages/forum', $data);
      $this->load->view('layouts/footer');
    }
    else
    {
      $categories = $this->forum_model->get_Categorie();
      $insert_articles = $this->forum_model->insert_article();

      $data['insert_articles'] = $insert_articles;
      $data['categories'] = $categories;

      $data['title'] = 'Forum';
      $this->load->view('layouts/header');
      $this->load->view('pages/forum', $data);
      $this->load->view('layouts/footer');
    }
  }

  public function edit_article()
  {
    $this->form_validation->set_rules('title', 'titre', 'required');
    $this->form_validation->set_rules('categoryid', 'id Catégorie', 'required');
    $this->form_validation->set_rules('content', 'contenue', 'required');

    if ($this->form_validation->run() != FALSE)
    {
      $article = $this->forum_model->update_article();
    } 
      redirect('forum/forum');
  }
  public function insert_comment()
  {
    $this->form_validation->set_rules('content', 'Commentaire', 'required');

    if ($this->form_validation->run() != FALSE)
    {
      $article = $this->forum_model->insert_comment();
    } 
      redirect('articles');
  }

  public function delete_article($id)
  {
    $this->forum_model->delete_article($id);
    redirect('forum/forum');
  }
  public function delete_commentaires($id)
  {
    $this->forum_model->delete_commentaires($id);
    redirect('forum/forum');
  }
} 
  