<?php
  class Image {

    public $id;
    public $book_id;
    // public $pic;

    public function __construct() {


    }

    public static function insertBook($table_name) {
      global $info;

      $db = Db::getInstance();
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $bookie = Book::getByTitle($table_name, $info[1]);
      if($bookie == NULL){

        $sql = "INSERT INTO ". $table_name . "(user_id,book_title,book_author , isbn, description,book_type,duration, language)
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

    public static function getByTitle($table_name, $title){
      $db = Db::getInstance();
      $list = [];
      $sql = "SELECT * FROM " .  $table_name . " WHERE book_title='" . $title . "'";

      $req = $db->query($sql);
      foreach($req->fetchAll() as $post){
        $list[] = new Book($post['book_id'],$post['user_id'],$post['book_title'],$post['book_author'],$post['ISBN'],$post['book_type'],$post['duration'],$post['language'],$post['description']);
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

    public static function getBooksByUserID($table_name, $user_id){
      $db = Db::getInstance();
      $list = [];
      $sql = "SELECT * FROM " . $table_name . " WHERE user_id=" . $user_id;
      $req = $db->query($sql);

      foreach($req->fetchAll() as $post){
        $list[] = new Book($post['book_id'],$post['user_id'],$post['book_title'],$post['book_author'],$post['ISBN'],$post['book_type'],$post['duration'],$post['language'],$post['description']);
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

    

  }

?>