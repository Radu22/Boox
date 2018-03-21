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
						<li class="fa fa-pencil-square-o">Edit</li>
						<li class="fa fa-gears">Settings</li>
						<li class="fa fa-thumbs-o-up">Following</li>
						<li class="fa fa-heart">Followers</li>
					</ul>

				</div>

		</div>




		<script src="profile.js"></script>

    </body>
</html>