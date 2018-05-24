<?php

    function verifyUser($username,$password){
        $db = Db::getInstance();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(strpos($username, '@') !== false ){
            $id = User::getIDbyEmail($username);
        }else{
            $id = User::getIDbyUsername($username);
        }

        if(empty($id)){
            return false;
        }else{
            //start session
            return true;
        }
    }

?>