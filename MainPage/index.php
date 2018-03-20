<!doctype html>
<html>
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Profile</title>

        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="mainpage.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <body>

      <?php include "../Headers/header_main.php";?>

        <div class="row">
          <div class="leftcolumn">
              <?php include "../Headers/header_book.php"; ?>
              <?php include "../Headers/header_book.php"; ?>
              <?php include "../Headers/header_book.php"; ?>
              <?php include "../Headers/header_book.php"; ?>
              <?php include "../Headers/header_book.php"; ?>
              <?php include "../Headers/header_book.php"; ?>
              <?php include "../Headers/header_book.php"; ?>
              <?php include "../Headers/header_book.php"; ?>
              <?php include "../Headers/header_book.php"; ?>
              <?php include "../Headers/header_book.php"; ?>


          </div>

          <div class="rightcolumn">
          	<div class="searchButton">
        	  	<form class="example" action="/action_page.php">
        			<input type="text" placeholder="Cauta.." name="search2">
        			<button type="submit"><i class="fa fa-search"></i></button>
        		</form>
        	</div>

            <div class="addButton">
            	<button class="button">Adauga Carte</button>
            </div>

        </div>

</body>
</html>
