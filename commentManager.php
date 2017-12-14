<?php
if(!isset($_SESSION))
{
    session_start();
}
include("dbconnect.php");

$currentPage = $_SESSION['currentRecipe'];

//////////////////////////////////////////////////////
//////////////////COMMENT INSERTION///////////////////
//////////////////////////////////////////////////////

if (isset($_POST['comment'])) {
  $userName = $_SESSION['login_user'];
  $comment = filter_input(INPUT_POST, 'comment');
  $date = date('Y-m-d');
  $sql = "INSERT INTO $currentPage (username, date, comment) VALUES ('$userName', '$date', '$comment')";
  $commentSuccess = mysqli_query($db, $sql);


  if (!$commentSuccess) {
      echo("Unable to save comment at this time.");
  }
}

//////////////////////////////////////////////////////
//////////////////COMMENT RETRIEVAL///////////////////
//////////////////////////////////////////////////////


if (!filter_input_array(INPUT_POST)) {

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
           $_SESSION['currentComments'] = $comments;
           echo \json_encode($comments);
           return;

}

//////////////////////////////////////////////////////
//////////////////COMMENT DELETION////////////////////
//////////////////////////////////////////////////////

if (filter_input(INPUT_POST, 'delete')) {


    $toDelete = filter_input(INPUT_POST, 'delete');
    $sql = "DELETE FROM $currentPage WHERE id='$toDelete'";
    $result = mysqli_query($db, $sql);
}
?>
