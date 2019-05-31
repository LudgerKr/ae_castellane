<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model
{
	public function __construct() 
	{
    	$this->load->database();
  	}
	public function get_all_between($start, $end)
    {
        $this->db->where('start_date >=', $start);
        $this->db->where('end_date <=', $end);
		$this->db->where('idMonitor', $_SESSION['connect_monitor']);
        $query = $this->db->get('appointments');
        return $query->result_array();
    }
	
	
}