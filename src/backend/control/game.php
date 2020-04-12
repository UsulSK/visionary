<?php

// This controls games.

class Game 
{
    // handles database CRUD
    private $db;

    //  Constructor
    //  $db: The database connection.
    function __construct($db) {
        $this->db = $db;
    }

    // Check if a user name is valid.
    // Returns: Empty string -> User name is valid. Not empty string: The error message for the invalid user-name.
    public function isUserNameValid($userName) {
        if(!isset($userName)) {
            return "No user name was given!";
        }

        $trimmedUserName = trim($userName);

        $minCharacterNr = 3;
        if( strlen($trimmedUserName) < $minCharacterNr ) {
            return "The user name must be more then $minCharacterNr characters long!";
        }

        $maxCharacterNr = 15;
        if( strlen($trimmedUserName) >= $maxCharacterNr ) {
            return "The user name must be less then $maxCharacterNr characters long!";
        }

        if (!preg_match('/^[A-Za-z0-9]+$/', $trimmedUserName))  {
            return "The user name must only contain English characters or decimal digits!";
        }

        return "";
    }

    // Create a game with a user
    // Return: The ID of the created game
    public function createGameWithUser($userName, $userId) {
        $userNameCheckResult = $this->isUserNameValid($userName);
        if( $userNameCheckResult != "" ) {
            throw new Exception("Invalid username: $userNameCheckResult");
        }

        $trimmedUserName = trim($userName);

        $gameId = $this->db->createGame();

        $this->db->createUserForGame($trimmedUserName, $userId, $gameId);

        return $gameId;
    }

    // See: DB->getGamesWhichAreOlderThenMinutes(...)
    public function removeGames($gameIds) {
        $this->db->removeGames($gameIds);
    }
}

?>