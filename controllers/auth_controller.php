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
        $name          = $_POST['name'];
        $username      = $_POST['user_name'];
        $email         = $_POST['user_email'];
        $password      = $_POST['user_password'];
        $phone_number  = $_POST['user_phone'];
        $phone_number = (int) $phone_number;

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
                exit();
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
                array_push($required, $email, $username, $password, $phone_number);

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
                        header("Location: views/pages/error.php");
                    }
                }
            }

        }


    }
    public function signin(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $username = $_POST['user_name'];
            $password = $_POST['user_password'];

            if(empty($username) || empty($password)){
                AuthController::prompt("Incomplete data");
                exit();
            }else{
                require_once("models/signin.php");
                if(verifyUser($username, $password)){
                    header("Location: views/authsuccess.php?controller=auth&action=signin");
                }else{
                    header("Location: views/pages/error.php");
                }
            }

        }
    }

        public function edit(){

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                if(isset($_POST['saving'])){
                    if(isset($_POST['username'])){
                        $username = $_POST['username'];
                    }
                    if(isset($_POST['email'])){
                        $email = $_POST['email'];
                    }
                    if(isset($_POST['notification'])){
                        $notification = $_POST['notification'];
                        $_SESSION['notif'] = $notification;
                    }
    
    
                    // Update username
                    if(!empty($username) ){
                        if(!User::updateUsername($username)){
                            AuthController::prompt("Username taken");
                        }
                    }

                    // Update email
                    if(!empty($email)){
                        if(strpos($email, '@')){
                            if(!User::updateEmail($email)){
                                AuthController::prompt("There is already an account associated with this email");
                            }
                        }else{
                            AuthController::prompt("You didn't write a valid email");
                        }
                    }
    
                    // Update notification
                    if(!empty($notification)){
                        if($notification == '2'){
                            $notification = '0';
                        }
                        if(!User::updateNotification($notification)){
                            AuthController::prompt("Error");
                        }
                    }
                    
                    // Update book duration for trading
                    if(isset($_POST['titlu']) && isset($_POST['duration'])){
                        $book_title = $_POST['titlu'];
                        
                        $dur        = $_POST['duration'];
                        $book = Book::getByTitleAndID('book_added', $book_title, $_SESSION['id']);
                
                        if(!Book::updateDuration($book_title, $dur, $_SESSION['id'])){
                            AuthController::prompt("update not successful");   
                        }
                    
                    }else{
                        AuthController::prompt("Data about book not provided");
                    }

                }else if($_POST['delete']){
                    require_once("../models/location.php");
                    // delete user's books
                        $status = Book::deleteByUserID('book_added', $_SESSION['id']);
                        if(!$status){
                            AuthController::prompt("error deleting book");
                            exit();
                        }

                        $status = Book::deleteByUserID('book_wanted', $_SESSION['id']);
                        if(!$status){
                            AuthController::prompt("error deleting book");
                            exit();
                        }
                    // delete user's notification
                        $status = Notification::deleteByUserID($user_id);
                        if(!$status){
                            AuthController::prompt("error deleting notification");
                            exit();
                        }
                    // delete user's location
                        $status = Location::deleteByUserID($user_id);
                        if(!$status){
                            AuthController::prompt("error deleting location");
                            exit();
                        }
                    // delete user
                    $status = User::deleteByUserID($user_id);
                    if(!$status){
                        AuthController::prompt("error deleting user");
                        exit();
                    }
                }

            }
        }
}
?>