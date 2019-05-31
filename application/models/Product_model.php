<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model{
    
    function __construct() {
        $this->proTable   = 'products';
        $this->transTable = 'payments';
        $this->load->database();
        
    }
     
    public function getRows($id = ''){
        $this->db->select('*');
        $this->db->from($this->proTable);
        $this->db->where('status', '1');
        if($id){
            $this->db->where('id', $id);
            $query  = $this->db->get();
            $result = $query->row_array();
        }else{
            $this->db->order_by('name', 'asc');
            $query  = $this->db->get();
            $result = $query->result_array();
        }
        // return fetched data
        return !empty($result)?$result:false;
    }
    public function get_paymentResult()
    {
    	$query = $this->db->get('result_payments');
    	return $query->result_array();
    }
	
    public function insertTransaction($data){
        $insert = $this->db->insert($this->transTable,$data);
        return $insert?true:false;
    }
    
}