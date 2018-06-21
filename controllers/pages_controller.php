<?php
  class PagesController {
  
    
    public function error() {
      require_once('views/pages/error.php');
    }

    public function fetchbook($title){
      $books = array();
      $xml = simplexml_load_string(file_get_contents('https://www.goodreads.com/search/index.xml?key=ZgkIb7fl4IAwJRVKwf9A&q=' . $title));
      $total        = $xml->search->results->work;

      for($i = 0; $i < count($total); ++$i){
          $title        = $xml->search->results->work[$i]->best_book->title;
          $author_name  = $xml->search->results->work[$i]->best_book->author->name;
          $img_url      = $xml->search->results->work[$i]->best_book->image_url;

          $new_input = array(
              'title'   => $title,
              'author'  => $author_name,
              'img_src' => $img_url
          );
          array_push($books, $new_input);
      }

      return $books;
    }

    public function main(){

      User::setLoggedTime($_SESSION['LAST_ACTIVITY']);
      // set error level
        $internalErrors = libxml_use_internal_errors(true);

        global $fetching_for_file, $book_list;
        $book_list = array();

        if(!empty($_POST['search'])){

          $title_of_the_book = $_POST['search'];
          if(!User::insertSearch($title_of_the_book)){
              AuthController::prompt("errors searching");
              die;
          }else{
              $book_list = $this->fetchbook($title_of_the_book);
          }
        }

        $fetching_for_file = Book::fetchBooks();
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

          if(current($_POST) == 'Wanted'){
            $html = file_get_contents('template.php');
            $count = 0;


            if(!empty($fetching_for_file)){
              foreach($fetching_for_file as $f){
                  $html .= '<div class="card">
                                <h2>' . $f->book_title . ' </h2>
                                <div class="want"><input type="submit" value="Wanted" name="WANT' . $count . '"> </div>
                                <br><br><br><br>
                                <h5>' . $f->book_author . '</h5>
                                <div class="fakeimg">
                                      ' . $f->description . '
                                </div>
                                <div style="display:none">
                                    ' . $f->book_type . '
                                </div>
                                <div style="display:none">
                                    ' . $f->language . '
                                </div>
                                <div style="display:none">
                                    ' . $f->duration . '
                                </div>
                                <div style="display:none">
                                    ' . $f->isbn . '
                                </div>
                            </div>';
                  $count+=3;
               }
             }
             $book_list = $this->fetchbook(User::getLastSearch());

            if(!empty($book_list)){
                foreach($book_list as $bookie){
                    $html .= '<div class="card">
                                <h2>' . $bookie["title"] . ' </h2>
                                <div class="want"><input type="submit" value="Wanted" name="WANT' . $count . '"> </div>
                                <br><br><br><br>
                                <h5>' . $bookie["author"] . '</h5>
                                <div class="fakeimg">
                                    <img src="' . $bookie["img_src"] . '">
                                </div>
                          </div>';
                      $count+=3;
                }
            }


            $dom = new domDocument;
            $dom->loadHTML($html);
            /*** discard white space ***/
            $dom->preserveWhiteSpace = false;

            $form = $dom->getElementsByTagName('form')[2];
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
            
            $description  = $firstrow->getElementsByTagName('div')[$key]->getElementsByTagName('div')[1]->textContent;
            $type         = $firstrow->getElementsByTagName('div')[$key]->getElementsByTagName('div')[2]->textContent;
            $language     = $firstrow->getElementsByTagName('div')[$key]->getElementsByTagName('div')[3]->textContent;
            $duration     = $firstrow->getElementsByTagName('div')[$key]->getElementsByTagName('div')[4]->textContent;
            $duration   = (int) $duration;
            $isbn         = $firstrow->getElementsByTagName('div')[$key]->getElementsByTagName('div')[5]->textContent;
            $isbn = (int) $isbn;
            if($firstrow->getElementsByTagName('div')[$key]->getElementsByTagName('div')[1]->getElementsByTagName('img')[0] != NULL){
                $image_path = $firstrow->getElementsByTagName('div')[$key]->getElementsByTagName('div')[1]->getElementsByTagName('img')[0]->getAttribute('src');
              }

            $user_id = $_SESSION['id'];


            array_push($info,$user_id, $title, $author, $isbn, $description, $type, $language, $duration);
  
            if(Book::insertBook('book_wanted')){
              $id_book = Book::getBookID($title, "book_wanted");
              if(!empty($image_path)){
                  if(!Image::insertPath($id_book, $image_path)){
                    header("Location: ../pages/error.php");
                }
              }
                
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
      require_once("auth_controller.php");
      global $books_for_lease, $books_wanted;
      $_SESSION['count_total'] = Book::getTotalCount();
      $_SESSION['count_added'] = Book::getCount('book_added');
      $_SESSION['count_wanted'] = Book::getCount('book_wanted');
      $books_for_lease = Book::getBooksByUserID('book_added', $_SESSION['id']);
      $books_wanted = Book::getBooksByUserID('book_wanted', $_SESSION['id']);

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          if(isset($_POST['submit'])){
            $book_title = $_POST['del'];
            $tables_to_search = array(
                'book_added'  => Book::getByTitle('book_added', $book_title),
                'book_wanted' => Book::getByTitle('book_wanted', $book_title)
            );
            
            if(empty($tables_to_search['book_added']) && !empty($tables_to_search['book_wanted'])){
                $id_book = Book::getByTitle('book_wanted', $book_title)[0]->book_id;
                if(!empty($id_book)){
                    $status = Book::deleteByTitle($book_title, 'book_wanted');
                    $status2 = Image::deleteByBookID($id_book);
                    if(!$status || !$status2){
                        AuthController::prompt("not working wanted deletion");
                        header("Location: ../pages/error.php");
                    }else{
                        header("Location: ../pages/book.php?controller=pages&action=book&types=total");
                    }
                }
            }else if(!empty($tables_to_search['book_added']) && empty($tables_to_search['book_wanted'])){
                    $id_book = Book::getByTitle('book_added', $book_title)[0]->book_id;
                    if(!empty($id_book)){
                        $status = Book::deleteByTitle($book_title, 'book_added');
                        $status2 = Image::deleteByBookID($id_book);
                        if(!$status || !$status2){
                            AuthController::prompt("not working added deletion");
                            header("Location: ../pages/error.php");
                        }else{
                            header("Location: ../pages/book.php?controller=pages&action=book&types=total");
                        }
                    }
                }
            else if(!empty($tables_to_search['book_added']) && !empty($tables_to_search['book_wanted'])){
                $id_book1 = Book::getByTitle('book_added',  $book_title)[0]->book_id;
                $id_book2 = Book::getByTitle('book_wanted', $book_title)[0]->book_id;
                    if(!empty($id_book1) && !empty($id_book2)){
                        $status = Book::deleteByTitle($book_title, 'book_added');
                        $status2 = Book::deleteByTitle($book_title, 'book_wanted');
                        $status3 = Image::deleteByBookID($id_book);
                        if(!$status || !$status2 || !$status3){
                            AuthController::prompt("not working both deletion");
                            header("Location: ../pages/error.php");
                        }else{
                            header("Location: ../pages/book.php?controller=pages&action=book&types=total");
                        }
                    }
            }else if(empty($tables_to_search['book_added']) && empty($tables_to_search['book_wanted'])){
                    AuthController::prompt("cant delete book, it doesnt exist");
            }
        } 
      }

    }
    public function notification(){

    //luam toate notificarile utilizatorului din sesiune
    $db = Db::getInstance();
    $req = $db->prepare('SELECT * FROM notification WHERE user_to = :id' );
    $req->bindValue(":id", $_SESSION['id'] );
	$req->execute();
    echo '<form action="../pages/notification.php?controller=pages&action=notification" method="post">';
    
    $count_trade = 0;
    $count_accept = 0;
    foreach($req->fetchAll() as $notif){
    	
    	//daca notificarea este de tip accepted
    	if($notif['type']=="accepted"){

    		$sql = $db->prepare('SELECT * FROM trade where user_id1 =:id');
    		$sql->bindValue(":id", $notif["user_to"]);
			$sql->execute();
			foreach ($sql->fetchAll() as $carte_acceptata) {

    			echo '<div id = "card" >';
				echo "<h4><b>Tu ai acceptat urmatoarea oferta de trade: </b></h4>";
				echo "<p>Cartea: ". $carte_acceptata['book_title2'] . " pentru " . $carte_acceptata['book_title1'] . "</p>";
				echo '</div>';
			}

    		$sql = $db->prepare('SELECT * FROM trade where user_id1 =:id');
    		$sql->bindValue(":id", $notif["user_from"]);
			$sql->execute();
			$carte_acceptata = $sql->fetchAll();
				//accesam informatiile celui care a acceptat trade-ul
				$l = $db->prepare('SELECT * FROM users WHERE user_id = :id');
			    $l->bindValue(":id", $notif['user_to']);
				$l->execute();
				$user_accepted = $l->fetch();
				foreach($carte_acceptata as $a) 
				{
								//afisam cardul de notificare accept trade
				echo '<div id = "card" >';
					echo "<h4><b>" . $user_accepted['user_first'] . " a acceptat oferta ta de trade: </b></h4>";
					echo "<p>Cartea: ". $a['book_title1'] . " pentru " . $a['book_title2'] . "</p>";
					echo "<p>Adresa de email: " . $user_accepted['user_email'] . " pentru a intra in contact cu " . $user_accepted['user_first'] . "</p>";
				echo '</div>';

				}

    		}

    		
			
    	}
  		

		//daca notificarea este de tipul trade
        if($notif['type']=="trade"){

        	//accesam informatiile cartii requested
			$ql = $db->prepare('SELECT * FROM book_added WHERE book_id = :id');
		    $ql->bindValue(":id", $notif['book_id_to']);
			$ql->execute();
			$carte_requested = $ql->fetch();

        	//accesam informatiile cartii de schimb
			$sql = $db->prepare('SELECT * FROM book_added WHERE book_id = :id');
		    $sql->bindValue(":id", $notif['book_id_from']);
			$sql->execute();
			$carte_de_schimb = $sql->fetch();

			//accesam informatiile userului care cere trade-ul
			$l = $db->prepare('SELECT * FROM users WHERE user_id = :id');
		    $l->bindValue(":id", $notif['user_from']);
			$l->execute();
			$user_request = $l->fetch();


			//afisam cardul de notificare pentru request trade
			$count_accept++;
            echo '<div id = "card" >';
                echo "<h4><b>" . $user_request['user_first'] . " ofera la schimb ". $carte_de_schimb['book_title'] ." pentru ". $carte_requested['book_title'] . "</b></h4>";
                echo "<p>Informatiile cartii oferite spre schimb:</p>";
	          	echo "<p>Autor: ". $carte_de_schimb['book_author'] . "</p>";
	          	echo "<p>ISBN: ". $carte_de_schimb['ISBN'] . "</p>";
	            echo "<p>Limba: ". $carte_de_schimb['language'] . "</p>";
	            echo "<p>Descriere: " . $carte_de_schimb['description'] . "</p/>";
	            echo '<input type="text" name="user_to_a' . $count_accept . '" class="titlu" value=' . $user_request['user_id'] . '>';
		        echo '<input type="text" name="id_accepted_book' . $count_accept . '" class="titlu" value=' . $carte_de_schimb['book_id'] . '>';
		        echo '<input type="text" name="id_carte_schimbata' . $count_accept . '" class="titlu" value=' . $carte_requested['book_id'] . '>';
	            echo '<input type="submit" name="accept" value="accept' . $count_accept .  '" style="font-size:20px;">';
            echo "</div>";
        	
        }

        //daca notificare este de tip locatie
        if($notif['type']=="location"){

        	//verificam ca notificarea sa fie in ultima ora
        	$data = strtotime($notif['last_update']);
            $data_curenta = strtotime(date("Y-m-d H:i:s"));
            $diferenta = round(($data_curenta - $data)/3600);

            if($diferenta < 2){

            	//luam toate cartile utilizatorului care este in apropriere
		    	$id = $notif['user_from'];
		    	$sql = $db->prepare('SELECT * FROM book_added WHERE user_id = :id');
		    	$sql->bindValue(":id", $id);
				$sql->execute();

            	foreach($sql->fetchAll() as $book){

            		//luam numele utilizatorului din apropriere
	            	$ql = $db->prepare('SELECT * FROM users WHERE user_id = :id');
	            	$ql->bindValue(":id", $book['user_id']);
	            	$ql->execute();
	            	$result = $ql->fetch();
	            	$nume = $result['user_first'];

	            	//afisam fiecare carte pe care o are utilizatorul
	            	echo '<div id = "card" >';
	               		echo "<h4><b>" . $nume . " este la mai putin de 5 km distanta si are la trade:</b></h4> ";
	                	echo "<p>Titlu: ". $book['book_title'] . "</p>";
	                	echo "<p>Autor: ". $book['book_author'] . "</p>";
	                	echo "<p>ISBN: ". $book['ISBN'] . "</p>";
	                	echo "<p>Limba: ". $book['language'] . "</p>";
	                	echo "<p>Descriere: " . $book['description'] . "</p/>";

		               	$count_trade++;
		                echo '<input type="text" name="user_to' . $count_trade . '" class="titlu" value=' . $id . '>';
		                echo '<input type="text" name="id_requested_book' . $count_trade . '" class="titlu" value=' . $book['book_id'] . '>';
		                if(Book::getCount('book_added') == 0){
		                    echo '<p> You don\'t have any books to trade</p>';
		                }else
		                {	
		                	echo '<h3>Alege carte pe care vrei sa o dai la schimb: </h3>' ;
		                	echo "<select name = carte_de_schimb" . $count_trade ." > ";
		                		$lista_carti = Book::getBooksByUserID("book_added", $_SESSION['id']);		
		                		foreach ($lista_carti as $carte) {
		                			echo "<option value=".$carte->book_id.">". $carte->book_title . "</option>";
		                		}
		                	echo "</select>";
		                	echo "<br>";
		                	echo "<br>";
		                    echo '<input type="submit" name="trade" value="trade' . $count_trade .  '" style="font-size:20px;">';
		                }
	            	echo "</div>";
        		}
        	}        
    	}
	
	echo '</form>';


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
  	
  	//verificam ce tip de buton sa apasat
  		if(isset($_POST['trade'])){
	   	    $number = substr($_POST['trade'], 5);

	        if(!empty($number)){
	            $userish = 'user_to' . $number;
	            $requested_book = 'id_requested_book' . $number;
	            $carte_schimb = 'carte_de_schimb' . $number;
	        }
	    	if(!empty($_POST[$requested_book]) && !empty($_POST[$userish]) && !empty($_POST[$carte_schimb])){
	        	Notification::insertTradeNotification($_POST[$userish], $_POST[$requested_book], $_POST[$carte_schimb]);
	        	//header("Location: ../pages/notification.php?controller=pages&action=notification");
      		}
      	}
      	if(isset($_POST['accept'])){
      		$number = substr($_POST['accept'], 6);
      		if(!empty($number)){
	            $userish = 'user_to_a' . $number;
	            $carte_ap_schimb = 'id_accepted_book' . $number;
	            $carte_schimbata = 'id_carte_schimbata' . $number;
	        }
	        if(!empty($_POST[$userish]) && !empty($_POST[$carte_ap_schimb]) && !empty($_POST[$carte_schimbata])){
	        	Notification::insertAcceptNotification($_POST[$userish],$_POST[$carte_ap_schimb],$_POST[$carte_schimbata]);
	        	//header("Location: ../pages/notification.php?controller=pages&action=notification");
	        }

      	}
    }
}


    public function logout(){
      $users = User::all();

      $names = array();
      $log_times = array();

      foreach($users as $user){
            array_push($names, $user->firstname);
            array_push($log_times, $user->logged_time);
      }
        

      $file = "../../data.tsv";
      $current = file_get_contents($file);
      for($i = 0; $i < count($names); ++$i){
        
        if($log_times[$i] != NULL){
            $current .= "\n" . (string) $names[$i] . "	.0" . (string)$log_times[$i];
        }

      }
      
      file_put_contents($file, $current);

      session_unset();
      session_destroy();
      $_SESSION = array();
   
      header("Location: /Boox");
      
    }
    public function add(){
      
    
    
    }
   
   
   
   
   
   
   
   
    public function reg(){

    }
    public function profile(){

    }
    public function contact(){

    }
  


  }
?>