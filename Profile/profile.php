<!doctype html>
<html>
    <head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Profile</title>

        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="profile.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Merriweather|Lobster|Mina" rel="stylesheet">

    </head>
    <body>

		<?php include "../Headers/header_main.php";?>

	<div class="content" id="up">
		<h2>Hello, $name</h2>
				<div id="myTabs">
					<ul>
						<li class="fa fa-pencil-square-o under" ><a href="#edit">Edit</a></li>
						<li class="fa fa-gears under" ><a href="#settings">Settings</a></li>
						<li class="fa fa-thumbs-o-up under"><a href="#follow">Following</a></li>
						<li class="fa fa-heart under" ><a href="#followed">Followers</a></li>
					</ul>
				</div>

			<div id="profile_content">
				<div id="edit">
					<h3>Edit your profile from here</h3>
					<div class="container">
						  <form action="#">
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
						        <input type="text" id="email" name="emailadd" placeholder="Email address ">
						      </div>
						    </div>
						    <div class="row">
						      <div class="col-25">
						        <label for="phone">Provide Phone number</label>
						      </div>
						      <div class="col-75">
						        <input type="text" id="phone" name="number_phone" placeholder="Phone ">
						      </div>
						    </div>
						    <div class="row">
						      <div class="col-25">
						        <label for="location">Provide your location</label>
						      </div>
						      <div class="col-75">
						        <input type="text" id="location" name="number_phone" placeholder="Location ">
						      </div>
						    </div>

						    <div class="row">
						      <div class="col-25">
						        <label for="subject">About me</label>
						      </div>
						      <div class="col-75">
						        <textarea id="subject" name="subject" placeholder="Write anything that crosses your mind" style="height:200px"></textarea>
						      </div>
						    </div>

						    <div class="row">
						      <input type="submit" value="Save changes">
						    </div>

						  </form>
					</div>
				</div>
				<div id="settings">
					<h3>Profile Settings</h3>
					<button type="button" >Reset defaults</button>
					<h3 style="font-size: 17.5px"> Choose whether or not to get notified if people in your area are offering books </h3>

							  <input type="radio" name="notif" id="first"> <label for="first">Yes</label><br>
						 	  <input type="radio" name="notif" id="second"> <label for="second">No</label>


				</div>

				<div id="follow">
					<h3>People that you follow</h3>
					<?php include 'follow_template.php';?>
					<?php include 'follow_template.php';?>

				</div>
				<div id="followed">
					<h3>People that follow you</h3>
					<?php include 'follow_template.php';?>
					<?php include 'follow_template.php';?>

				</div>






		</div>


	</div>

		<script src="profile.js"></script>

    </body>
</html>