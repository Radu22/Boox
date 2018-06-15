<?php
    session_start();
	   require_once("../connection.php");
	   require_once("../models/books.php");
    $db = Db::getInstance();
    $req = $db->prepare('SELECT * FROM notification WHERE user_to = :id and seen = :val_seen' );
    $req->bindValue(":id", $_SESSION['id'] );
    $req->bindValue(":val_seen", 1 );
	$req->execute();
	echo '<form action="notification.php?controller=pages&action=notification" method="post">';
    foreach($req->fetchAll() as $notif){
    	$id = $notif['user_from'];
    	$sql = $db->prepare('SELECT * FROM book_added WHERE user_id = :id');
    	$sql->bindValue(":id", $id);
		$sql->execute();

        if(substr($notif['type'],0,5)=="trade"){
            foreach($sql->fetchAll() as $book){
                $ql = $db->prepare('SELECT user_first FROM users WHERE user_id = :id');
                $ql->bindValue(":id", $book['user_id']);
                $ql->execute();
                $result = $ql->fetch();
                $nume = $result['user_first'];

                echo "<h3>" . $nume . " wants to trade <b>". $book['book_title'] ."</b> for</h3>";
                echo '<p>'. substr($notif['type'],5) ." </p> ";

        }

        }else{
            foreach($sql->fetchAll() as $book){

            $ql = $db->prepare('SELECT user_first FROM users WHERE user_id = :id');
            $ql->bindValue(":id", $book['user_id']);
            $ql->execute();
            $result = $ql->fetch();
            $nume = $result['user_first'];


            echo "<div class= card>";
                echo "<h4><b>" . $nume . " is less then 5 km away</b></h4> ";
                echo "<p>Titlu: ". $book['book_title'] . "</p>";
                echo "<p>ISBN: ". $book['ISBN'] . "</p>";
                echo "<p>Limba: ". $book['language'] . "</p>";

                echo '<input type="text" name="user_to" class="titlu" value=' . $id . '>';
                echo '<input type="text" name="titlu_carte" class="titlu" value=' . $book['book_title'] . '>';
                if(Book::getCount('book_added') == 0){
                    echo '<p> You don\'t have any books to trade</p>';
                }else
                {
                    echo "<input type='submit' value='Trade'></button>";
                }

            echo "</div>";
        }
        }



	}
	echo '</form>';





?>