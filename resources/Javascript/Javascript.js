$(document).ready(function () {
initializeComments();

  function initializeComments(){
  $.getJSON("commentManager.php", function (array) {
        $(".comments").html("");
        appending(array);
  })
  longPolling();
}

function appending(array)
{
  for (var i = 0, len = array.length; i < len; i++) {
    if(array[i].isDeleteable)
    {
    $(".comments").append($('<button id="deleteButton" name="delete">Delete</button>').click({id:array[i].id},deleteComment));
    }
    $(".comments").append('<p id="username">' + array[i].userName + ":</p>");
    $(".comments").append('<p id="comment">' + array[i].comment + "</p>");
    $(".comments").append('<p id="date">' + array[i].date + ":</p>");
 }
}

$("#comment").click(function () {
    $.post("commentManager.php", $("#commentText").serialize());
    $("#commentText").val("");
    longPolling();
  })

function deleteComment(id) {
     $.post("commentManager.php", {delete:id.data.id});
     longPolling();
  }

  function longPolling(){
  $.getJSON("longPolling.php", function (array) {
        $(".comments").html("");
        appending(array);
       longPolling();
  })
}


});
