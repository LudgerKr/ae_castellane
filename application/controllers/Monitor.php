<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitor extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('form'); // form_open()
    $this->load->library('form_validation');
    $this->load->model('monitor_model');
  }

  public function signin()
  {
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Mot de passe', 'required');

    if ($this->form_validation->run() === FALSE)
    {
      $data['title'] = 'Connexion Moniteur';
      $this->load->view('layouts/header');
      $this->load->view('monitor/signin', $data);
      $this->load->view('layouts/footer');
    }
    else 
    {
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $monitor_id = $this->monitor_model->check_password($email, $password);
      if ($monitor_id) {
    
        $ban = $this->monitor_model->check_ban($email);
        if($ban != TRUE)
        {
          $data['title'] = 'Banni';
          $this->load->view('layouts/header');
          $this->load->view('user/ban', $data);
          $this->load->view('layouts/footer');
        }
        else
        if($monitor_id != FALSE)
        {
		  $_SESSION['connect_monitor'] = TRUE;
		  $_SESSION['connect_monitor'] = $monitor_id;
		  redirect('monitor/accueil');
        } 
        else
        {
			$data['title'] = 'Connexion monitor';
			$data['error_msg'] = 'Identifiant ou mot de passe incorrect';      
			$this->load->view('layouts/header');
			$this->load->view('monitor/signin', $data);
			$this->load->view('layouts/footer');
        }
      }
    }
  }
	public function passwordError()
    {
	$this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Mot de passe', 'required');

    if ($this->form_validation->run() === FALSE) // si formulaire non rempli OU rempli mais incomplet
    {
      $data['title'] = 'Connexion Moniteur';
      $this->load->view('layouts/header');
	  $this->load->view('form/passwordError');
      $this->load->view('monitor/signin', $data);
      $this->load->view('layouts/footer');
    }
    else 
    {
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $monitor_id = $this->monitor_model->check_password($email, $password);
      if ($monitor_id) 
	  {
        $ban = $this->monitor_model->check_ban($email);
        if($ban != TRUE)
        {
          $data['title'] = 'Banni';
          $this->load->view('layouts/header');
          $this->load->view('user/ban', $data);
          $this->load->view('layouts/footer');
        }
        else
        if($monitor_id != FALSE)
        {
          $_SESSION['connect_monitor'] = TRUE;
          $_SESSION['connect_monitor'] = $monitor_id;
          redirect('monitor/accueil');
        } 
        else
        {
        $data['title'] = 'Connexion monitor';
        $data['error_msg'] = 'Identifiant ou mot de passe incorrect';      
        $this->load->view('layouts/header');
		$this->load->view('form/passwordError');
        $this->load->view('monitor/signin', $data);
        $this->load->view('layouts/footer');
        }
      }
    }
  }

  public function accueil()
  {
	$this->form_validation->set_rules('date', 'Email', 'required');
    $this->form_validation->set_rules('time', 'Email', 'required');
	$this->form_validation->set_rules('authorization', 'resultat', 'required');
	  
    if ($this->form_validation->run() === FALSE) // si formulaire non rempli OU rempli mais incomplet
    {
	    $seance = $this->monitor_model->get_seance();
	    $regroup = $this->monitor_model->regroup_user();
 	    $get_appointment_all = $this->monitor_model->get_appointment_all();
      	$get_vehicle = $this->monitor_model->get_vehicles();
		
		$data['get_vehicle'] = $get_vehicle;
		$data['get_appointment_all'] = $get_appointment_all; 
	    $data['regroup'] = $regroup;
	    $data['seance'] = $seance;
      
		$data['title'] = 'Accueil Moniteur';      
		$this->load->view('layouts/header');
		$this->load->view('monitor/accueil', $data);
		$this->load->view('layouts/footer');
    }
	else
	{    
	    $seance = $this->monitor_model->get_seance();
	    $regroup = $this->monitor_model->regroup_user();
	    $insert_date = $this->monitor_model->insert_date();
		$update_appointment = $this->monitor_model->update_appointment_1();
		$get_appointment_all = $this->monitor_model->get_appointment_all();
      	$get_vehicle = $this->monitor_model->get_vehicles();
		
		$data['get_vehicle'] = $get_vehicle;
		$data['get_appointment_all'] = $get_appointment_all;     
		$data['update_appointment'] = $update_appointment;
		$data['seance'] = $seance;
		$data['title'] = 'Accueil Moniteur';
		
		$this->load->view('layouts/header');
		$this->load->view('monitor/accueil', $data);
		$this->load->view('layouts/footer');
    }
  }
	
  public function appointment()
  {
	$this->form_validation->set_rules('monitor', 'moniteur', 'required');
  	$this->form_validation->set_rules('titre', 'Titre', 'required');
  	$this->form_validation->set_rules('object', 'Objet', 'required');
	$this->form_validation->set_rules('content', 'Message', 'required');
  	$this->form_validation->set_rules('date', 'Date', 'required');
	$this->form_validation->set_rules('time', 'Horraire', 'required');
	$this->form_validation->set_rules('heureConduite', 'Heure demander', 'required');
	$this->form_validation->set_rules('authorization', 'resultat', 'required');
	  
    if ($this->form_validation->run() === FALSE)
    {
 	 $get_appointment_all = $this->monitor_model->get_appointment_all();
      
	$data['get_appointment_all'] = $get_appointment_all; 
    $data['title'] = 'Rendez-vous';
	  
    $this->load->view('layouts/header');
    $this->load->view('monitor/appointment', $data);
    $this->load->view('layouts/footer');
   }
   else
   {
	 $update_appointment = $this->monitor_model->update_appointment();
 	 $get_appointment_all = $this->monitor_model->get_appointment_all();
      
	$data['get_appointment_all'] = $get_appointment_all;     
	$data['update_appointment'] = $update_appointment;
	   
    $this->load->view('layouts/header');
    $this->load->view('monitor/appointment', $data);
    $this->load->view('layouts/footer');		  
   }
  }
	
  public function calendrier()
  {
	  $appointmentAll = $this->monitor_model->get_appointment_all();
	  
	  $data['appointmentAll'] = $appointmentAll;
	  $data['title'] = 'calendrier';
	  $this->load->view('layouts/header');
	  $this->load->view('monitor/calendrier', $data);
	  $this->load->view('layouts/footer');
  }
  public function seance()
  {
	$this->form_validation->set_rules('i_date', 'date', 'required');
    $this->form_validation->set_rules('i_time', 'time', 'required');

    if ($this->form_validation->run() === FALSE) // si formulaire non rempli OU rempli mais incomplet
    {
      $regroup = $this->monitor_model->regroup_user();
	  $seanceAll = $this->monitor_model->seanceAll();
	  $listingAll = $this->monitor_model->listingAll();
	  $countListing = $this->monitor_model->countListing();
		
	  $data['countListing'] = $countListing;		
	  $data['listingAll'] = $listingAll;
	  $data['seanceAll'] = $seanceAll;
      $data['regroup'] = $regroup;
      $data['title'] = 'Moniteur';
		
	  if(!empty($_SESSION['listing']))
	  {
		  $this->load->view('layouts/header');
		  $this->load->view('form/listingError');
		  $this->load->view('monitor/seance', $data);
		  $this->load->view('layouts/footer');
	  }
	  elseif(empty($_SESSION['listing']))
	  {
		  $this->load->view('layouts/header');
		  $this->load->view('monitor/seance', $data);
		  $this->load->view('layouts/footer');
	  }
	}
    else
	{  
      	  $insert_seance = $this->monitor_model->insert_newdate();
	  
      	  $regroup = $this->monitor_model->regroup_user();
	  	  $seanceAll = $this->monitor_model->seanceAll();
	  	  $listingAll = $this->monitor_model->listingAll();
		  $countListing = $this->monitor_model->countListing();
		
	      $data['countListing'] = $countListing;
	      $data['listingAll'] = $listingAll;
	      $data['seanceAll'] = $seanceAll;
	      $data['regroup'] = $regroup;
	      $data['title'] = 'Moniteur';
		
	  if(!empty($_SESSION['listing']))
	  {
		  $this->load->view('layouts/header');
		  $this->load->view('form/listingError');
		  $this->load->view('monitor/seance', $data);
		  $this->load->view('layouts/footer');
	  }
	  elseif(empty($_SESSION['listing']))
	  {
		  $this->load->view('layouts/header');
		  $this->load->view('form/listingSuccess');
		  $this->load->view('monitor/seance', $data);
		  $this->load->view('layouts/footer');
	  }
    }
  }

  public function vehicule()
  {
	$this->form_validation->set_rules('', '', 'required');
	  
    if ($this->form_validation->run() === FALSE) // si formulaire non rempli OU rempli mais incomplet
    {
		$get_vehicles = $this->monitor_model->get_vehicles();
	    $get_appointments = $this->monitor_model->get_appointment_all();
		$get_monitor_vehicle = $this->monitor_model->get_monitor_vehicle();
			
		$data['get_monitor_vehicle'] = $get_monitor_vehicle;
		$data['get_appointments'] = $get_appointments;	
		$data['get_vehicles'] = $get_vehicles;
		$data['title'] = 'Véhicule';      
		
		$this->load->view('layouts/header');
		$this->load->view('monitor/vehicule', $data);
		$this->load->view('layouts/footer');
	}
	else
	{
	    $get_vehicles = $this->monitor_model->get_vehicles();
		$get_monitor_vehicle = $this->monitor_model->get_monitor_vehicle();
			
		$data['get_monitor_vehicle'] = $get_monitor_vehicle;
		$data['get_vehicles'] = $get_vehicles;
		$data['title'] = 'Véhicule';  
		
		$this->load->view('layouts/header');
		$this->load->view('monitor/vehicule', $data);
		$this->load->view('layouts/footer');
	}  
  }
  public function reserv()
  {
	    $this->form_validation->set_rules('idMonitor', 'vehicule', 'required');
	 	$this->form_validation->set_rules('idVehicule', 'vehicule', 'required');
		$this->form_validation->set_rules('idDate', 'date', 'required'); 
	  	
	  	$this->monitor_model->add_reserv();
  }
	
	public function form_add()
	{    
		$this->form_validation->set_rules('idVehicule', 'vehicule', 'required');
		$this->form_validation->set_rules('mileage', 'Kilometrage', 'required');
		
		$this->monitor_model->form_add();
	}
	
  public function listing()
  {
	$this->form_validation->set_rules('idseance[]', 'Identification', 'required');
    $this->form_validation->set_rules('result[]', 'Présent', 'required');
	$this->form_validation->set_rules('iduser[]', 'Utilisateur', 'required');

    if ($this->form_validation->run() === FALSE) // si formulaire non rempli OU rempli mais incomplet
    {
		$regroup = $this->monitor_model->regroup_user();
		$seanceAll = $this->monitor_model->seanceAll();
		$listing = $this->monitor_model->listing();

		$data['listing'] = $listing;
		$data['seanceAll'] = $seanceAll;
		$data['regroup'] = $regroup;
		$data['title'] = 'Liste Présence';

		$this->load->view('layouts/header');
		$this->load->view('monitor/listing', $data);
		$this->load->view('layouts/footer');
	 }
	 else
	 {  
        $insert_listing = $this->monitor_model->insert_listing();
		 
		$regroup = $this->monitor_model->regroup_user();
		$seanceAll = $this->monitor_model->seanceAll();
		$listing = $this->monitor_model->listing();

		$data['listing'] = $listing;
		$data['seanceAll'] = $seanceAll;
		$data['regroup'] = $regroup;
		$data['title'] = 'Liste Présence';

		$this->load->view('layouts/header');
		$this->load->view('monitor/listing', $data);
		$this->load->view('layouts/footer');
    }
  }
  public function edit_seance()
  {
    $this->form_validation->set_rules('in_date', 'date', 'required');
    $this->form_validation->set_rules('in_time', 'time', 'required');

    if ($this->form_validation->run() != FALSE)
    {
      $seances = $this->monitor_model->update_seance();
    } 
      redirect('monitor/seance');
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
      $vehicles = $this->monitor_model->update_vehicles();
    } 
      redirect('monitor/vehicule');
  }
  public function add_vehicles()
  {
    $this->form_validation->set_rules('brand', 'marque', 'required');
    $this->form_validation->set_rules('mileage', 'kilometrage', 'required');
	$this->form_validation->set_rules('licenseplate', 'plaque immatriculation', 'required');
    $this->form_validation->set_rules('status', 'statut', 'required');
	  
    if ($this->form_validation->run() != FALSE)
    {
      $vehicles = $this->monitor_model->add_vehicles();
    } 
      redirect('monitor/vehicule');
  }
  public function update_appointment()
  {
    $this->form_validation->set_rules('authorization', 'Authorisation', 'required');
    if ($this->form_validation->run() != FALSE)
    {
      $this->monitor_model->update_appointment($idAppointment);
    } 
      redirect('monitor/appointment');
  }
  public function update_appointment_1()
  {
    $this->form_validation->set_rules('authorization', 'Authorisation', 'required');
    if ($this->form_validation->run() != FALSE)
    {
      $this->monitor_model->update_appointment_1($idAppointment);
    } 
      redirect('monitor/accueil');
  }
   
   public function delete_seance($id)
  {
    $this->monitor_model->delete_seance($id);
    redirect('monitor/seance');
  }
   public function delete_vehicles($id)
  {
    $this->monitor_model->delete_vehicles($id);
    redirect('monitor/vehicule');
  }
  public function delete_appointment($id)
  {
    $this->monitor_model->delete_appointment($id);
    redirect('monitor/appointment');
  }
}