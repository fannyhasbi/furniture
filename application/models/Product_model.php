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

    public function getSimilarProduct($productID)
    {
        $queryString = "SELECT p.*, COUNT(*) AS color_matched_count, 
            CASE WHEN p.material_id = (
                SELECT material_id
                FROM product
                WHERE id = $productID
            ) THEN 1 ELSE 0 END AS material_matched_count
        FROM product p
        INNER JOIN product_color pc
            ON pc.product_id = p.id
        WHERE pc.color_id IN (
                SELECT color_id
                FROM product_color
                WHERE product_id = $productID
            )
            AND p.id <> $productID
        GROUP BY p.id
        ORDER BY material_matched_count DESC, color_matched_count DESC";

        $result = $this->db->query($queryString);

        $product = $result->row();
        $product->colors = $this->getProductColor($productID);

        $this->saveSeenProduct($product->id);

        return $product;
    }

    private function saveSeenProduct($productID)
    {
        $data = array(
            'product_id' => $productID,
            'session_id' => 'sess123'
        );

        $this->db->insert('seen_product', $data);
    }
    
}