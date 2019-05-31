<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
 
  public function __construct() {
    parent::__construct();
    $this->load->model('pages_model');
  }

  public function view($page = 'accueil')
  {
    if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
      show_404();
    }
    $news = $this->pages_model->get_news();

    $data['news'] = $news;
    $data['title'] = ucfirst($page);

    $this->load->view('layouts/header');
    $this->load->view('pages/' . $page, $data);
    $this->load->view('layouts/footer');
  }

}

