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
      global $info;

      $db = Db::getInstance();
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $bookie = Book::getByTitle($table_name, $info[1]);
      if($bookie == NULL){

        $sql = "INSERT INTO ". $table_name . "(user_id,book_title,book_author , isbn, description,book_type,language, duration)
        VALUES ('".$info[0]."','".$info[1]."','".$info[2]."', '".$info[3]."','".$info[4]."','".$info[5]."', '".$info[6]."', '".$info[7]."')";

        if($db->query($sql)){
            unset($info);
            return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }

    public static function getBookID($book_title, $table_name){
        $db = Db::getInstance();
        $sql = "SELECT book_id from " . $table_name . " WHERE book_title='" . $book_title . "'";
        $req = $db->query($sql);
        return $req->fetch()["book_id"];

    }

    public static function getByTitle($table_name, $title){
      $db = Db::getInstance();
      $list = [];
      $sql = "SELECT * FROM " .  $table_name . " WHERE book_title='" . $title . "'";

      $req = $db->query($sql);
      foreach($req->fetchAll() as $post){
        $list[] = new Book($post['book_id'],$post['user_id'],$post['book_title'],$post['book_author'],$post['ISBN'],$post['book_type'],$post['duration'],$post['language'], $post['description']);
      }

      return $list;

    }

    public static function getCount($table_name){
      $db = Db::getInstance();
      $sql = "SELECT COUNT(*) FROM " . $table_name . " WHERE user_id = " . $_SESSION['id'];
      $req = $db->query($sql);
      $req = $req->fetch(PDO::FETCH_ASSOC);
      return $req['COUNT(*)'];
    }
    
    public static function getTotalCount(){
      $db = Db::getInstance();
      $sql1 = "SELECT COUNT(*) FROM book_added WHERE user_id = " . $_SESSION['id'];
      $sql2 = "SELECT COUNT(*) FROM book_wanted WHERE user_id = " . $_SESSION['id'];
      $req1 = $db->query($sql1);
      $req2 = $db->query($sql2);
      $req1 = $req1->fetch(PDO::FETCH_ASSOC);
      $req2 = $req2->fetch(PDO::FETCH_ASSOC);
      return $req1['COUNT(*)'] + $req2['COUNT(*)'];
    }

    public static function getBooksByUserID($table_name, $user_id){
      $db = Db::getInstance();
      $list = [];
      $sql = "SELECT * FROM " . $table_name . " WHERE user_id=" . $user_id;
      $req = $db->query($sql);

      foreach($req->fetchAll() as $post){
        $list[] = new Book($post['book_id'],$post['user_id'],$post['book_title'],$post['book_author'],$post['ISBN'],$post['book_type'],$post['duration'],$post['language'], $post['description']);
      }

      return $list;
    }

    public function fetchBooks(){
      $db = Db::getInstance();
      $list = [];
      $sql = $db->prepare('SELECT * FROM book_added WHERE user_id != :id');
      $sql->bindValue(":id", $_SESSION['id'] );
      $sql->execute();
      foreach($sql->fetchAll() as $post){
        $list[] = new Book($post['book_id'],$post['user_id'],$post['book_title'],$post['book_author'],$post['ISBN'],$post['book_type'],$post['duration'],$post['language'],$post['description']);

      }
      return $list;
    }

    public static function deleteByTitle($book_title, $table_name){
      $db = Db::getInstance();
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $bookie = Book::getByTitle($table_name, $book_title);
      if($bookie != NULL){

        $sql = "DELETE FROM " . $table_name . "  WHERE book_title='" . $book_title . "'";

      if($db->query($sql)){
            return true;
        }else{
          return false;
        }
      }
    }



  }

?>