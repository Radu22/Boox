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

    public static function all(){
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM IMAGE');

      foreach($req->fetchAll() as $post) {
        $list[] = new Image($post['id'], $post['book_ID'], $post['image'],$post['image_name']);
      }

      return $list;
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


  }

?>