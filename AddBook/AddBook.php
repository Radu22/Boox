<!DOCTYPE html>
<html>
	<head>
		<title>Adauga Carte</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="../css/header.css">
	    <link rel="stylesheet" href="../css/footer.css">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">


	</head>
	<body>

		<?php include "../Headers/header_main.php";?>
		<section class="main-container">
			<div class ="formular">
				<h2>Adauga Carte</h2>
				<form action="bd.php" method="POST" enctype="multipart/form-data">
				 		<label >Titlu:</label>
				 		<input type="text" id="titlu" name="titlucarte">

				 		<label >Autor:</label>
				 		<input type="text" id="autor" name="autorcarte">

						<label >ISBN:</label>
				 		<input type="text" id="isbn" name="isbncarte" maxlength="13">
				 		<fieldset id="tip">

					 		<legend >Tip Carte:</legend>

							<input type="radio" name="list"  value="paperback"/>Paperback

							<label class="tipcarte">
								<input type="radio" name="list"  value="hardcover"/>Hardcover
							</label>

						</fieldset>

						<input type="file" name="file" id="file" class="inputfile" />
						<label for="file">Upload Photo</label>
						<br>

						<label id="description">Descriere:</label>
						<textarea name="descriere"></textarea>
						<button type="submit"  name="submit">Adauga</button>
				</form>
			</div>
		</section>
	</body>
</html>