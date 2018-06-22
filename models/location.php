<?php
	date_default_timezone_set('Europe/Bucharest');

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
        		//update location
        		$sql = $db->prepare('UPDATE location SET lat = :lat, lng = :long, last_update = :astazi WHERE user_id = :id');
        		$sql->bindValue(":lat", $this->lat);
        		$sql->bindValue(":long", $this->lng );
        		$sql->bindValue(":astazi", date("Y-m-d H:i:s"));
        		$sql->bindValue(":id", $_SESSION['id'] );
        		$sql->execute();
        	}else{
        		//insert location
        		$sql = $db->prepare("INSERT INTO location (user_id, lat, lng, last_update) values (:id, :lat, :long, :astazi)");
        		$sql->bindValue(":lat", $this->lat);
        		$sql->bindValue(":long", $this->lng );
        		$sql->bindValue(":astazi", date("Y-m-d H:i:s"));
        		$sql->bindValue(":id", $_SESSION['id'] );
        		$sql->execute();
        	}
		}

        public function locNotification(){

        	//luam toate coordonate din tabel
            require_once("../connection.php");
            $db = Db::getInstance();
            $sql = $db->prepare('SELECT lat, lng, user_id, last_update FROM location WHERE user_id != :id');
            $sql->bindValue(":id", $_SESSION['id'] );
            $sql->execute();

            foreach($sql->fetchAll() as $loc){

            	//verificam ca ele sa fi fost updatate in ultima ora
                $lat = $loc['lat'];
                $long = $loc['lng'];
                $user2 = $loc['user_id'];
                $data = strtotime($loc['last_update']);
                $data_curenta = strtotime(date("Y-m-d H:i:s"));
                $diferenta = round(($data_curenta - $data)/3600);

                if($diferenta<2){

                	//calculam distanta dintre locatii
                	$R = 6371;
	                $dLat = deg2rad($lat-$this->lat);
	                $dLon = deg2rad($long-$this->lng);
	                $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat)) * cos(deg2rad($this->lat)) * sin($dLon/2) * sin($dLon/2);
	                $c = 2 * atan2(sqrt($a), sqrt(1-$a));
	                $d = $R * $c;

	                if($d < 5){

	                    $req = $db->prepare('SELECT count(*) FROM notification WHERE user_to = :id and type = :loc and user_from = :id2');
	                    $req->bindValue(":id2", $user2);
	                    $req->bindValue(":loc", "location");
	                    $req->bindValue(":id", $_SESSION['id'] );
	                    $req->execute();
	                    if ($req->fetchColumn() > 0){
	                        //update notification
	                        $ql = $db->prepare('UPDATE notification SET last_update = :data WHERE user_to = :id1 and user_from = :id2 and type = :loc ');
	                        $ql->bindValue(":id2", $user2);
	                        $ql->bindValue(":loc", "location");
	                        $ql->bindValue(":id1", $_SESSION['id'] );
	                        $ql->bindValue(":data", date("Y-m-d H:i:s"));
	                        $ql->execute();
	                    }
	                    else{
	                    	//insert notification
	                        $ql = $db->prepare("INSERT INTO notification (user_to, type, user_from, last_update) values (:id1, :tip, :id2, :data)");
	                        $ql->bindValue(":id2", $user2);
	                        $ql->bindValue(":tip", "location");
	                        $ql->bindValue(":id1", $_SESSION['id'] );
	                        $ql->bindValue(":data", date("Y-m-d H:i:s"));
	                        $ql->execute();
                    	}
                	}
            	}        
        	}
		}
		
		public static function deleteByUserID($user_id){
			$db = Db::getInstance();
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  
			$sql = "DELETE FROM location WHERE user_id=$user_id";
	  
			if($db->query($sql)){
				  return true;
			  }else{
				return false;
			  }
		}
    }
?>