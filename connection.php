<?php
  class Db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=dba';
        $user = 'tw';
        $pass = 'root';
        self::$instance = new PDO($dsn, $user, $pass, $pdo_options);
      }
      return self::$instance;
    }
  }
?>