<?php 
	session_start();
	date_default_timezone_set('Europe/Bucharest');
    require_once("../connection.php");
	$db = Db::getInstance();
    $req = $db->prepare('SELECT * FROM notification WHERE user_to = :id' );
    $req->bindValue(":id", $_SESSION['id']);
	$req->execute();
	$number = 0;
	foreach ($req->fetchAll() as $notif) {
		if($notif['type']=="location"){
			$data = strtotime($notif['last_update']);
            $data_curenta = strtotime(date("Y-m-d H:i:s"));
            $diferenta = round(($data_curenta - $data)/3600);
            if($diferenta < 2){
            	
            	//verificam cate carti are userul din aproprire
            	$sql = $db->prepare('SELECT * FROM book_added WHERE user_id = :id' );
    			$sql->bindValue(":id", $notif['user_from']);
				$sql->execute();
				foreach ($sql->fetchAll() as $carti) {
					$number = $number + 1;
				}
            }
		}else{
			$number = $number + 1;
		}
	}
	$req = $db->prepare('SELECT * FROM notification WHERE user_from = :id' );
    $req->bindValue(":id", $_SESSION['id']);
	$req->execute();
	foreach ($req->fetchAll() as $notif){
		if($notif['type']=="accepted"){
			$number = $number + 1;
		}
	}

	if($number>0){
		echo '<div class="notification">'. $number . '</div>';
	}
?>