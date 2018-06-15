<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');

    require_once('connection.php');
    require_once('models/users.php');
    require_once('models/books.php');

    switch($controller) {
      case 'pages':
        $controller = new PagesController();
      break;
      case 'auth':
        $controller = new AuthController();
      break;
      case 'textbook':
        $controller = new BooksController();
      break;
    }

    $controller->{ $action }();
  }


  $controllers = array('pages' => ['reg', 'error', 'main', 'book', 'profile', 'contact', 'add', 'notification'],
                       'auth'  => ['signup', 'signin', 'edit'],
                       'textbook' => ['ins_book']
                     );

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