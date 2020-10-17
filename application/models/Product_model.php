<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model
{
    private function getProductColor($productID)
    {
        $this->db->select('c.name');
        $this->db->from('color c');
        $this->db->join('product_color pc', 'pc.color_id = c.id');
        $this->db->where('pc.product_id', $productID);
        $result = $this->db->get()->result_array();

        return array_map('current', $result);
    }

    public function getProduct()
    {
        $viennaID = 1;
        $queryString = "SELECT p.*, COUNT(*) AS color_matched_count, 
            CASE WHEN p.material_id = (
                SELECT material_id
                FROM product
                WHERE id = $viennaID
            ) THEN 1 ELSE 0 END AS material_matched_count
        FROM product p
        INNER JOIN product_color pc
            ON pc.product_id = p.id
        WHERE pc.color_id IN (
                SELECT color_id
                FROM product_color
                WHERE product_id = $viennaID
            )
            AND p.id <> $viennaID
            AND p.id NOT IN (
                SELECT product_id
                FROM seen_product
            )
        GROUP BY p.id
        ORDER BY material_matched_count DESC, color_matched_count DESC";

        $result = $this->db->query($queryString);

        if ($result->num_rows() == 0) {
            $this->truncateSeenProduct();
            return $this->getProduct($viennaID);
        }

        $product = $result->row();
        $product->colors = $this->getProductColor($product->id);

        $this->saveSeenProduct($product->id);

        return $product;
    }

    private function truncateSeenProduct()
    {
        $this->db->truncate('seen_product');
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