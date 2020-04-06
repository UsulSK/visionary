<?php

// This is the Facade for visionary games. It provides the whole API.

require_once('control/game.php');
require_once('persistence/db.php');

class Visionary 
{
    /* 
    * Standard constructor.
    * This is the reason why this class does not provide static methods but needs to be instanziated: So that the constructor is guaranteed to be called 
    * and the DB connection gets initialized.
    */
    function __construct() {
        DB::initDbConnection();
    }

    // Check if a user name is valid
    public function isUserNameValid($userName) {
        return Game::isUserNameValid($userName);
    }

    // Create a game with a user
    // Return: The ID of the created game
    public function createGameWithUser($userName) {
        return Game::createGameWithUser($userName);
    }

    // Get all users for a game
    public function getUsersForGame($gameId) {
        $users = DB::getUsersForGame($gameId);

        return $users;
    }
}

?>