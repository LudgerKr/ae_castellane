<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('event_model');
  }
  public function all()
  {
	  if (!empty($this->input->get('start')) && !empty($this->input->get('end'))) 
	  {
		$events = $this->event_model->get_all_between($this->input->get('start'), $this->input->get('end'));
		  
		$events_json = [];
		foreach ($events as $event)
		{
			$events_json[] = [
				'title' => $event['title'],
				'start' => $event['start_date'],
				'end' => $event['end_date']
			];
		}
		echo json_encode($events_json);
	  }
  }
}