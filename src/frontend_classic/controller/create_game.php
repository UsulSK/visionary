<?php

$action = getAttributeValueFromHttpRequest("action");

// If user wants to create a game...

if( $action == 'create' ) {

   $userName = getAttributeValueFromHttpRequest("username");
   $userNameCheckResult = $visionary->isUserNameValid($userName);

   // the user name is valid

   if( $userNameCheckResult == "" ) {

      // create the game

      $gameId = $visionary->createGameWithUser($userName, session_id());

      // redirect browser to make a new request to show the game

      $redirectionLink = createRedirectionLink($gameId);
      header("Location: $redirectionLink");
      die();
   }

   // the user name is invalid

   else {

      // show the create game view with the error message

      $error_forview = "Invalid username: " . $userNameCheckResult;
      
      $showView = 'create_game';
   }
}

// No action was given in HTTP request

else {
   
   // show the create game view

   $showView = 'create_game';
}


// =========== functions ==========


// Create the HTTP-link to which redirects to the game.
function createRedirectionLink($gameId) {
    $protocoll = "http://";
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
       $protocoll = "https://";
    }
    
    $redirectionLink = $protocoll . $_SERVER['SERVER_NAME'] . '/?controller=show_game&gameid=' . $gameId;
 
    return $redirectionLink;
 }

?>