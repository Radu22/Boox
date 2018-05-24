<?php
   function insertBook($table_name) {
      $db = Db::getInstance();
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "insert into ". $table_name . "(book_title,book_type,book_author, isbn, description, language, duration, user_id )
          values ('$title','$type','$author', '$isbn','$description','$language', '$duration', '$user_id')";

      if($db->query($sql)){
          return true;
      }else{
        return false;
      }

    }

?>