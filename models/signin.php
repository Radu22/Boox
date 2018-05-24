<?php

    function verifyUser($username,$password){
        $db = Db::getInstance();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(strpos($username, '@')){
            $user = User::getUserByEmail($username);
        }else{
            $user = User::getUserByUsername($username);
            if(!isset($user->username)){
                AuthController::prompt("username not found");
                exit();
            }
        }

        if($password !== $user->password){
            AuthController::prompt("password not found");
            exit();
        }else{
            if(!isset($user)){
                return false;
            }else{
                // start session

                $_SESSION['id']       = $user->id;
                $_SESSION['first']    = $user->firstname;
                $_SESSION['last']     = $user->lastname;
                $_SESSION['email']    = $user->email;
                $_SESSION['user']     = $username;
                $_SESSION['password'] = $password;
                return true;
            }
        }

    }

?>