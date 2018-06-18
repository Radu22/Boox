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
        $count = 0;

        global $book_list;
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="../../content/css/footer.css">
        <link rel="stylesheet" href="../../content/css/header.css">
        <link rel="stylesheet" href="../../content/css/mainpage.css">
    </head>
    <body>

      <?php require_once("../header_main.php");?>

        <div class="rand">
            <div class="leftcolumn">
                <form class="searchBook clearfix">
                  <input type="text" placeholder="Search books here" title="Search books here" id="filter"
                     onkeyup="getFiltered()">
                </form>


              <div class="addButton">
                <a href="add_book.php?controller=pages&action=add"><button class="button">Adauga Carte</button></a>
              </div>
           </div>

         <div class="filtercol">
              <form class="goodreads" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>?controller=pages&action=main">
                <input type="text" placeholder="Search goodreads" name="search" title="Search goodreads" id="goodr">
                <button id="click" type="submit"><i class="fa fa-search"></i></button>              
              </form>
          </div>

          <div class="rightcolumn clearfix">
          <form id="wishes" action="<?php echo $_SERVER["PHP_SELF"]; ?>?controller=pages&action=main" method="post">
              <div class="firstrow">
                 <!-- 0 -->
                        