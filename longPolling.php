<?php

if(!isset($_SESSION))
{
    session_start();
}

include("dbconnect.php");
\set_time_limit(0);
$currentPage = $_SESSION['currentRecipe'];

while(TRUE){
  $comments = array();
  $sql = "SELECT id, username, date, comment FROM $currentPage";
  $result = mysqli_query($db, $sql);

  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $comment = new \stdClass();
    $comment->isDeleteable=false;
  if (isset($_SESSION['login_user']) && $row['username'] == $_SESSION['login_user']) {
    $comment->isDeleteable = true;
    $comment->id = $row['id'];
       }
      $comment->userName = $row['username'];
      $comment->comment = $row['comment'];
      $comment->date = $row['date'];
      array_push($comments, $comment);
   }
       if ($_SESSION['currentComments'] != $comments){
         $_SESSION['currentComments'] = $comments;
           echo \json_encode($comments);
           return;
       }

       \session_write_close();
       \sleep(1);
       \session_start();

}
?>
