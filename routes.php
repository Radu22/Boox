<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {
      case 'pages':
        $controller = new PagesController();
      break;
      case 'auth':
        require_once('models/users.php');
        $controller = new AuthController();
      break;
    }

    $controller->{ $action }();
  }


  $controllers = array('pages' => ['reg', 'error', 'main', 'book', 'profile', 'contact'],
                       'auth'  => ['signup', 'signin']);  

  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('pages', 'error');
    }
  } else {
    call('pages', 'error');
  }
?>