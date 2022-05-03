
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book_action extends CI_model {
  
  public function get_books()
  {
    // $this->db->where('is_active', 1);
    $query = $this->db->get('books');
    return $query->result();
  }

  public function get_book($bookId)
  {
    $this->db->where('id', $bookId);
    $query = $this->db->get('books');
    return $query->row();
  }

  public function insert_book($bookData)
  {
    $this->db->insert('books', $bookData);
    return $this->db->insert_id();
  }

  public function update_book($bookId, $bookData)
  {
    $this->db->where('id', $bookId);
    $this->db->update('books', $bookData);
  }

  public function delete_book($bookId)
  {
    $this->db->where('id', $bookId);
    $this->db->delete('books');
    return true;
  }
}
?>