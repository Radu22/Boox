<?php
  class Book {
    public $book_id;
    public $user_id;
    public $book_title;
    public $book_author;
    public $isbn;
    public $description;
    public $book_type;
    public $duration;
    public $language;

    public function __construct($book_id, $user_id, $book_title, $book_author, $isbn, $book_type, $duration, $language, $description = '') {
      $this->book_id = $book_id;
      $this->user_id = $user_id;
      $this->book_title = $book_title;
      $this->book_author= $book_author;
      $this->isbn= $isbn;
      $this->description = $description;
      $this->book_type = $book_type;
      $this->duration= $duration;
      $this->language =  $language;
    }


  }

?>