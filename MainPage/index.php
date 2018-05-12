<!doctype html>
<html>
    <head>
        <title>Home</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="mainpage.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    </head>
    <body>

      <?php include "../Headers/header_main.php";?>

        <div class="rand">
            <div class="leftcolumn">
                <form class="searchBook" >
                  <input type="text" placeholder="Search for books" name="search2" title="Search for books" id="filter"
                     onkeyup="getFiltered()">
                  <button type="submit"><i class="fa fa-search"></i></button>
                </form>


              <div class="addButton">
                <a href="../AddBook/AddBook.php"><button class="button">Adauga Carte</button></a>
              </div>
           </div>

          <div class="rightcolumn">
            <div class="firstrow">
                 <div class="card">
                    <h2>Crime and punishment</h2>
                    <h5>Fyodor Dostoyevsky</h5>
                    <div class="fakeimg">Raskolnikov in shorts</div>
                  </div>
                <div class="card">
                    <h2> Adolescent</h2>
                    <h5>Fyodor Dostoyevsky</h5>
                    <div class="fakeimg">Sexy Tatiana</div>
                  </div>
                <div class="card">
                    <h2>The Idiot</h2>
                    <h5>Fyodor Dostoyevsky</h5>
                    <div class="fakeimg">99% of the population</div>
                  </div>
            </div>
          </div>
        </div>

 <script src="mainpage.js"></script>
</body>
</html>
