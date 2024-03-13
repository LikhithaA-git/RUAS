<?php
class Product_model extends CI_Model {
    public function insert_product($data) {
        return $this->db->insert('products', $data);
    }

    public function getAllMembers()
    {
        //$this->db->where(array('isActive'=>1,'isSubprofile'=>'')); //'isSubprofile'=>'' //new
         $this->db->order_by('id', 'desc');
        $query = $this->db->get('products');
        return $query->result();
    }
    
    public function update_product($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }
    public function getProductByID($id) {
        // Retrieve product details by ID from the "products" table
        $this->db->where('id', $id);
        $query = $this->db->get('products');

        // Check if a product with the given ID exists
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
    public function deleteProductByID($id) {
        // Delete the product from the "products" table based on the provided ID
        $this->db->where('id', $id);
        $this->db->delete('products');

        // Check if any rows were affected (product deleted)
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
