<?php

// This controls games.

class Game 
{
    // Check if a user name is valid
    public static function isUserNameValid($userName) {
        if(!isset($userName)) {
            return false;
        }

        $trimmedUserName = trim($userName);

        if( strlen($trimmedUserName) < 4 ) {
            return false;
        }

        if( strlen($trimmedUserName) > 15 ) {
            return false;
        }

        if (!preg_match('/^[A-Za-z0-9]+$/', $trimmedUserName))  {
            return false;
        }

        return true;
    }

    // Create a game with a user
    // Return: The ID of the created game
    public static function createGameWithUser($userName) {
        if(!Game::isUserNameValid($userName)) {
            throw new Exception("Invalid username: $userName");
        }

        $trimmedUserName = trim($userName);

        $gameId = DB::createGame();

        DB::createUserForGame($trimmedUserName, session_id(), $gameId);

        return $gameId;
    }
}

?>