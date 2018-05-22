<?php
    function insert_user(){
        $db = Db::getInstance();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        global $required;

        $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd)
            VALUES ('".$required[0]."','".$required[1]."','".$required[2]."', '".$required[3]."','".$required[4]."')";
        
        if($db->query($sql)){
            return true;
        }else 
            return false;

    }

?>