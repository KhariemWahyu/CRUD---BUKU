<?php
class Book_model extends CI_model{
    public $table = 'books';
    
    public function book_add($data){
        $this->db->insert($this->table, $data);
    }
    public function get_all_books(){ 
        $query = $this->db->get('books');
        return $query->result();
    }
    public function get_by_id(){
        $this->db->from($this->table);
        $this->db->where('book_id', $id);
        $query = $this->db->get();

        return $query->row(); 
    }
    public function book_update($where, $data){
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
    public function delete_by_id($id){
        $this->db->where('book_id', $id);
        $this->db->delete($this->table);
 }

}