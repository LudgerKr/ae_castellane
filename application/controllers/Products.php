<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller{
    
    function  __construct(){
        parent::__construct();     
        // Load paypal library & product model
        $this->load->library('paypal_lib');
        $this->load->model('product_model');

    }
     
    function index(){
        $data = array();
        
        // Get products data from the database
        $data['products'] = $this->product_model->getRows();
        
        // Pass products data to the view
        $this->load->view('pages/boutique', $data);
    }
    
    function buy($id){
        // Set variables for paypal form
        $returnURL = base_url().'paypal/success';
        $cancelURL = base_url().'paypal/cancel';
        $notifyURL = base_url().'paypal/ipn';
        
        // Get product data from the database
        $product = $this->product_model->getRows($id);
        
        // Get current user ID from the session
        if(empty($_SESSION['userid']))
        {
        // Add fields to paypal form
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $product['name']);
        $this->paypal_lib->add_field('item_number',  $product['id']);
        $this->paypal_lib->add_field('amount',  $product['price']);
        
        // Render paypal form
        $this->paypal_lib->paypal_auto_form();
        }
        else
        {
        // Add fields to paypal form
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $product['name']);
        $this->paypal_lib->add_field('custom', $_SESSION['userid']);
        $this->paypal_lib->add_field('item_number',  $product['id']);
        $this->paypal_lib->add_field('amount',  $product['price']);
        
        // Render paypal form
        $this->paypal_lib->paypal_auto_form();
        }
    }
}