<!doctype html>
<html>
    <head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Personal books</title>

        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="Mybooks.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <body>

		<?php include "../Headers/header_main.php";?>

    <h2>My books</h2>
    <hr>

	<div class="content">
        <form >
                  <input type="text" placeholder="Search for books" name="search2" title="Search for books" id="filter"
                     onkeyup="getFiltered()">
                  <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        <h3>Bookshelves</h3>
        <div id="shelf">
            <ul>
                <li><a href="#">Total Books - 99</a></li>
                <li><a href="#">Read()</a></li>
                <li><a href="#">To Read()</a></li>
                <li><a href="#">For rent()</a></li>
            </ul>

        </div>
	</div>






		<script src="Mybooks.js"></script>

    </body>
</html>