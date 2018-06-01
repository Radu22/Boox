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

<!doctype html>
<html>
    <head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Profile</title>


		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Merriweather|Lobster|Mina" rel="stylesheet">


        <link rel="stylesheet" href="../../content/css/footer.css">
        <link rel="stylesheet" href="../../content/css/header.css">
        <link rel="stylesheet" href="../../content/css/profile.css">
    </head>
    <body>

		<?php require_once('../header_main.php');?>

	<div class="content" id="up">
		<h2>Hello, <?php echo '<b>' .$_SESSION['first'] . '</b>' ;?></h2>

			<div id="profile_content">
				<div id="edit">
					<h3>Edit your profile from here</h3>
					<div class="container">
						  <form action="?controller=auth&action=edit" method="post">
						    <div class="row">
						      <div class="col-25">
						        <label for="user">Change username</label>
						      </div>
						      <div class="col-75">
						        <input type="text" id="user" name="username" placeholder="Username ">
						      </div>
						    </div>
						    <div class="row">
						      <div class="col-25">
						        <label for="email">Change email address</label>
						      </div>
						      <div class="col-75">
						        <input type="text" id="email" name="email" placeholder="Email address ">
						      </div>
						    </div>
						    <div class="row">
						      <div class="col-25">
						        <label for="city">Provide your city</label>
						      </div>
						      <div class="col-75">
						        <input type="text" id="city" name="city" placeholder="City ">
						      </div>
						    </div>
						    <div class="row">
						      <div class="col-25">
						        <label for="county">Provide your county</label>
						      </div>
						      <div class="col-75">
						        <input type="text" id="county" name="county" placeholder="County ">
						      </div>
						    </div>
						    <div class="row">
						      <div class="col-25">
						        <label for="notification">Choose whether or not to get notified if people in your area are offering books</label>
						      </div>
						      <div class="col-75">
						        <input type="radio" name="notification" value="1"> <label>Yes</label><br>
						 	  	  <input type="radio" name="notification" value="2"> <label>No</label>
						      </div>
						    </div>
						    <div class="row">
						      <input type="submit" value="Save changes">
						    </div>
						  </form>
					</div>
				</div>
		</div>
	</div>


    </body>
</html>