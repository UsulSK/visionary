<?php

/*
* Returns game infos as JSON (for AJAX requests).
*/


require_once(__DIR__ . '/../../../common/game_session/game_infos_controller.php');

$gameSessionInfo = getGameSessionInfos();

returnLobbyDataAsJson($gameSessionInfo);

?>