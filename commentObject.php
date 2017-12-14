<?php
Class comment
{
  private $userName;
  private $comment;
  private $date;

  public function __construct($userName, $comment) {
      $this->userName = $userName;
      $this->comment = $comment;
      $this->date = date('Y-m-d');
  }

  public function getUserName() {
      return $this->userName;
  }

  public function getComment() {
      return $this->comment;
  }

  public function getDate() {
      return $this->date;
  }
  }
