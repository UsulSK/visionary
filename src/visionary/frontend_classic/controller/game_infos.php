<?php

/*
* Returns game infos as JSON (for AJAX requests).
*/

$gameId = getAttributeValueFromHttpRequest("gameid");

returnLobbyDataAsJson($gameId, $visionary, session_id());

$showView = null; // this is requested by AJAX and the output is JSON => no HTML view



// Return (to the browser) the lobby data as JSON.
// $gameId: The game ID for which the lobby data should be returned.
// $visionary: The game logic (=backend).
// $userId: The ID of the current user.
function returnLobbyDataAsJson($gameId, $visionary, $userId) {
    $gameInfo = $visionary->getGameInfos($gameId);

    if( !isUserIdInGameUsers($userId, $gameInfo) ) {
        throw new Exception("Not allowed! User with ID $userId is not a user of game with ID $gameId!");
    }

    $lobbyDataJson = json_encode($gameInfo);

    header('Content-Type: application/json'); // set header of HTTP response to JSON

    echo $lobbyDataJson;
}

?>