<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
    }

    public function index()
    {
        $data['product'] = $this->product_model->getProduct();

        $this->load->view('product_detail', $data);
    }
}
