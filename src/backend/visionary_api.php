<?php

/* 
* This is the Facade for visionary games. It provides the whole API.
* So this is the Gateway to the game logic.
*/


require_once('control/game.php');
require_once('persistence/db.php');

//  entities

require_once('entities/user.php');
require_once('entities/game_info.php');
require_once('entities/game_state.php');


class VisionaryFacade
{
    // handles database CRUD
    private $db;

    // represents games
    private $game;

    /* 
    * Standard constructor.
    * This is the reason why this class does not provide static methods but needs to be instanziated: So that the constructor is guaranteed to be called 
    * and the DB connection gets initialized.
    */
    function __construct() {
        $this->db = new DB();
        $this->game = new Game($this->db);
    }

    // See: Game->isUserNameValid(...)
    public function isUserNameValid($userName) {
        return $this->game->isUserNameValid($userName);
    }

    // See: Game->createGameWithUser(...)
    public function createGameWithUser($userName, $userId) {
        return $this->game->createGameWithUser($userName, $userId);
    }

    // See: Game->getGameInfos(...)
    public function getGameInfos($gameId) {
        $gameInfos = $this->game->getGameInfos($gameId);

        return $gameInfos;
    }

    // See: DB->getGamesWhichAreOlderThenMinutes(...)
    public function getGamesWhichAreOlderThenMinutes($minutesSinceGameCreation) {
        $gameIds = $this->db->getGamesWhichAreOlderThenMinutes($minutesSinceGameCreation);

        return $gameIds;
    }

    // See: Game->getGamesWhichAreOlderThenMinutes(...)
    public function removeGames($gameIds) {
        $this->game->removeGames($gameIds);
    }
}

?>