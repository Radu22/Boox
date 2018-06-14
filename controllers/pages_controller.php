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

            global $info;
            $info = array();
            $title = $firstrow->getElementsByTagName('div')[$key]->getElementsByTagName('h2')[0]->textContent;
            $author = $firstrow->getElementsByTagName('div')[$key]->getElementsByTagName('h5')[0]->textContent;
             
            $isbn = 0;
            $language = '';
            $type = '';
            $duration = 0;
            $description = '';
            $user_id = $_SESSION['id'];

            array_push($info,$user_id, $title, $author, $isbn, $description, $type, $language, $duration);
            
            if(Book::insertBook('book_wanted')){
              header("Location: ../pages/main.php?controller=pages&action=main");
              unset($info);
            } else {
              header("Location: ../pages/error.php");
            }

          }
        }

        // Restore error level
        libxml_use_internal_errors($internalErrors);
    }
   
    public function book(){
      global $books;
      $_SESSION['count'] = Book::getCount();
      $books = Book::getBooksByUserID('book_added', $_SESSION['id']);

   
    }
    public function notif(){

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