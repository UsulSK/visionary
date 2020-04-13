<?php


$gameId = getAttributeValueFromHttpRequest("gameid");

$showView = handleRequest($gameId, $visionary, session_id());



// handle the request
function handleRequest($gameId, $visionary, $userId) {
    $shareLink_forview = createShareLink($gameId);

    $gameInfo = $visionary->getGameInfos($gameId);

    if( is_null($gameInfo) ) {
        throw new Exception("There is no game with ID $gameId!");
    }

    $gameState = $gameInfo->getState();

    if( $gameState == GameState::$CREATED ) {
        return handleRequestForLobby($gameId, $gameInfo, $userId);
    } else {
        throw new Exception("Unknown game state \"$gameState\" for ID $gameId!");
    }
}

// handles the request for the game state 'created' (the lobby)
function handleRequestForLobby($gameId, $gameInfo, $userId) {
    global $shareLink_forview, $getLobbyDataLink_forview;

    if( isUserIdInGameUsers($userId, $gameInfo) ) {
        $shareLink_forview = createShareLink($gameId);
        $getLobbyDataLink_forview = "?controller=game_infos&gameid=$gameId";

        return 'game_lobby';
    } else {
        return 'join_game';
    }
    
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