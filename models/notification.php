<?php
	class Notification{
		public static function insertNotification($user_id, $book_title){

			$db = Db::getInstance();
			if(Notification::getNotification($user_id, $book_title)){
				var_dump("nu mai insera");
				exit();
			}else{

				$req = $db->prepare('INSERT INTO notification (user_to, type, user_from, seen) values (:id_to, :tip, :id_from, :val_seen)');
   				$req->bindValue(":id_to", $user_id );
    			$req->bindValue(":val_seen", 1 );
    			$req->bindValue(":tip", "trade" );
    			$req->bindValue(":id_from", $_SESSION['id'] );
				$req->execute();

			}


		}
		public static function getNotification($user_id, $book_title){
			$db = Db::getInstance();
			$req = $db->prepare('SELECT count(*) FROM notification WHERE user_to = :id_to and seen = :val_seen and type = :tip and user_from = :id_from' );
   			$req->bindValue(":id_to", $user_id );
    		$req->bindValue(":val_seen", 1 );
    		$req->bindValue(":tip", $book_title);
    		$req->bindValue("id_from", $_SESSION['id'] );
    		$req->execute();
    		if($req->fetchColumn() >0){
    			return 1;
    		}
    		else{
    			return 0;
    		}
		}
	}
 ?>