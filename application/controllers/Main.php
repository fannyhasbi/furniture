<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    public function index()
    {
        $this->load->view('main');
    }

    public function product()
    {
        $this->load->model('product_model');
        $data['products'] = $this->product_model->getProducts();

        $this->load->view('product', $data);
    }

    public function productDetail($productID)
    {
        $this->load->model('product_model');
        $data['product'] = $this->product_model->getProductDetail($productID);

        var_dump($data['product']); die;

        $this->load->view('product_detail', $data);
    }
}
