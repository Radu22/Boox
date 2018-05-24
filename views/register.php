<?php
  require_once("connection.php");

?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Boox</title>
		    <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     
       	<link href="content/css/register.css" rel="stylesheet"  type="text/css">
        
  </head>

  <body>
  <h2 id="motto">BookLeaks</h2>

        <div class="main">
          <img src="content/images/quote.jpg" alt="quote" id="myImg">
          <div class="wrapper">
            <button type="button" class="popup" id="register" onmouseover="register_visible()" onmouseout="image_visible()"> Sign up</button>
                <button type="button" class="popup" id="login" onmouseover="login_visible()" onmouseout="image_visible()"> Sign in </button>
          </div>

                  <div id="myModal1" class="modal">
                  <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h3>Sign up</h3>
                    </div>
                    <div class="modal-body">
                      <?php require_once('register_form.php'); ?>
                    </div>
                </div>
              </div>

              <div id="myModal2" class="modal">
                  <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h3>Sign in</h3>
                    </div>
                    <div class="modal-body">
                      <?php require_once('login_form.php'); ?>
                    </div>
                </div>
              </div>

            <script src="content/js/register.js"></script>
        </div>

        <?php  require_once('register_footer.php'); ?>


    <?php  require_once('routes.php'); ?>


  <body>
<html>