<?php


/*
* Creates a game session, if the user has sent the request to do so and if the checks succeed.
* $createGameView: the view to show if the user called the controller for the first time or if errors occured
* $createRedirectionLinkFunc: The function which creates the redirection link to which the user will be redirected if the game creation was successfull.
*     This function must take the game-ID as parameter and return a link as string.
* $createGameFunc: Function for creating the game. This must take the game-session-id as a parameter. It must return an error text if an error occured, otherwise "".
*/
function handleCreateGameRequest($createGameView, $createRedirectionLinkFunc, $createGameFunc) {
    global $showView, $data_forview;

    $action = getAttributeValueFromHttpRequest("action");

    // If user wants to create a game...
    
    if( $action == 'create' ) {
        $userName = getAttributeValueFromHttpRequest("username");

        require_once('backend/control/game_session.php');
        $gameSessionManager = new GameSessionManager();

        $userNameCheckResult = $gameSessionManager->isUserNameValid($userName);
        
        // the user name is invalid
     
        if( $userNameCheckResult != "" ) {
           // prepare the error message for the view
           $data_forview['error'] = "Invalid username: " . $userNameCheckResult;
           
           // show the create game view
           $showView = $createGameView;
           return;
        }
     
        // the user name is valid
     
        // create the game
     
        $gameSessionId = $gameSessionManager->createGameSessionWithUser($userName, getUserId());
        $createGameResult = $createGameFunc($gameSessionId);
        
        // the creation of the game failed
     
        if( $createGameResult != "" ) {
           // delete the game session
           $gameSessionManager->removeGameSession($gameSessionId);

           // prepare the error message for the view
           $data_forview['error'] = "Can not create game: " . $createGameResult;
           
           // show the create game view
           $showView = $createGameView;
           return;
        }
     
        // redirect browser to make a new request to show the game
     
        $redirectionLink = $createRedirectionLinkFunc($gameSessionId);
        header("Location: $redirectionLink");
        die();
    }

    // No action was given in HTTP request

    else {
        // show the create game view
        $showView = $createGameView;
    }
}


?>