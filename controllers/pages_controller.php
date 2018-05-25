<?php
  class PagesController {
    public function error() {
      require_once('views/pages/error.php');
    }

    public function main(){

    }
   
    public function book(){
      global $books;
      $_SESSION['count'] = Book::getCount();
      $books = Book::getBooksByUserID($_SESSION['id']);

   
    }

    public function reg(){

    }
    public function profile(){
  
    } 
    public function contact(){
 
    }
    public function add(){
    }


  }
?>