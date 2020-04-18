<?php


$gameId = getAttributeValueFromHttpRequest("gameid");

handleRequest($gameId, $visionary, session_id());



// handle the request
function handleRequest($gameId, $visionary, $userId) {
    $shareLink_forview = createShareLink($gameId);

    $gameInfo = $visionary->getGameInfos($gameId);

    if( is_null($gameInfo) ) {
        throw new Exception("There is no game with ID $gameId!");
    }

    $gameState = $gameInfo->getState();

    if( $gameState == GameState::$CREATED ) {
        handleRequestForLobby($gameId, $gameInfo, $userId, $visionary);
    } else {
        throw new Exception("Unknown game state \"$gameState\" for ID $gameId!");
    }
}

// handles the request for the game state 'created' (the lobby)
function handleRequestForLobby($gameId, $gameInfo, $userId, $visionary) {
    global $shareLink_forview, $getLobbyDataLink_forview, $showView;

    // user is already in game

    if( isUserIdInGameUsers($userId, $gameInfo) ) {
        $shareLink_forview = createShareLink($gameId);
        $getLobbyDataLink_forview = "?controller=game_infos&gameid=$gameId";

        $showView = 'game_lobby';
    } 
    
    // user is not yet in game

    else {
        $action = getAttributeValueFromHttpRequest("action");
        
        // user chose a name and wants to join the game
        
        if( $action == 'join') {
            handleRequestForLobbyWithChosenUserName($visionary);
            return;
        }

        // user did not choose a name yet

        $showView = 'join_game';
    }
    
}

// Handles the request for the game state 'created' (the lobby).
// Here the user has sent a user name for joining a game.
function handleRequestForLobbyWithChosenUserName($visionary) {
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
       $showView = 'join_game';
    }
}

// Create the HTTP-link to which redirects to the game.
function createRedirectionLink($gameId) {
    $protocoll = "http://";
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
       $protocoll = "https://";
    }
    
    $redirectionLink = $protocoll . $_SERVER['SERVER_NAME'] . '/?controller=show_game&gameid=' . $gameId;
 
    return $redirectionLink;
 }
 
// Create the HTTP-link to share the game for other users.
function createShareLink($gameId) {
    $protocoll = "http://";
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
       $protocoll = "https://";
    }
    
    $shareLink = $protocoll . $_SERVER['SERVER_NAME'] . '/?controller=show_game&gameid=' . $gameId;
 
    return $shareLink;
 }
?>