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
                                     ' .  $f->description . '
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

            //   var_dump($firstrow->getElementsByTagName('div')[$key]->getElementsByTagName('img')->textContent);


            // die;

            global $info;
            $info = array();


            $title = $firstrow->getElementsByTagName('div')[$key]->getElementsByTagName('h2')[0]->textContent;
            $author = $firstrow->getElementsByTagName('div')[$key]->getElementsByTagName('h5')[0]->textContent;

            // if for img check null

            $description = $firstrow->getElementsByTagName('div')[$key]->getElementsByTagName('div')[1]->textContent;
            if($firstrow->getElementsByTagName('div')[$key]->getElementsByTagName('div')[1]->getElementsByTagName('img')[0] != NULL){
                $image_path = $firstrow->getElementsByTagName('div')[$key]->getElementsByTagName('div')[1]->getElementsByTagName('img')[0]->getAttribute('src');

              }

            $isbn = 0;
            $language = '';
            $type = '';
            $duration = 0;
            $user_id = $_SESSION['id'];

            array_push($info,$user_id, $title, $author, $isbn, $description, $type, $duration, $language);

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
      global $books_for_lease, $books_wanted;
      $_SESSION['count_total'] = Book::getTotalCount();
      $_SESSION['count_added'] = Book::getCount('book_added');
      $_SESSION['count_wanted'] = Book::getCount('book_wanted');
      $books_for_lease = Book::getBooksByUserID('book_added', $_SESSION['id']);
      $books_wanted = Book::getBooksByUserID('book_wanted', $_SESSION['id']);

    }
    public function notification(){
    $db = Db::getInstance();
    $req = $db->prepare('SELECT * FROM notification WHERE user_to = :id and seen = :val_seen' );
    $req->bindValue(":id", $_SESSION['id'] );
    $req->bindValue(":val_seen", 1 );
	  $req->execute();
    echo '<form action="../pages/notification.php?controller=pages&action=notification" method="post">';
    
    $count = 0;
    foreach($req->fetchAll() as $notif){
    	$id = $notif['user_from'];
    	$sql = $db->prepare('SELECT * FROM book_added WHERE user_id = :id');
    	$sql->bindValue(":id", $id);
		  $sql->execute();

        if(substr($notif['type'],0,5)=="trade"){
            foreach($sql->fetchAll() as $book){
                $ql = $db->prepare('SELECT user_first FROM users WHERE user_id = :id');
                $ql->bindValue(":id", $book['user_id']);
                $ql->execute();
                $result = $ql->fetch();
                $nume = $result['user_first'];
                echo "<div class= card>";
                    echo "<h3>" . $nume . " wants to trade <b>". $book['book_title'] ."</b> for</h3>";
                    echo '<p>'. substr($notif['type'],5) ." </p> ";

                echo "</div>";
        }

        }else{
            foreach($sql->fetchAll() as $book){

            $ql = $db->prepare('SELECT user_first FROM users WHERE user_id = :id');
            $ql->bindValue(":id", $book['user_id']);
            $ql->execute();
            $result = $ql->fetch();
            $nume = $result['user_first'];


            echo "<div class= card>";
                echo "<h4><b>" . $nume . " is less then 5 km away and has this for trade:</b></h4> ";
                echo "<p>Titlu: ". $book['book_title'] . "</p>";
                echo "<p>ISBN: ". $book['ISBN'] . "</p>";
                echo "<p>Limba: ". $book['language'] . "</p>";

                $count++;
                echo '<input type="text" name="user_to' . $count . '" class="titlu" value=' . $id . '>';
                echo '<input type="text" name="titlu_carte' . $count . '" class="titlu" value=' . $book['book_title'] . '>';
                if(Book::getCount('book_added') == 0){
                    echo '<p> You don\'t have any books to trade</p>';
                }else
                {
                    echo '<input type="submit" name="trade" value="trade' . $count .  '" style="font-size:20px;">';
                }

            echo "</div>";
        }
      }



	}
	echo '</form>';


      if($_SERVER['REQUEST_METHOD'] === 'POST'){
  
        $number = substr($_POST['trade'], -1);
        if(!empty($number)){
            $title = 'titlu_carte' . $number; 
            $userish = 'user_to' . $number;
        }
        
      if(!empty($_POST[$title]) && !empty($_POST[$userish])){
        Notification::insertNotification($_POST[$userish], $_POST[$title] );
        header("Location: ../pages/notification.php?controller=pages&action=notification");
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