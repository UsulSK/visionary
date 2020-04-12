<?php

$action = getAttributeValueFromHttpRequest("action");
$gameId = getAttributeValueFromHttpRequest("gameid");

// Get lobby data for the lobby view. Lobby data: Users

if( $action == 'lobby_data' ) {
    returnLobbyDataAsJson($gameId, $visionary);

    $showView = null; // this is requested by AJAX and the output is JSON => no HTML view
}



// =========== functions ==========


// Return (to the browser) the lobby data as JSON.
// $gameId: The game ID for which the lobby data should be returned.
// $visionary: The game logic (=backend).
function returnLobbyDataAsJson($gameId, $visionary) {
    $users = $visionary->getUsersForGame($gameId);

    $lobbyData = (object) ['users' => $users];
    $lobbyDataJson = json_encode($lobbyData);

    header('Content-Type: application/json'); // set header of HTTP response to JSON

    echo $lobbyDataJson;
}

?>