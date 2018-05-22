<!-- 

    Login / Sign up validation

-->


<?php

class AuthController{

    public function prompt($prompt_msg){
        echo("<script type='text/javascript'> var answer = prompt('".$prompt_msg."'); </script>");

        $answer = "<script type='text/javascript'> document.write(answer); </script>";
        return($answer);
    }


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
        $error = false;
        global $required;
        $required = array();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if(count($name) < 2){
                AuthController::prompt("Insert last name as well");
            }else{
                for($i = 0; $i < count($name); ++$i)
                {
                    if(isset($name[$i])){
                        array_push($required, $name[$i]);
                    }
                }
                array_push($required, $username, $email, $password);
                
                foreach($required as $req){
                    if(empty($req)){
                        $error = true;
                        break;
                    }
                }
                
                if($error){
                    AuthController::prompt("All fields are required");
                }else{
                    require_once("models/signup.php");
                    if(insert_user()){
                        header("Location: views/authsuccess.php?controller=auth&action=signup"); 
                    }else{
                        echo "sad story";
                    }
                }
            }
            
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