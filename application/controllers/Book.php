<?php
class Book extends CI_Controller{
    public function __contruct(){
        parent:: __contruct();
    }
    public function index(){
        $this->load->model('Book_model');

         $data['books'] = $this->Book_model->get_all_books();

        $this->load->view('book_view', $data);
    }

    // untuk menginputkan data ke database 
    public function book_add(){
        $data = array(
            'book_isbn' => $this->input->post('book_isbn'),
            'book_title' => $this->input->post('book_title'),
            'book_author' => $this->input->post('book_author'),
            'book_category' => $this->input->post('book_category'),
        );

        $insert = $this->db->insert('books', $data); 
        if($insert){
            echo "Berhasil";
        }
        else{
            echo "Gagal ";
        }
    }
    // public function ajax_edit($id){
    //         $data = $this->Book_model->get_by_id($id);
    //         echo json_encode($data);
    //  }

    public function ajax_edit($id){
        $data = $this->db->get_where('books', ['book_id' => $id])->row();
        echo json_encode($data);
    }
    public function book_update(){
        $data = array(
            'book_isbn' => $this->input->post('book_isbn'),
            'book_title' => $this->input->post('book_title'),
            'book_author' => $this->input->post('book_author'),
            'book_category' => $this->input->post('book_category'),
        );
        
        $this->db->where('book_id', $this->input->post('book_id'));
        $update = $this->db->update('books', $data);

        if($update){
            echo "Berhasil";
        }
        else{
            echo "Error";
        }
    } 
    public function book_delete(){
        $this->db->delete('books', ['book_id' => $this->input->post('book_id')]);
            echo json_encode(array("status " => TRUE)); 
        }
    }
    