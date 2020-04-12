<?php

// This is the Facade for visionary games. It provides the whole API.
// So this is the Gateway to the game logic.

require_once('control/game.php');
require_once('persistence/db.php');

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

    // Check if a user name is valid
    public function isUserNameValid($userName) {
        return $this->game->isUserNameValid($userName);
    }

    // Create a game with a user
    // Return: The ID of the created game
    public function createGameWithUser($userName, $userId) {
        return $this->game->createGameWithUser($userName, $userId);
    }

    // Get all users for a game
    public function getUsersForGame($gameId) {
        $users = $this->db->getUsersForGame($gameId);

        return $users;
    }
}

?>