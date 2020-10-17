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

        $product = $query->row();
        $product->colors = $this->getProductColor($productID);

        return $product;
    }

    private function getProductColor($productID)
    {
        $this->db->select('c.name');
        $this->db->from('color c');
        $this->db->join('product_color pc', 'pc.color_id = c.id');
        $this->db->where('pc.product_id', $productID);
        $result = $this->db->get()->result_array();

        return array_map('current', $result);
    }
}