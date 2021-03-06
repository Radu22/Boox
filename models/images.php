<?php
  class Image {

    public $id;
    public $book_id;
    public $picture;
    public $picture_name;

    public function __construct($id, $book_id, $picture, $picture_name) {
      $this->id           = $id;
      $this->book_id      = $book_id;
      $this->picture      = $picture;
      $this->picture_name = $picture_name;
    }

    public static function insertImage($book_id, $pic, $pic_name){
      $db = Db::getInstance();
      $stmt = $db->prepare("INSERT INTO IMAGE (book_ID, image, image_name) VALUES (?, ?, ?) ");

      $stmt->bindParam(1, $book_id);
      $stmt->bindParam(2, $pic, PDO::PARAM_LOB);
      $stmt->bindParam(3, $pic_name);

      if($stmt->execute()){
        return 1;
      }else{
        return 0;
      }
      
    }

    public static function insertPath($book_id, $path){

      $db = Db::getInstance();
      $lala = NULL;
      $stmt = $db->prepare("INSERT INTO IMAGE (book_ID, image, image_name) VALUES (?, ?, ?) ");

      $stmt->bindParam(1, $book_id);
      $stmt->bindParam(2, $lala, PDO::PARAM_LOB);
      $stmt->bindParam(3, $path);

      if($stmt->execute()){
        return 1;
      }else{
        return 0;
      }
      
    }
    public static function getPath($image_id){
      $db = Db::getInstance();
      $sql = "SELECT * FROM IMAGE WHERE id = $image_id" ;
      $req = $db->query($sql);
      $req = $req->fetch();
      return $req['image_name'];
    }

    public static function getImageID($book_id){
      $db = Db::getInstance();
      $sql = "SELECT id FROM IMAGE WHERE book_ID = $book_id" ;
      $req = $db->query($sql);
      $req = $req->fetch();
      return $req['id'];
    }

    public static function getImage($image_id){
        $db = Db::getInstance();
        $sql = "SELECT image FROM IMAGE WHERE id=:id";
        $query = $db->prepare($sql);
        $query->bindValue(":id", $image_id);
        $query->execute();
        
        $query->bindColumn(1, $data, PDO::PARAM_LOB);
        $query->fetch(PDO::FETCH_BOUND);

        return $data;
    }

    public static function deleteByBookID($book_id){
      $db = Db::getInstance();
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "DELETE FROM IMAGE WHERE book_ID=$book_id";

      if($db->query($sql)){
            return true;
        }else{
          return false;
        }
      
    }


  }

?>