<?php

// User wants to create a game

if(isset($_POST["action"]) && ($_POST["action"] == 'create') ) {

   // the username is valid

   if($visionary->isUserNameValid($_POST["username"])) {

      // create the game
      $gameId = $visionary->createGameWithUser($_POST["username"]);

      $users = $visionary->getUsersForGame($gameId);

      require('lobby_view.php');
   }

   // the username is invalid

   else {
      $error = "Invalid username!";
      require('creategame_view.php');
   }
}

// No action, so show the create game view

else {
   require('creategame_view.php'); 
}


?>