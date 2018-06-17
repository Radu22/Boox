<?php
	class Notification{
		public static function insertNotification($user_id, $book_title){

			$db = Db::getInstance();
			if(Notification::getNotification($user_id, $book_title) > 0){
				header("notification.php?controller=pages&action=notification");
			}else{

				$req = $db->prepare('INSERT INTO notification (user_to, type, user_from, seen) values (:id_to, :tip, :id_from, :val_seen)');
   				$req->bindValue(":id_to", $user_id );
    			$req->bindValue(":val_seen", 1 );
    			$req->bindValue(":tip", "trade" . $book_title );
    			$req->bindValue(":id_from", $_SESSION['id'] );
				$req->execute();

			}


		}
		public static function getNotification($user_id, $book_title){
			$db = Db::getInstance();
			$sql = 'SELECT COUNT(*) FROM notification WHERE user_to = ' . $user_id . ' and seen = 1 ' . ' and type = \'trade' . $book_title .'\' ' ;
			$req = $db->query($sql);
			$req = $req->fetch(PDO::FETCH_ASSOC);
      		return $req['COUNT(*)'];
		}
	}
 ?>