<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up Form</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

      <form action="index.html" method="post">

        <h1>Sign Up</h1>

        <fieldset>

          <legend><span class="number">1</span> Your basic info</legend>

          <label for="name">Name:</label>
          <input type="text" id="name" name="user_name">

          <label for="mail">Email:</label>
          <input type="email" id="mail" name="user_email">

          <label for="password">Password:</label>
          <input type="password" id="password" name="user_password">

        </fieldset>

        <fieldset>

          <legend><span class="number">2</span> Your profile</legend>

          <label for="bio">Biography:</label>
          <textarea id="bio" name="user_bio"></textarea>

        </fieldset>

        <button type="submit" form="index.php">Sign Up</button>
		<button type="submit" form="index.php">Sign In</button>

      </form>

    </body>
</html>









