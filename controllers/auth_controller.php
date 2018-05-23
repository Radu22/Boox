<!-- 

    Login / Sign up validation

-->


<?php

class AuthController{

    public function prompt($prompt_msg){
        echo("<script type='text/javascript'> var answer = prompt('".$prompt_msg."'); </script>");
    }


    public function signup(){
        
/*
*       INPUT VALIDATION, THEN REDIRECT TO DB
*
*
*/
        // Getting data from form
        $name     = $_POST['name'];
        $username = $_POST['user_name'];
        $email    = $_POST['user_email']; 
        $password = $_POST['user_password'];
        
        // Splitting name to get first_name / last_name
        $name = explode(" ",$name);
        $error = false;
        // Array to be inserted into DB
        global $required;
        $required = array();
        
        // Check if data from form got sent
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            // We need first and also last name
            if(count($name) < 2){
                AuthController::prompt("Insert last name as well");
            }else{

                // Validate first and last name, they should contain only alpha chars
                for($i = 0; $i < count($name); ++$i)
                {
                    if(isset($name[$i])){
                        if(preg_match("/[0-9]/", $name[$i])){
                            AuthController::prompt("Only letters are allowed in first / last name");
                            exit();
                        }else
                            array_push($required, $name[$i]);
                    }
                }
                array_push($required, $email, $username, $password);
                
                // Check if input is empty
                foreach($required as $req){
                    if(empty($req)){
                        $error = true;
                        break;
                    }
                }
                
                if($error){
                    AuthController::prompt("All fields are required");
                    exit();
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