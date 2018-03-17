<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up Form</title>

        <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="register.css">
      	<script src="register.js"></script>
    </head>
    <body>

		<h1 id="motto"> Welcome to a world of books</h1>

      <form action="../MainPage/MainPage.php" method="post">

        <h1>Sign Up or

        		<button type="button" id="popup"> Sign in</button></h1>


        <fieldset>

          <legend><span class="number">1</span> Your basic info</legend>

          <label for="name">Name*</label>
          <input type="text" id="name" name="user_name">

          <label for="mail">Email*</label>
          <input type="email" id="mail" name="user_email">

          <label for="password">Password*</label>
          <input type="password" id="password" name="user_password">

        </fieldset>

        <fieldset>

          <legend><span class="number">2</span> Your profile</legend>

          <label for="bio">Biography:</label>
          <textarea id="bio" name="user_bio"></textarea>

        </fieldset>

        <button type="submit"> Sign Up </button>

      </form>

    </body>
</html>









