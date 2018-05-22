<?php

	echo

		'<form action="?controller=auth&action=signin" method="post">
				<fieldset>

			          <legend><span class="number">1</span> Log in information </legend>

			          <label>Username</label>
			          <input type="text" name="user_name">

			          <label>Password</label>
			          <input type="password" name="user_password">

			        </fieldset>

			      <button type="submit"> Sign In </button>

      </form>

		';

?>
