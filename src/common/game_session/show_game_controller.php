<?php

/* 
* handle the request to show a game
*/
function handleRequestToShowGame($createGameLinkFunc, $retrieveGameInfosLinkFunc, $joinGameFunc) {
    global $data_forview;
    $gameSessionId = getAttributeValueFromHttpRequest("gamesessionid");

    require_once('backend/control/game_session.php');
    $gameSessionManager = new gameSessionManager();

    $gameSessionInfo = $gameSessionManager->getGameSessionInfo($gameSessionId);

    if( is_null($gameSessionInfo) ) {
        throw new Exception("There is no game session with ID $gameSessionId!");
    }

    $gameSessionState = $gameSessionInfo->getState();

    if( $gameSessionState == GameSessionState::$CREATED ) {
        handleRequestForLobby($gameSessionId, $gameSessionInfo, getUserId(), $gameSessionManager, $createGameLinkFunc, $retrieveGameInfosLinkFunc, $joinGameFunc);
    } else {
        throw new Exception("Unknown game state \"$gameSessionState\" for ID $gameSessionId!");
    }
}

/* 
* handles the request for the game state 'created' (the lobby)
*/
function handleRequestForLobby($gameSessionId, $gameSessionInfo, $userId, $gameSessionManager, $createGameLinkFunc, $retrieveGameInfosLinkFunc, $joinGameFunc) {
    global $data_forview, $showView;

    // user is already in game

    if( isUserIdInGameSessionUsers($userId, $gameSessionInfo) ) {
        $data_forview['shareLink'] = $createGameLinkFunc($gameSessionId);
        $data_forview['linkForRecievingGameInfosPerAjax'] = $retrieveGameInfosLinkFunc($gameSessionId);
        $data_forview['userId'] = $userId;

        $showView = 'game_lobby';
    } 
    
    // user is not yet in game

    else {
        $action = getAttributeValueFromHttpRequest("action");
        
        // user chose a name and wants to join the game
        
        if( $action == 'join') {
            handleRequestForLobbyWithChosenUserName($gameSessionManager, $createGameLinkFunc, $gameSessionId, $joinGameFunc);
            return;
        }

        // user did not choose a name yet

        $showView = 'join_game';
    }
    
}

/* 
* Handles the request for the game state 'created' (the lobby).
* Here the user has sent a user name for joining a game.
*/
function handleRequestForLobbyWithChosenUserName($gameSessionManager, $createGameLinkFunc, $gameSessionId, $joinGameFunc) {
    global $data_forview, $showView;

    $userName = getAttributeValueFromHttpRequest("username");
    $userNameCheckResult = $gameSessionManager->isUserNameValid($userName);
 
    // the user name is valid
 
    if( $userNameCheckResult == "" ) {
 
       // join the game session

       $gameSessionManager->createAndAddUserForGame(trim($userName), getUserId(), $gameSessionId);

       // join the specific game

       try {
            $joinGameFunc($gameSessionId);
       } catch (Exception $e) {
            $gameSessionManager->removeUserFromGameSession(getUserId(), $gameSessionId);
            $data_forview['error'] = "Can not join game: " . $e->getMessage();
            $showView = 'join_game';
            return;
       }

       // redirect browser to make a new request to show the game
 
       $redirectionLink = $createGameLinkFunc($gameSessionId);
       header("Location: $redirectionLink");
       die();
    }
 
    // the user name is invalid
 
    else {
 
       // show the create game view with the error message
 
       $data_forview['error'] = "Invalid username: " . $userNameCheckResult;
       $showView = 'join_game';
    }
}

?>