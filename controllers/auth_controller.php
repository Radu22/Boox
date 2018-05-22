<!-- 

    Login / Sign up validation

-->


<?php
class AuthController{
    public function signup(){
        header("Location: views/authsuccess.php?controller=auth&action=signup");
    }
    public function signin(){
        header("Location: views/authsuccess.php?controller=auth&action=signin");
    }
}


?>