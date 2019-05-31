<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitor_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }
	
  //Get SELECT 
  public function get_seance()
  {
    $query = $this->db->get('seance');
    return $query->result_array();
  }
  public function get_vehicles()
  {
    $query = $this->db->get('vehicles');
    return $query->result_array();
  }
  public function listing()
  {
    $query = $this->db->get('listing');
    return $query->result_array();
  }
  public function get_appointment_all()
  {
    $query = $this->db->get('appointment_all');
    return $query->result_array();
  }
  public function regroup_user()
  {
    $query = $this->db->get('seance_count');
    return $query->result_array();
  }
  public function get_monitor_vehicle()
  {
    $query = $this->db->get('result_vehicle_all');
    return $query->result_array();	 
  }
  public function listingAll()
  {
    $query = $this->db->get('result_listing');
    return $query->result_array();
  }
  public function countListing()
  {
    $query = $this->db->get('count_listing');
    return $query->result_array();
  }
  public function seanceAll()
  {
    $query = $this->db->get('seance_all');
    return $query->result_array();
  }
  public function get_ban($email)
  {
    $ban = $this->db->get_where('users', ['ban' == '1', 'email'=>$email]);
    return $ban->row_array();
  }
  public function get_vehicles_where($id)
  {
    $ban = $this->db->get_where('vehicles', ['idvehicles' =>$id]);
    return $ban->row_array();
  }
  public function get_vehicles_Occuppee($id)
  {
    $ban = $this->db->get_where('vehicles', ['idvehicles' =>$id, 'status'=>'Occupée']);
    return $ban->row_array();
  }
  public function get_monitors($email)
  {
    $query = $this->db->get_where('users', ['email' => $email, 'right'=>'Moniteur']);
    return $query->row_array();
  }

  //Check Password, Ban ...
  public function check_password($email, $password)
  {
    $monitor_id = $this->get_monitors($email);

    if (!password_verify($password, $monitor_id['password']))
    {
      redirect('monitor/passwordError');
    }
    return $monitor_id['iduser'];
  }
  public function check_ban($email)
  {
    $monitor_id = $this->get_ban($email);
    if($monitor_id['ban'] == '0')
    {
      return TRUE;
    }
  }
  
  //Insert Value...
  public function insert_date()
  {
    $data = [
      'date' => $this->input->post('date'),
      'time' => $this->input->post('time')
    ];
    $this->db->insert('seance', $data);
    redirect('monitor/accueil');
  }
  public function insert_newdate()
  {
    $data = [
      'date' => $this->input->post('i_date'),
      'time' => $this->input->post('i_time')
    ];
    $this->db->insert('seance', $data);
    redirect('monitor/seance');
  }
  public function add_vehicles()
  {
    $data = [
      'brand' => $this->input->post('brand'),
      'mileage' => $this->input->post('mileage'),
	  'licenseplate' => $this->input->post('licenseplate'),
	  'status' => $this->input->post('status')
    ];
    $this->db->insert('vehicles', $data);
    redirect('monitor/vehicule');
  }
	
  public function insert_listing()
  {
	 for ($i = 0; $i<count($this->input->post('idseance[]')); $i++)
	  {
		  $data = [
			  'idseance'=> $this->input->post('idseance[]')[$i],
			  'result'  => $this->input->post('result[]')[$i],
			  'iduser'  => $this->input->post('iduser[]')[$i]
		  ];
		  $this->db->insert('listing', $data);
	  }
    redirect('monitor/seance');
  }
	
  public function add_reserv()
  {
	  	$la = $this->input->post('idVehicule');
		$data1 = [
		  "status" => "Occupée"
		];
		$this->db->where('idvehicles', $la);
		$this->db->update('vehicles', $data1); 
	  
	   $data = [
		  'idMonitor' => $this->input->post('idMonitor'),
		  'idVehicle' => $this->input->post('idVehicule'),
		  'idDate' => $this->input->post('idDate')
		];
    $this->db->insert('result_reserv', $data);
    redirect('monitor/vehicule');
  }
  
  
  public function form_add()
  {	  
	$a = $this->get_vehicles_where($this->input->post('idVehicule'));
	$result = $a['mileage'] + $this->input->post('mileage');
	
	$la = $this->input->post('idVehicule');
	$data = [
	  "mileage" => $result
	];
	$this->db->where('idvehicles', $la);
	$this->db->update('vehicles', $data);	   
	
	if($result >= 500000)
	{
		$id = $this->input->post('idVehicule');
		$this->removeVehicle($id);
	}else{
		$id = $this->input->post('idVehicule');
		$this->removeVehicle_a($id);
	}
	redirect('monitor/vehicule');
  }
  public function removeVehicle($id)
  {
    $data = [
      'status' => 'Détruite'
    ];
    $this->db->where('idvehicles', $id);
    $this->db->update('vehicles', $data);
	redirect('monitor/vehicule');	 
  }
  public function removeVehicle_a($id)
  {
    $data = [
      'status' => 'Disponible'
    ];
    $this->db->where('idvehicles', $id);
    $this->db->update('vehicles', $data);
	redirect('monitor/vehicule');	 
  }
  public function update_appointment()
  {
	  $la = $this->input->post('idAppointment');
	$data = [
	  "authorization"=> $this->input->post('authorization')
	];
	$this->db->where('idAppointment', $la);
	$this->db->update('appointment', $data); 
	redirect('monitor/appointment');
  }
  public function update_appointment_1()
  {
	  $la = $this->input->post('idAppointment');
	$data = [
	  "authorization"=> $this->input->post('authorization')
	];
	$this->db->where('idAppointment', $la);
	$this->db->update('appointment', $data); 
	redirect('monitor/accueil');
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
  public function delete_vehicles($id)
  {
    $this->db->where('idvehicles', $id);
    $this->db->delete('vehicles');
  }
  public function delete_seance($id)
  {
    $this->db->where('idseance', $id);
    $this->db->delete('seance');
  }
  public function delete_appointment($id)
  {
    $this->db->where('idAppointment', $id);
    $this->db->delete('appointment');
  }
  
}