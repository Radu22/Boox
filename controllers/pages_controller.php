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


            $isbn = 0;
            $language = '';
            $type = '';
            $duration = 0;
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
      $_SESSION['count'] = Book::getCount('book_added');
      $books = Book::getBooksByUserID('book_added', $_SESSION['id']);


    }
    public function notification(){
      if(!empty($_POST['titlu_carte']) && !empty($_POST['user_to'])){
        Notification::insertNotification($_POST['titlu_carte'], $_POST['user_to']);
        header("Location: ../pages/notification.php?controller=pages&action=notification");
        // requice_once("../pages/notification.php?controller=pages&action=notification");
      }else{
        var_dump("No");
      }

      // if(!empty($_POST['titlu_carte']) && !empty($_POST['user_to'])){
      //     var_dump($_POST['titlu_carte']);
      //     var_dump($_POST['user_to']);
      
      // }

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