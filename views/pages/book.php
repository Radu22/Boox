<?php 
    session_start();
    global $books;

    if (isset($_GET['controller']) && isset($_GET['action'])) {
        $controller = $_GET['controller'];
        $action     = $_GET['action'];
    } else {
        $controller = 'pages';
        $action     = 'reg';
    }

    require_once("../../routes.php");
?>


<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Personal books</title>

        <link rel="stylesheet" href="../../content/css/footer.css">
        <link rel="stylesheet" href="../../content/css/header.css">
        <link rel="stylesheet" href="../../content/css/book.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <body>

		<?php require_once('../header_main.php');?>

    <h2>My books</h2>
    <hr>

	<div class="content">
        <div class="wrapper-left">
            <form method="post">
                <input type="text" placeholder="Search for books" name="search2" title="Search for books" id="filter"
                    onkeyup="getFiltered()">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
            <h3>Bookshelves</h3>
            <div id="shelf">
                <ul>
                    <li><a href="#">Total Books - <?php echo $_SESSION['count']; ?></a></li>
                    <li><a href="#">For leasing ( )</a></li>
                    <li><a href="#">Want to read ( )</a></li>
                </ul>

            </div>
        </div>
        <div style="overflow-x:hidden">

        <table border="1" >
        <thead>
                <tr id="booksHeader">
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Type</th>
                    <th>Duration</th>
                    <th>Language</th>
                </tr>
            </thead>
            <tbody>
                <?php 
        
                foreach($books as $book) {?>
                    <tr class="<?php echo "".$book->book_id.""; ?>" align="left">
                        <td class="field cover">
                            <img src="../../content/images/crime.jpg" alt="<?php echo $book->description; ?>" width="80" height="80"></td>

                        <td class="field title"><?php echo $book->book_title; ?></td>
                        <td class="field author"><?php echo $book->book_author; ?></td>
                        <td class="field type"><?php echo $book->book_type; ?></td>
                        <td class="field duration"><?php echo $book->duration; ?></td>
                        <td class="field language"><?php echo $book->language; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        
        </table>

        </div>

	</div>

		<script src="../../content/js/filterAdd.js"></script>

    </body>
</html>