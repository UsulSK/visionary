<?php

require_once(__DIR__ . '/../../../common/game_session/show_game_controller.php');

require_once('createShowGameLinkFunc.php');

/*
* Create the HTTP link which shows the game.
*/
$createGameLinkFunc = function($gameSessionId) {
    return createLinkWhichShowsInsiderGame($gameSessionId);
};

/*
* Create the HTTP link to which is used to retrieve game infos (for example with Ajax).
*/
$retrieveGameInfosLinkFunc = function($gameSessionId) {
    $protocoll = "http://";
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
       $protocoll = "https://";
    }
    
    $retrieveGameInfosLink = $protocoll . $_SERVER['SERVER_NAME'] . '/insider/frontend_classic/controller/insider.php?controller=insider_game_infos&gamesessionid=' . $gameSessionId;
 
    return $retrieveGameInfosLink;
 };

/*
* Add a user to a game of insider.
*/
$joinGameFunc = function($gameSessionId) {
    // no specific game needed
};

handleRequestToShowGame($createGameLinkFunc, $retrieveGameInfosLinkFunc, $joinGameFunc);

?>