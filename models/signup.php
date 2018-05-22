<?php
    function insert_user(){
        $db = Db::getInstance();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd)
            VALUES ('".$name[0]."','".$name[1]."','".$email."', '".$username."','".$password."')";
        
        if($db->query($sql)){
            return true;
        }else 
            return false;

    }

?>