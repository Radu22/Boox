<!DOCTYPE html>
<html>
	<head>
		<title>Adauga Carte</title>
		<meta charset="utf-8">
	    <link rel="stylesheet" href="addbook.css">
	    <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/header.css">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>

		 <?php include "../Headers/header_main.php";?>
		<div class="row">
			 <div class="formular">
			 	<form action="/action_page.php">
			 		<label >Titlu:</label>
			 		<input type="text" id="titlu" name="titlucarte">

			 		<label >Autor:</label>
			 		<input type="text" id="autor" name="autorcarte">

					<label >ISBN:</label>
			 		<input type="text" id="isbn" name="isbncarte">
					<label class="tipcarte">
						<input type="radio" name="list"  value="paperback"/>Paperback
					</label>
					<label class="tipcarte">
						<input type="radio" name="list"  value="hardcover"/>Hardcover
					</label>

					<div class="wrapper">
						<input type="submit"  value="Adauga">
					</div>
				</form>
			</div>
		</div>
	</body>
</html>