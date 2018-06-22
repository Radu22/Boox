<?php

echo '	<div class="header" id="myHeader">
			<a href="#" class="logo">Logo</a>

	';

		echo'

			<div class="header-left">
	            <script src="../../content/js/notification.js"></script>
				<a href="notification.php?controller=pages&action=notification" class="fa fa-bell">
                    <script src="../../content/js/notif.js"></script>
					<div id = "notif_nr"></div>
				</a>


			</div>
		';


	echo '
			<script src="../../content/js/location.js"></script>
			<div class="header-right">


				<a href="main.php?controller=pages&action=main" class="active" >Homepage </a>
				<a href="book.php?controller=pages&action=book&types=lease">My books</a>
				<a href="contact.php?controller=pages&action=contact">Contact us</a>
				<a href="?controller=pages&action=logout">Logout</a>
				<button class="button-header" onclick="updateDB()">Find books near me</button>
				<a href="profile.php?controller=pages&action=profile" class="fa fa-user-circle" id="myProf"
						style="text-decoration:none;"></a>

		  </div>

		</div>';

?>