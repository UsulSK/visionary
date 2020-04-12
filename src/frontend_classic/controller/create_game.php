<?php

$action = getAttributeValueFromHttpRequest("action");

// If user wants to create a game...

if( $action == 'create' ) {

   $userName = getAttributeValueFromHttpRequest("username");
   $userNameCheckResult = $visionary->isUserNameValid($userName);

   // the username is valid

   if( $userNameCheckResult == "" ) {

      // create the game
      $gameId = $visionary->createGameWithUser($userName, session_id());

      $shareLink_forview = createShareLink($gameId);

      $getLobbyDataLink_forview = "?controller=game_lobby&action=lobby_data&gameid=$gameId";

      $showView = 'game_lobby';
   }

   // the username is invalid

   else {
      $error_forview = "Invalid username: " . $userNameCheckResult;
      
      $showView = 'create_game';
   }
}

// No action: Show the create game view

else {
   $showView = 'create_game';
}


// =========== functions ==========


// Create the HTTP-link to share the game for other users.
function createShareLink($gameId) {
   $protocoll = "http://";
   if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
      $protocoll = "https://";
   }
   
   $shareLink = $protocoll . $_SERVER['SERVER_NAME'] . '/?controller=join_game&gameid=' . $gameId;

   return $shareLink;
}



?>