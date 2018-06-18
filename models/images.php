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
      $sql = "INSERT INTO IMAGE (book_ID, image, image_name) VALUES (:book, :pic, :pic_name)";
      $req = $db->prepare($sql);
      $req->bindValue(":book", $book_id);
      $req->bindValue(":pic", $pic);
      $req->bindValue(":pic_name", $pic_name);
      if($req->execute()){
        return 1;
      }else{
        return 0;
      }
      
    }


  }

?>