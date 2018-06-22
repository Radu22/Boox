<?php 
	session_start();
	date_default_timezone_set('Europe/Bucharest');
    require_once("../connection.php");
    //luam fiecare carte din book_wanted
	$db = Db::getInstance();
    $req = $db->prepare('SELECT * FROM book_wanted WHERE user_id = :id' );
    $req->bindValue(":id", $_SESSION['id']);
	$req->execute();
	foreach ($req->fetchAll() as $book_wanted){
		//cautam cartea in book_added
		$sql = $db->prepare('SELECT * FROM book_added WHERE user_id != :id and book_title = :book_title and book_author = :book_author ' );
    	$sql->bindValue(":id", $_SESSION['id']);
    	$sql->bindValue(":book_title", $book_wanted['book_title']);
    	$sql->bindValue(":book_author", $book_wanted['book_author']);
		$sql->execute();
		foreach ($sql->fetchAll() as $book_exists){
			//verificam daca notificarea deja exista
			$req = $db->prepare('SELECT * from notification where type = :tip and user_to = :id_to and user_from = :id_from and book_id_from = :book_from' );
			$req->bindValue(":tip", "added");
    		$req->bindValue(":id_to", $_SESSION['id']);
    		$req->bindValue(":id_from", $book_exists['user_id']);
    		$req->bindValue(":book_from", $book_exists['book_id']);
			$req->execute();
			if($req->fetchColumn()){
				//nu facem nimic
			}else{
				$req = $db->prepare('INSERT INTO notification (user_to, type, user_from, book_id_from, last_update) values (:id_to, :tip, :id_from, :book_id_from, :astazi)' );
				$req->bindValue(":tip", "added");
    			$req->bindValue(":id_to", $_SESSION['id']);
    			$req->bindValue(":id_from", $book_exists['user_id']);
    			$req->bindValue(":book_id_from", $book_exists['book_id']);
    			$req->bindValue(":astazi", date("Y-m-d H:i:s"));
				$req->execute();
			}
		}
	}
?>