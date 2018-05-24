<?php
  class PagesController {
    public function error() {
      global $current_dir;
      if(strpos($current_dir, 'views\pages'))
      {
          require_once('error.php');
      }else
        require_once('views\pages\error.php');
    
    }

    public function main(){
        echo 'blind shit';
    }
   
    public function book(){
        echo '<p>blind shit</p>';
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
      echo 'we are in add method';
    }


  }
?>