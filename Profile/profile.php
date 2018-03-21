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
		<link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">

    </head>
    <body>

		<?php include "../Headers/header_main.php";?>

	<div class="content">
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
					<h3>Edit your profile from here:</h3>
					<div class="container">
						  <form action="#">
						    <div class="row">
						      <div class="col-25">
						        <label for="user">Change username</label>
						      </div>
						      <div class="col-75">
						        <input type="text" id="user" name="username" placeholder="Your username..">
						      </div>
						    </div>
						    <div class="row">
						      <div class="col-25">
						        <label for="lname">Last Name</label>
						      </div>
						      <div class="col-75">
						        <input type="text" id="lname" name="lastname" placeholder="Your last name..">
						      </div>
						    </div>
						    <div class="row">
						      <div class="col-25">
						        <label for="country">Country</label>
						      </div>
						      <div class="col-75">
						        <select id="country" name="country">
						          <option value="australia">Australia</option>
						          <option value="canada">Canada</option>
						          <option value="usa">USA</option>
						        </select>
						      </div>
						    </div>
						    <div class="row">
						      <div class="col-25">
						        <label for="subject">Subject</label>
						      </div>
						      <div class="col-75">
						        <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
						      </div>
						    </div>
						    <div class="row">
						      <input type="submit" value="Submit">
						    </div>
						  </form>
					</div>

				</div>
				<div id="settings">



				</div>
				<div id="follow">

				</div>
				<div id="followed">

				</div>



			</div>


		</div>




		<script src="profile.js"></script>

    </body>
</html>