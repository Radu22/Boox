<!-- 

    Login / Sign up validation

-->


<?php

class AuthController{

    public function signup(){
        
/*
*       INPUT VALIDATION, THEN REDIRECT TO DB
*
*
*/
        $name     = $_POST['name'];
        $username = $_POST['user_name'];
        $email    = $_POST['user_email']; 
        $password = $_POST['user_password'];
        $name = explode(" ",$name);

        require_once("models/signup.php");

        if(insert_user()){
            header("Location: views/authsuccess.php?controller=auth&action=signup"); 
        }else{
            echo "sad story";
        }

    }
    public function signin(){
        //                  \/\/\/\/\/\/\/\/\/\/

        // vreau sa fiu implementat de catre bernard, altfel nu voi functiona


        //          ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
        // Ia-te dupa signup, faci functie de signin, ca sa fie separat de controller

        header("Location: views/authsuccess.php?controller=auth&action=signin");
    }
}


?>