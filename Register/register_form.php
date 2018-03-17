<?php

	echo

		'<form action="../MainPage/MainPage.php" method="post">
				<fieldset>

			          <legend><span class="number">1</span> Your basic info</legend>

			          <label>Name *</label>
			          <input type="text" name="user_name">

			          <label>Email *</label>
			          <input type="email" name="user_email">

			          <label>Password *</label>
			          <input type="password" name="user_password">

			        </fieldset>

			        <fieldset>

			          <legend><span class="number">2</span> Your profile</legend>

			          <label>Biography:</label>
			          <textarea name="user_bio"></textarea>

			    </fieldset>

			      <button type="submit"> Sign Up </button>

      </form>

		';

?>
