
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book_detail extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Book_action');
    $this->load->helper('url_helper');
    $this->load->helper(array('form', 'url'));
  }
  
  public function books()
  { 
    header("Access-Control-Allow-Origin: *");
    $books = $this->Book_action->get_books();
    $this->output->set_content_type('application/json')->set_output(json_encode($books));
  
  }

  public function getBook($id)
  { 
    
    header('Access-Control-Allow-Origin: *');
   
    $bookData = $this->Book_action->get_book($id);

    $bookData = array(
      'id' => $book->id,
      'book_description' => $book->book_description,
      'book_title' => $book->book_title,
      'book_price' => $book->book_price,
      'book_description' => $book->book_description,
      'book' => $book->book
    );

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($bookData));
   }

  
   public function do_upload() {	
    header("Content-type:application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS");
    header("Access-Control-Allow-Headers: token, Content-Type");
    
    
    if(isset($_FILES["book"]["name"])) {
      $res = array();
      $name       = "book";
      $bookPath 	= "uploads/";
      // $temp       = explode(".",$_FILES["book"]["name"]);
      $filenew 	= $_FILES["book"]["name"];  		
      $config["file_name"]   = $filenew;
      $config["upload_path"] = $bookPath;
      $config = array(
        "upload_path" => $bookPath,
        "allowed_types" => "gif|jpg|png|jpeg|pdf",
        "file_name" => $filenew,
        "overwrite" => TRUE,
        "max_size" => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
        "max_height" => "768",
        "max_width" => "1024"
        );
      $this->load->library("upload",$config);
      $this->upload->do_upload("book");
      $this->upload->set_allowed_types("*");
      $this->upload->set_filename($config["upload_path"],$filenew);
      if(!$this->upload->do_upload("book")) {
        $data = array("msg" => $this->upload->display_errors());
        } else {
        $data = $this->upload->data();
        if(!empty($data["file_name"])){
          $res["book_url"] = "uploads/" .$data["file_name"]; 
          $bookName = $_POST["book_name"];
          $bookTitle = $_POST["book_title"];
          $bookPrice = $_POST["book_price"];
          $bookDescription = $_POST["book_description"];
          $book = "uploads/" .$data["file_name"];;

          $bookData = array(
            "book_name" => $bookName,
            "book_title" => $bookTitle,
            "book_price" => $bookPrice,
            "book_description" => $bookDescription,
            "book" => $book
          );

          $id = $this->Book_action->insert_book($bookData);
        }
        if (!empty($res) && isset($id)) {
    echo json_encode(
            array(
              "status" => 1,
              "data" => array(),
              "msg" => "upload successful",
              "base_url" => base_url(),
              "count" => "0"
            )
          );
        }else{
    echo json_encode(
            array(
              "status" => 1,
              "data" => array(),
              "msg" => "not found",
              "base_url" => base_url(),
              "count" => "0"
            )
          );
        }
      }
    }
  }


  public function updateBook($id)
  { 
    header("Content-type:application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS");
    header("Access-Control-Allow-Headers: token, Content-Type");

    $requestData = json_decode(file_get_contents('php://input'), true);

    if(!empty($requestData)) {

      $bookName = $requestData['book_name'];
      $bookTitle = $requestData['book_title'];
      $bookPrice = $requestData['book_price'];
      $bookDescription = $requestData['book_description'];
      // $book = $requestData['book'];
      
      $bookData = array(
        'book_name' => $bookName,
        'book_title' => $bookTitle,
        'book_price' => $bookPrice,
        'book_description' => $bookDescription,
        // 'book' =>$book
      );

      $id = $this->Book_action->update_book($id, $bookData);

      $response = array(
        'status' => 'success',
        'message' => 'book updated successfully.'
      );
    }
    else {
      $response = array(
        'status' => 'error'
      );
    }

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
  }

  public function deletebook($id)
  {
    header("Content-type:application/json");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    
    $book = $this->Book_action->delete_book($id);
    $response = array(
      'message' => 'book deleted successfully.'
    );

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
  }
}
?>