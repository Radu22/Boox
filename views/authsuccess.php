
<p>You have

<?php
    $current_action = $_GET['action'];
    if($_GET['controller'] == 'auth'){
        if($current_action == 'signup'){
            echo 'signed up';
        }else
            if($current_action == 'signin')
                echo 'logged in';
        else
            require_once('pages/error.php');

    }else
        require_once('pages/error.php');


?>

successfully </p>


<?php  header("refresh:1;url=pages/main.php?controller=pages&action=main"); ?>