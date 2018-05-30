<?php 
  session_start();

          if (isset($_GET['controller']) && isset($_GET['action'])) {
          $controller = $_GET['controller'];
          $action     = $_GET['action'];
        } else {
          $controller = 'pages';
          $action     = 'reg';
        }
        
        // echo "\t" . $_SESSION['id'] . " " . $_SESSION['first'] . " ".  $_SESSION['last'] . " " . $_SESSION['user'] . " ".  $_SESSION['password'] . "\n";

        require_once("../../routes.php");
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
                <form class="searchBook clearfix" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pages&action=main">
                  <input type="text" placeholder="Search for books" name="search" title="Search for books" id="filter"
                     onkeyup="getFiltered()">
                  <button id="click" type="submit"><i class="fa fa-search"></i></button>
                </form>


              <div class="addButton">
                <a href="add_book.php?controller=pages&action=add"><button class="button">Adauga Carte</button></a>
              </div>
           </div>

         <div class="filtercol">
              <h3>Filter part</h3>
              <p>more content</p>
              <p>test</p>
              <p>test</p>
              <p>test</p>
              <p>test</p>
          </div>

          <div class="rightcolumn clearfix">
          <form id="wishes" action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pages&action=main" method="post">
            <div class="firstrow">
                   <div class="card">
                        <h2>Crime and punishment</h2>
                        <div class="want"><input type="submit" value="Wanted"> </div>
                        <br><br><br>
                        <h5>Fyodor Dostoyevsky</h5>
                        <div class="fakeimg">Raskolnikov in shorts</div>
                      </div>
                    <div class="card">
                        <h2> Adolescent</h2>
                        <div class="want"><input type="submit" value="Wanted"> </div>
                        <br><br><br>
                        <h5>Fyodor Dostoyevsky</h5>
                        <div class="fakeimg">Sexy Tatiana</div>
                      </div>
                    <div class="card">
                        <h2>The Idiot</h2>
                        <div class="want"><input type="submit" value="Wanted"> </div>
                        <br><br><br>
                        <h5>Fyodor Dostoyevsky</h5>
                        <div class="fakeimg">99% of the population</div>
                    </div>
                    <div class="card">
                        <h2>Crime and punishment</h2>
                        <div class="want"><input type="submit" value="Wanted"> </div>
                        <br><br><br>
                        <h5>Fyodor Dostoyevsky</h5>
                        <div class="fakeimg">Raskolnikov in shorts</div>
                      </div>
                      <div class="card">
                        <h2>Crime and punishment</h2>
                        <div class="want"><input type="submit" value="Wanted"> </div>
                        <br><br><br>
                        <h5>Fyodor Dostoyevsky</h5>
                        <div class="fakeimg">Raskolnikov in shorts</div>
                      </div>
                      <div class="card">
                        <h2>Crime and punishment</h2>
                        <div class="want"><input type="submit" value="Wanted"> </div>
                        <br><br><br>
                        <h5>Fyodor Dostoyevsky</h5>
                        <div class="fakeimg">Raskolnikov in shorts</div>
                      </div>
              </div>
            </form>
            
            
          </div>
       
        </div>

        <br />
        

     <script src="../../content/js/filter.js"></script>
     
</body>
</html>
