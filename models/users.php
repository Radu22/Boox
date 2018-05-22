<?php
  class User {
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $username;
    public $password;
    public static $count_users;


    public function __construct($id, $firstname, $lastname, $email, $username, $password) {
      $this->id         = $id;
      $this->firstname  = $firstname;
      $this->lastname   = $lastname;
      $this->email      = $email;
      $this->username   = $username;
      $this->password   = $password;
    }

    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM users');
      
      foreach($req->fetchAll() as $post) {
        ++self::$count_users;
        $list[] = new User($post['user_id'], $post['user_first'], $post['user_last'],
            $post['user_email'], $post['user_uid'],$post['user_pwd']);
      }

      return $list;
    }

    public static function find($id) {
      $db = Db::getInstance();
      $id = intval($id);
      $req = $db->prepare('SELECT * FROM users WHERE user_id = :id');
      $req->execute(array(':id' => $id));
      $post = $req->fetch();

      return new User($post['user_id'], $post['user_first'], $post['user_last'],
      $post['user_email'], $post['user_uid'],$post['user_pwd']);
    }


  }
?>