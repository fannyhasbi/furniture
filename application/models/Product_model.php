<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    public function getProducts()
    {
        $query = $this->db->get('product');

        return $query->result();
    }

    public function getProductDetail($productID)
    {
        $query = $this->db->get_where('product', ['id' => $productID]);

        return $query->row();
    }
}