<?php



	echo

		'<form action="?controller=auth&action=signup" method="post">
				<fieldset>

			          <legend><span class="number">1</span> Your basic info</legend>

			          <label>Name *</label>
			          <input type="text" name="name">

					  <label>Username *</label>
					  <input type="text" name="user_name">

			          <label>Email *</label>
			          <input type="email" name="user_email">

			          <label>Password *</label>
			          <input type="password" name="user_password">

			        </fieldset>
			      <button type="submit" name="submit" > Sign Up </button>

      </form>

		';
?>
