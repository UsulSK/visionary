<?php

/*
* Lets the user create a new game with himself as a user.
*/

require_once($controllerDir . '/../../../common/game_session/create_game_session_controller.php');

$createGameFunc = function($gameSessionId) {
    // this game has no extra game data (the game session is enough)

    return "";
};


require_once('createShowGameLinkFunc.php');

/*
* Create the HTTP-link to which redirects to the game.
*/
$createRedirectionLinkFunc = function($gameSessionId) {
    return createLinkWhichShowsInsiderGame($gameSessionId);
};

handleCreateGameRequest('create_game', $createRedirectionLinkFunc, $createGameFunc);

?>