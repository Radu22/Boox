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

			switch ($type) {
    			case '1':
    				$tip = 'Arta, arhitectura si fotografie';
    			break;
    			case '2':
    				$tip = 'Biografii si memorii';
    			break;
    			case '3':
    				$tip = 'Business, economie, finante';
    			break;
    			case '4':
    				$tip = 'Carti pentru copii';
    			break;
    			case '5':
    				$tip = 'Dictionare si Enciclopedii';
				break;
				case '6':
    				$tip = 'Diete si fitness';
    			break;
				case '7':
    				$tip = 'Drept';
    			break;
				case '8':
    				$tip = 'Fictiune';
    			break;
				case '9':
    				$tip = 'Filosofie';
    			break;
				case '10':
    				$tip = 'Gastronomie';
    			break;
				case '11':
    				$tip = 'Ghiduri de calatorie, harti';
    			break;
				case '12':
    				$tip = 'Hobby, timp liber';
    			break;
				case '13':
    				$tip = 'Istorie';
    			break;
				case '14':
    				$tip = 'Limbi straine';
    			break;
				case '15':
    				$tip = 'Manuale si auxiliare scolare';
    			break;
				case '16':
    				$tip = 'Medicina';
    			break;
				case '17':
    				$tip = 'Parenting si familie';
    			break;
				case '18':
    				$tip = 'Psihologie, Pedagogie';
    			break;
				case '19':
    				$tip = 'Religie';
    			break;
				case '20':
    				$tip = 'Self Help';
    			break;
				case '21':
    				$tip = 'Sociologie, stiinte politice';
    			break;
				case '22':
    				$tip = 'Spiritualitate, ezoterism';
    			break;
				case '23':
    				$tip = 'Stiinte';
    			break;
			}

			array_push($info,$user_id, $title, $author, $isbn, $description,$tip,$duration, $limba);

			$image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); 
			$image_name = addslashes($_FILES['image']['name']);
			if(empty($image)){
				AuthController::prompt("You have to insert an image with the book as well");
			}else{
				if(Book::insertBook('book_added')){
					$id_book = Book::getBookID($title, "book_added");
					if(Image::insertImage($id_book, $image, $image_name)){
						header("Location: ../../views/pages/main.php?controller=pages&action=main");
						unset($info);
					}else{
						header("Location: ../../views/pages/error.php");
					}
				}
				else{
					header("Location: ../../views/pages/error.php");
				}
			}

    	}


    }

}

?>