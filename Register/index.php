<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Boox</title>

        <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       	<link rel="stylesheet" href="register.css">

    </head>
    <body>

		<h2 id="motto">BookLeaks</h2>

		<div class="main">
			<img src="../quote.jpg" alt="quote" id="myImg">
			<div class="wrapper">
				<button type="button" class="popup" id = "register" onmouseover="register_visible()" onmouseout="image_visible()"> Sign up</button>
		        <button type="button" class="popup" id = "login" onmouseover="login_visible()" onmouseout="image_visible()"> Sign in </button>
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
		</div>

		<?php  include "register_footer.php"; ?>

    </body>
</html>









