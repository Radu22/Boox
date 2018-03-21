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
			<p id="edit">Lorem Ipsum este pur şi simplu o machetă pentru text a industriei tipografice. Lorem Ipsum a fost macheta standard a industriei încă din secolul al XVI-lea, când un tipograf anonim a luat o planşetă de litere şi le-a amestecat pentru a crea o carte demonstrativă pentru literele respective. Nu doar că a supravieţuit timp de cinci secole, dar şi a facut saltul în tipografia electronică practic neschimbată. A fost popularizată în anii '60 odată cu ieşirea colilor Letraset care conţineau pasaje Lorem Ipsum, iar mai recent, prin programele de publicare pentru calculator,</p>


		</div>




		<script src="profile.js"></script>

    </body>
</html>