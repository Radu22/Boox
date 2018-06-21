<?php
	date_default_timezone_set('Europe/Bucharest');
	class Notification{
		public $id;
		public $user_to;
		public $book_id_to;
		public $type;
		public $user_from;
		public $book_id_from;
		public $last_update;
	
	
		public function __construct($id, $user_to, $book_id_to, $type, $user_from, $book_id_from, $last_update) {
		  $this->id = $id;
		  $this->user_to = $user_to;
		  $this->book_id_to = $book_id_to;
		  $this->type = $type;
		  $this->user_from = $user_from;
		  $this->book_id_from = $book_id_from;
		  $this->last_update = $last_updated;
		}
		
		public static function insertTradeNotification($user_id, $requested_book, $carte_schimb){

			
			//verificam daca notificarea exista
			$tip="trade";
			$db = Db::getInstance();
			
			if(Notification::getNotification($user_id, $tip, $requested_book, $carte_schimb) > 0){
				header("notification.php?controller=pages&action=notification");
			}else{
				//verificam daca exista o notificare de accept pentru oricare dintre cartii

				//inseram notificarea daca ea nu exista
				$req = $db->prepare('INSERT INTO notification (user_to, book_id_to, type, user_from, book_id_from, last_update) values (:id_to, :book_id_1, :tip, :id_from, :book_id_2, :astazi)');
   				$req->bindValue(":id_to", $user_id );
   				$req->bindValue(":book_id_1", $requested_book);
    			$req->bindValue(":tip", $tip);
    			$req->bindValue(":id_from", $_SESSION['id'] );
    			$req->bindValue(":book_id_2", $carte_schimb);
    			$req->bindValue(":astazi", date("Y-m-d H:i:s"));
				$req->execute();
	
			}
		}
		public static function insertAcceptNotification($user_id_to, $accepted_book, $for_book){

			//verificam daca notificarea deja exista
			$tip = "accepted";
			$db = Db::getInstance();
			if(Notification::getNotification($user_id_to, $tip, $accepted_book, $for_book) > 0){
				header("notification.php?controller=pages&action=notification");
			}else{
				//inseram notificarea de accept pentru userul care a cerut trade-ul
				$req = $db->prepare('INSERT INTO notification (user_to, book_id_to, type, user_from, book_id_from, last_update) values (:id_to, :book_id_to, :tip, :id_from, :book_id_from, :astazi)');
   				$req->bindValue(":id_to", $user_id_to );
    			$req->bindValue(":book_id_to", $accepted_book);
    			$req->bindValue(":tip", $tip);
    			$req->bindValue(":id_from", $_SESSION['id'] );
    			$req->bindValue(":book_id_from", $for_book );
    			$req->bindValue(":astazi", date("Y-m-d H:i:s"));
				$req->execute();

				//luam informatiile cartilor participante la trade
				$sql = $db->prepare('SELECT * FROM book_added WHERE book_id = :id');
		    	$sql->bindValue(":id", $accepted_book);
				$sql->execute();
				$carte_acceptata = $sql->fetch();

				$sql = $db->prepare('SELECT * FROM book_added WHERE book_id = :id');
		    	$sql->bindValue(":id", $for_book);
				$sql->execute();
				$carte_schimbata = $sql->fetch();

				//facem inserarea trade-ului in tabela trade
				$ql = $db->prepare('INSERT INTO TRADE (user_id1, user_id2, book_title1, book_title2) values (:id_to, :id_from, :book_1, :book_2)');
				$ql->bindValue(":id_to", $_SESSION['id']);
				$ql->bindValue(":id_from", $user_id_to);
				$ql->bindValue(":book_1", $carte_schimbata['book_title']);
				$ql->bindValue(":book_2", $carte_acceptata['book_title']);
				$ql->execute();

				//stergem notificarile de trade corespunzatoare
				$sql = $db->prepare('DELETE from notification where type = :tip and book_id_to = :book_1 and book_id_from = :book_2');
				$sql->bindValue(":tip", "trade");
				$sql->bindValue(":book_1", $for_book);
				$sql->bindValue(":book_2", $accepted_book);
				$sql->execute();

				//eliminam cartile participante la trade
				$sql = $db->prepare('DELETE from book_added where user_id = :id_user and book_id = :id_book');
				$sql->bindValue(":id_user", $user_id_to);
				$sql->bindValue("id_book", $accepted_book);
				$sql->execute();

				$sql = $db->prepare('DELETE from book_added where user_id = :id_user and book_id = :id_book');
				$sql->bindValue(":id_user", $_SESSION['id']);
				$sql->bindValue("id_book", $for_book);
				$sql->execute();


				//inseram notificarea de accept trade pentru userul care a acceptat trade-ul
			}
		}

		public static function getNotification($user_id, $tip, $id_book_1, $id_book_2){
			$db = Db::getInstance();
			$sql = $db->prepare('SELECT * from notification where user_to = :id_to and type = :tip and user_from = :id_from and book_id_to = :book_id_to and book_id_from = :book_id_from ');
			$sql->bindValue(":id_to", $user_id);
			$sql->bindValue(":tip", $tip);
			$sql->bindValue(":book_id_to", $id_book_1);
			$sql->bindValue(":book_id_from", $id_book_2);
			$sql->bindValue("id_from", $_SESSION['id']);
			$sql->execute();
			if($sql->fetchColumn() > 0){
				return 1;
			}else{
				return 0;
			}
		}

		public static function deleteByUserID($user_id){
			$db = Db::getInstance();
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  
			$sql = "DELETE FROM notification WHERE user_to=$user_id OR user_from=$user_id";
	  
			if($db->query($sql)){
				  return true;
			  }else{
				return false;
			  }
		}

		public static function getByUserID($user_id){
			$db = Db::getInstance();
			$list = [];
			$sql = "SELECT * FROM notification WHERE user_to=$user_id or user_from=$user_id";
	  
			$req = $db->query($sql);
			foreach($req->fetchAll() as $post){
			  $list[] = new Notification($post['id'],$post['user_to'],$post['book_id_to'],$post['type'],$post['user_from'],$post['book_id_from'], $post['last_update']);
			}
	
			return $list;
	  
		  }
	}
 ?>