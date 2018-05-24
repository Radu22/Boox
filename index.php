<?php
    session_start();

    // require_once('connection.php');
    
    if (isset($_GET['controller']) && isset($_GET['action'])) {
        $controller = $_GET['controller'];
        $action     = $_GET['action'];
      } else {
        $controller = 'pages';
        $action     = 'reg';
      }
      


      require_once('views/register.php');
?>