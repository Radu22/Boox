<?php
  class User {
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $username;
    public $password;
    public $notif;
    public $location;
    public $logged_time;


    public function __construct($id, $firstname, $lastname, $email, $username, $password,$notif,$location,$logged_time) {
      $this->id         = $id;
      $this->firstname  = $firstname;
      $this->lastname   = $lastname;
      $this->email      = $email;
      $this->username   = $username;
      $this->password   = $password;
      $this->notif      = $notif;
      $this->location   = $location;
      $this->logged_time = $logged_time;
    }


    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM users');

      foreach($req->fetchAll() as $post) {
        $list[] = new User($post['user_id'], $post['user_first'], $post['user_last'],
            $post['user_email'], $post['user_uid'],$post['user_pwd'],$post['notification'],$post['location'], $post['logged_time']);
      }

      return $list;
    }

    public static function setLoggedTime($logged){
      $db = Db::getInstance();
      
      $logged = (int) $logged;  

      $sql = "UPDATE users SET logged_time = :loging WHERE user_id = :id";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(":loging", $logged);
      $stmt->bindValue(":id", $_SESSION['id'] );
      $stmt->execute();
    }

    public static function getHighestLog(){
      $db = Db::getInstance();
      $req = $db->prepare('SELECT * FROM users ORDER BY logged_time DESC LIMIT 1');
      $req->execute();
      $post = $req->fetch();

      return $post['logged_time'];
    }



    public static function find($id) {
      $db = Db::getInstance();
      $id = intval($id);
      $req = $db->prepare('SELECT * FROM users WHERE user_id = :id');
      $req->execute(array(':id' => $id));
      $post = $req->fetch();

      return new User($post['user_id'], $post['user_first'], $post['user_last'],
      $post['user_email'], $post['user_uid'],$post['user_pwd'],$post['notification'],$post['location'], $post['logged_time']);
    }

    public static function getUserByUsername($username){
      $db = Db::getInstance();
      $req = $db->prepare('SELECT * FROM users WHERE user_uid = :us');
      $req->execute(array(':us' => $username));
      $post = $req->fetch();

      return new User($post['user_id'], $post['user_first'], $post['user_last'],
      $post['user_email'], $post['user_uid'],$post['user_pwd'],$post['notification'],$post['location'], $post['logged_time']);
    }

    public static function getUserByEmail($email){
      $db = Db::getInstance();
      $req = $db->prepare('SELECT * FROM users WHERE user_email = :email');
      $req->execute(array(':email' => $email));
      $post = $req->fetch();

      return new User($post['user_id'], $post['user_first'], $post['user_last'],
      $post['user_email'], $post['user_uid'],$post['user_pwd'],$post['notification'],$post['location'], $post['logged_time']);
    }

    public static function updateUsername($username){
        $db = Db::getInstance();
        //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $user = User::getUserByUsername($username);
        if($user->id ==  NULL){
          // username neocupat
          $sql = "UPDATE users SET user_uid = :username WHERE user_id = :id";
          $stmt = $db->prepare($sql);
          $stmt->bindValue(":username", $username);
          $stmt->bindValue(":id", $_SESSION['id'] );
          $stmt->execute();
          return 1;
        }else{
          //username existent in baza de date
          return 0;
        }
      }

      public static function updateEmail($email){
        $db = Db::getInstance();
        //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $user = User::getUserByEmail($email);
        if($user->id ==  NULL){
          // email neocupat
          $sql = "UPDATE users SET user_email = :email WHERE user_id = :id";
          $stmt = $db->prepare($sql);
          $stmt->bindValue(":email", $email);
          $stmt->bindValue(":id", $_SESSION['id'] );
          $stmt->execute();
          return 1;
        }else{
          //email existent in baza de date
          return 0;
        }
      }

      public static function updateNotification($notification){
        $db = Db::getInstance();
        //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE users SET notification = :notif WHERE user_id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":notif", $notification);
        $stmt->bindValue(":id", $_SESSION['id'] );
        $stmt->execute();
        return 1;

      }

      public static function updateLocation($location){
        $db = Db::getInstance();
        //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE users SET location = :location WHERE user_id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":location", $location);
        $stmt->bindValue(":id", $_SESSION['id'] );
        $stmt->execute();
        return 1;

      }

      public static function insertSearch($search){
        $db = Db::getInstance();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
  
          $sql = "INSERT INTO searches (lista) VALUES ('".$search."')";
  
          if($db->query($sql)){
              return true;
          }else{
            return false;
          }
   
      }

      public static function getLastSearch(){
        $db = Db::getInstance();
        $req = $db->prepare('SELECT * FROM searches ORDER BY inc DESC LIMIT 1');
        $req->execute();
        $post = $req->fetch();
  
        return $post['lista'];
      }

  }

?>