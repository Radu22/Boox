<?php
	class Location{

		public $lat;
		public $lng;

		public function __construct($lat, $lng){
			$this->lat = $lat;
      		$this->lng = $lng;

		}

		public function updateLocation(){
			require_once("../connection.php");
        	$db = Db::getInstance();

        	$req = $db->prepare('SELECT count(*) FROM location WHERE user_id = :id');
        	$req->bindValue(":id", $_SESSION['id'] );
       		$req->execute();
        	if ($req->fetchColumn() > 0) {
        		//update
        		$sql = $db->prepare('UPDATE location SET lat = :lat, lng = :long WHERE user_id = :id');
        		$sql->bindValue(":lat", $this->lat);
        		$sql->bindValue(":long", $this->lng );
        		$sql->bindValue(":id", $_SESSION['id'] );
        		$sql->execute();
        	}else{
        		//insert
        		$sql = $db->prepare("INSERT INTO location (user_id, lat, lng) values (:id, :lat, :long)");
        		$sql->bindValue(":lat", $this->lat);
        		$sql->bindValue(":long", $this->lng );
        		$sql->bindValue(":id", $_SESSION['id'] );
        		$sql->execute();
        	}
		}

        public function verifyNearUsers(){
            require_once("../connection.php");
            $db = Db::getInstance();

            $sql = $db->prepare('SELECT lat, lng, user_id FROM location WHERE user_id != :id');
            $sql->bindValue(":id", $_SESSION['id'] );
            $sql->execute();
            foreach($sql->fetchAll() as $loc){
                $lat = $loc['lat'];
                $long = $loc['lng'];
                $user2 = $loc['user_id'];
                $R = 6371;
                $dLat = deg2rad($lat-$this->lat);
                $dLon = deg2rad($long-$this->lng);
                $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat)) * cos(deg2rad($this->lat)) * sin($dLon/2) * sin($dLon/2);
                $c = 2 * atan2(sqrt($a), sqrt(1-$a));
                $d = $R * $c;
                if($d < 50){

                    $req = $db->prepare('SELECT count(*) FROM notification WHERE user_to = :id and type = :loc and user_from = :id2');
                    $req->bindValue(":id2", $user2);
                    $req->bindValue(":loc", "location");
                    $req->bindValue(":id", $_SESSION['id'] );
                    $req->execute();
                    if ($req->fetchColumn() > 0){
                        //update notification
                        $ql = $db->prepare('UPDATE notification SET seen = :val_seen WHERE user_to = :id1 and user_from = :id2 and type = :loc ');
                        $ql->bindValue(":val_seen", 1);
                        $ql->bindValue(":id2", $user2);
                        $ql->bindValue(":loc", "location");
                        $ql->bindValue(":id1", $_SESSION['id'] );
                        $ql->execute();
                    }else{
                        $ql = $db->prepare("INSERT INTO notification (user_to, type, user_from, seen) values (:id1, :tip, :id2, :val_seen )");
                        $ql->bindValue(":val_seen", 1);
                        $ql->bindValue(":id2", $user2);
                        $ql->bindValue(":tip", "location");
                        $ql->bindValue(":id1", $_SESSION['id'] );
                        $ql->execute();
                    }

                }
            }

        }

    }

  ?>