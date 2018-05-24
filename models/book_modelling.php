<?php


    function insertBook($table_name) {
       
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

?>