<!DOCTYPE html>
<html>
	<head>
		<title>Adauga Carte</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./style.css">
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

						<label>Tip Carte:</label>
						<select>
						    <option value="0">Alege</option>
						    <option value="1">Paperback</option>
						    <option value="2">Hardcover</option>
						</select>
						<br>
						<br>

						<label>Limba:</label>
						<select>
						    <option value="0">Alege</option>
						    <option value="1">Romana</option>
						    <option value="2">Engleza</option>
						    <option value="3">Franceza</option>
						    <option value="4">Italiana</option>
						    <option value="5">Germana</option>
						</select>
						<br>
						<br>

						<label>Gen:</label>
						<select>
						    <option value="0">Alege</option>
						    <option value="1">Arta, arhitectura si fotografie</option>
						    <option value="2">Biografii si memorii</option>
						    <option value="3">Business, economie, finante</option>
						    <option value="4">Carti pentru copii</option>
						    <option value="5">Dictionare si Enciclopedii</option>
						    <option value="6">Diete si fitness</option>
						    <option value="7">Drept</option>
						    <option value="8">Fictiune</option>
						    <option value="9">Filosofie</option>
						    <option value="10">Gastronomie</option>
						    <option value="11">Ghiduri de calatorie, harti</option>
						    <option value="12">Hobby, timp liber</option>
						    <option value="13">Istorie</option>
						    <option value="14">Limbi straine</option>
						    <option value="15">Manuale si auxiliare scolare</option>
						    <option value="16">Medicina</option>
						    <option value="17">Parenting si familie</option>
						    <option value="18">Psihologie, Pedagogie</option>
						    <option value="19">Religie</option>
						    <option value="20">Self Help</option>
						    <option value="21">Sociologie, stiinte politice</option>
						    <option value="22">Spiritualitate, ezoterism</option>
						    <option value="23">Stiinte</option>
						</select>
						<br>
						<br>

						<input type="file" name="file" id="file" class="inputfile" />
						<label for="file">Upload Photo</label>

						<input type="file" name="file2" id="file2" class="inputfile" />
						<label for="file">Upload Photo</label>
						<br>

						<label>Descriere:</label>
						<textarea name="descriere"></textarea>
						<button type="submit"  name="submit">Adauga</button>
				</form>
			</div>
		</section>
	</body>
</html>