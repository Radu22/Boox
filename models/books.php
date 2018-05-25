<?php
  class Book {
    public $book_id;
    public $user_id;
    public $book_title;
    public $book_author;
    public $isbn;
    public $description;
    public $book_type;
    public $duration;
    public $language;

    public function __construct($book_id, $user_id, $book_title, $book_author, $isbn, $book_type, $duration, $language, $description = '') {
      $this->book_id = $book_id;
      $this->user_id = $user_id;
      $this->book_title = $book_title;
      $this->book_author= $book_author;
      $this->isbn= $isbn;
      $this->description = $description;
      $this->book_type = $book_type;
      $this->duration= $duration;
      $this->language =  $language;
    }

    public static function insertBook($table_name) {
       
      $db = Db::getInstance();
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      global $info;

      $sql = "INSERT INTO ". $table_name . "(user_id,book_title,book_author , isbn, description,book_type,duration, language)
          VALUES ('".$info[0]."','".$info[1]."','".$info[2]."', '".$info[3]."','".$info[4]."','".$info[5]."', '".$info[6]."', '".$info[7]."')";

      if($db->query($sql)){
          return true;
      }else{
        return false;
      }

    }

    public static function getCount(){
      $db = Db::getInstance();
      $sql = "SELECT COUNT(*) FROM book_added";
      $req = $db->query($sql);
      $req = $req->fetch(PDO::FETCH_ASSOC);
      return $req['COUNT(*)'];
    }

    public static function getBooksByUserID($user_id){
      $db = Db::getInstance();
      $list = [];
      $sql = "SELECT * FROM book_added WHERE user_id=" . $user_id;
      $req = $db->query($sql);

      foreach($req->fetchAll() as $post){
        $list[] = new Book($post['book_id'],$post['user_id'],$post['book_title'],$post['book_author'],$post['ISBN'],$post['book_type'],$post['duration'],$post['language'],$post['description']);
      }

      return $list;
    }

  }

?>