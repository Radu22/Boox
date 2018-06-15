<?php 
   session_start();

    if (isset($_GET['controller']) && isset($_GET['action'])) {
        $controller = $_GET['controller'];
        $action     = $_GET['action'];
    } else {
        $controller = 'pages';
        $action     = 'reg';
    }

  require_once("../../routes.php");

?>