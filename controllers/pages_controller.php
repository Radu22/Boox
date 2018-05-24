<?php
  class PagesController {
    public function error() {
      global $current_dir;
      if(strpos($current_dir, 'views/pages'))
      {
          require_once('error.php');
      }else
        require_once('views/pages/error.php');
    
    }

    public function main(){
    }
   
    public function book(){
      $posts = Book::getBooksByUserID($_SESSION['id']);

    }
    public function reg(){

    }
    public function profile(){
      echo 'HI PROFILE';
    } 
    public function contact(){
      echo 'contact us';
    }
    public function add(){
    }


  }
?>