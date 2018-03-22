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
			 <div class ="formular">
			 	<div class="titlupagina">
			 		<p>Adauga Carte</p>
			 	</div>
			 	<form>
			 		<label >Titlu:</label>
			 		<input type="text" id="titlu" name="titlucarte">

			 		<label >Autor:</label>
			 		<input type="text" id="autor" name="autorcarte">

					<label >ISBN:</label>
			 		<input type="text" id="isbn" name="isbncarte" maxlength="13">
			 		<fieldset id="tip">

				 		<legend >Tip Carte:</legend>
						<label class="tipcarte">
							<input type="radio" name="list"  value="paperback"/>Paperback
						</label><br>
						<label class="tipcarte">
							<input type="radio" name="list"  value="hardcover"/>Hardcover
						</label>
					</fieldset>
					<button class="butonUpload">Incarca Fotografii</button>
					<div class="imaginiCarte">
						<div class="imagineCarte">Image</div>
						<div class="imagineCarte">Image</div>
						<div class="imagineCarte">Image</div>
					</div>
					<label >Descriere:</label>
					<textarea name="descriere"></textarea>
					<input type="submit"  value="Adauga">
				</form>
			</div>
	</body>
</html>