<?php 
	session_start();
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

      <?php require_once('../header_main.php');?>

        <div class="rand">
            <div class="leftcolumn">
                <form class="searchBook" >
                  <input type="text" placeholder="Search for books" name="search2" title="Search for books" id="filter"
                     onkeyup="getFiltered()">
                  <button type="submit"><i class="fa fa-search"></i></button>
                </form>


              <div class="addButton">
                <a href="add_book.php?controller=pages&action=add"><button class="button">Adauga Carte</button></a>
              </div>
           </div>

          <div class="rightcolumn">
            <div class="firstrow">
                 <div class="card">
                    <h2>Crime and punishment</h2>
                    <h5>Fyodor Dostoyevsky</h5>
                    <div class="fakeimg">Raskolnikov in shorts</div>
                  </div>
                <div class="card">
                    <h2> Adolescent</h2>
                    <h5>Fyodor Dostoyevsky</h5>
                    <div class="fakeimg">Sexy Tatiana</div>
                  </div>
                <div class="card">
                    <h2>The Idiot</h2>
                    <h5>Fyodor Dostoyevsky</h5>
                    <div class="fakeimg">99% of the population</div>
                  </div>
            </div>
          </div>
        </div>

     <script src="../../content/js/filter.js"></script>

     <?php 
        if (isset($_GET['controller']) && isset($_GET['action'])) {
          $controller = $_GET['controller'];
          $action     = $_GET['action'];
        } else {
          $controller = 'pages';
          $action     = 'reg';
        }
        
        // echo "\t" . $_SESSION['id'] . " " . $_SESSION['first'] . " ".  $_SESSION['last'] . " " . $_SESSION['user'] . " ".  $_SESSION['password'] . "\n";


        global $current_dir; 
        $current_dir =  getcwd();
        require_once("../../routes.php");
     ?>
     
</body>
</html>
