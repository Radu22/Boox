<?php
  class PagesController {
    public function error() {
      require_once('views/pages/error.php');
    }

    public function main(){
        // set error level
        $internalErrors = libxml_use_internal_errors(true);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
          if(current($_POST) == 'Wanted'){
            $html  = file_get_contents('main.php');  

            $dom = new domDocument; 
            $dom->loadHTML($html); 
            /*** discard white space ***/ 
            $dom->preserveWhiteSpace = false; 

            $form = $dom->getElementsByTagName('form')[1];
            $firstrow = $form->getElementsByTagName('div')[0];
            if(strlen(key($_POST)) == 6 ){
              $key = substr(key($_POST), strlen(key($_POST)) - 2);  
            }else{
              $key = substr(key($_POST), strlen(key($_POST)) - 1);
            }
            $key = (int) $key;

            // var_dump("Title: ");
            // var_dump($firstrow->getElementsByTagName('div')[$key]->getElementsByTagName('h2')[0]->textContent);
            // var_dump("Author: ");
            // var_dump($firstrow->getElementsByTagName('div')[$key]->getElementsByTagName('h5')[0]->textContent);
            
          }
        }

        // Restore error level
        libxml_use_internal_errors($internalErrors);
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