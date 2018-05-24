<?php

class BooksController {
	public function error() {
      global $current_dir;
      if(strpos($current_dir, 'views\pages'))
      {
          require_once('error.php');
      }else
        require_once('views\pages\error.php');

    }

	public function prompt($prompt_msg){
        echo("<script type='text/javascript'> var answer = prompt('".$prompt_msg."'); </script>");
    }

    public function ins_book(){
		
		global $info;
		$info = array();
		$title = $_POST['title'];
		$author = $_POST['autorcarte'];
		$isbn = $_POST['isbncarte'];
		$language = $_POST['taskOption'];
		$type = $_POST['gencarte'];
		$duration = $_POST['durata'];
		$description = $_POST['descriere'];
		$user_id = $_SESSION['id'];
		
    	if($_SERVER['REQUEST_METHOD'] === 'POST'){

    		switch ($language) {
    			case '1':
    				$limba = 'Romana';
    			break;
    			case '2':
    				$limba = 'Engleza';
    			break;
    			case '3':
    				$limba = 'Franceza';
    			break;
    			case '4':
    				$limba = 'Italiana';
    			break;
    			case '5':
    				$limba = 'Germana';
    			break;
			}
			
			array_push($info,$user_id, $title,$author, $isbn, $description,$type,$duration, $language);

			require_once("../../connection.php");
			require_once("../../models/book_modelling.php");
	  
			
			if(insertBook('book_wanted')){
    			echo "Inserted";
    		}
    		else{
    			echo "NAspa";
    		}
    	}


    }

}

?>