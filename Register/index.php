<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up Form</title>

        <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="register.css">
    </head>
    <body>

		<h2 id="motto"> Welcome to a world of books</h2>

	<div class="wrapper">
		<button type="button" class="popup" id = "register"> Sign up</button>
        <button type="button" class="popup" id = "login"> Sign in</button>
	</div>

	        <div id="myModal1" class="modal">
			 	 <div class="modal-content">
					  <div class="modal-header">
						    <span class="close">&times;</span>
						    <h3>Sign up</h3>
					  </div>
					  <div class="modal-body">
							<?php include "register_form.php"; ?>
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
							<?php include "login_form.php"; ?>
					  </div>
				</div>
			</div>

		<script src="register.js"></script>

    </body>
</html>









