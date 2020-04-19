<?php


/*
* Get the game session infos for the game session which was requested by the current HTTP request.
* This also checks if the current User is in the game. If not, then (s)he is not allowed to retrieve these infos.
*/
function getGameSessionInfos() {
    require_once('backend/control/game_session.php');
    $gameSessionManager = new GameSessionManager();

    $gameSessionId = getAttributeValueFromHttpRequest("gamesessionid");
    $gameSessionInfo = $gameSessionManager->getGameSessionInfo($gameSessionId);

    if( !isUserIdInGameSessionUsers(getUserId(), $gameSessionInfo) ) {
        throw new Exception("Not allowed! User with ID $userId is not a user of game with ID $gameSessionInfo!");
    }

    return $gameSessionInfo;
}

/*
* Return an object as JSON to the client.
*/
function returnLobbyDataAsJson($objectToShowAsJson) {
    global $showView;

    $objectAsJson = json_encode($objectToShowAsJson);

    header('Content-Type: application/json'); // set header of HTTP response to JSON

    echo $objectAsJson;

    $showView = null; // this is requested by AJAX and the output is JSON => no HTML view
}

?>