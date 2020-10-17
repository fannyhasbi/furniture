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
        $this->load->view('main');
    }

    public function product()
    {
        $data['products'] = $this->product_model->getProducts();

        $this->load->view('product', $data);
    }

    public function productDetail($productID)
    {
        $data['product'] = $this->product_model->getProductDetail($productID);
        $data['similar'] = $this->product_model->getSimilarProduct($productID);

        $this->load->view('product_detail', $data);
    }
}
