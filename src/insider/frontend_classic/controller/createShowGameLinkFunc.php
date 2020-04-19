<?php

/*
* This function is defined in an extra file, because it is used in several controllers.
*/

/*
* Create the HTTP link which shows a game.
*/
function createLinkWhichShowsInsiderGame($gameSessionId) {
    $protocoll = "http://";
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
       $protocoll = "https://";
    }
    
    $showGameLink = $protocoll . $_SERVER['SERVER_NAME'] . '/insider/frontend_classic/controller/insider.php?controller=show_game&gamesessionid=' . $gameSessionId;
 
    return $showGameLink;
 };


?>