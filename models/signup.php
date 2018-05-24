<?php

    function insert_user(){
        $db = Db::getInstance();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        global $required;

        $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd)
            VALUES ('".$required[0]."','".$required[1]."','".$required[2]."', '".$required[3]."','".$required[4]."')";
        
        if($db->query($sql)){
            $user = User::getUserByUsername($required[3]);
            $_SESSION['id']       = $user->id;
            $_SESSION['first']    = $required[0];
            $_SESSION['last']     = $required[1];
            $_SESSION['email']    = $required[2];
            $_SESSION['user']     = $required[3];
            $_SESSION['password'] = $required[4];
            return true;
        }else 
            return false;

    }

?>