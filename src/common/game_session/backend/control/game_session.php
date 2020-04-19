<?php

require_once(__DIR__ . '/../entities/game_session_state.php');
require_once(__DIR__ . '/../entities/user.php');
require_once(__DIR__ . '/../entities/game_session_info.php');
require_once(__DIR__ . '/../persistence/game_session_persistence.php');

class GameSessionManager
{
    // handles database CRUD
    private $db;

    /* 
    * Constructor
    * $db: The database connection.
    */
    function __construct() {
        $this->db = new GameSessionDB();
    }

    /* 
    * See: GameSessionDB->getGameSessionsWhichAreOlderThenMinutes(...)
    */
    public function getGameSessionsWhichAreOlderThenMinutes($minutesSinceGameSessionCreation) {
        return $this->db->getGameSessionsWhichAreOlderThenMinutes($minutesSinceGameSessionCreation);
    }

    /* 
    * See: GameSessionDB->getGameInfo(...)
    */
    public function getGameSessionInfo($gameSessionId) {
        return $this->db->getGameSessionInfo($gameSessionId);
    }

    /* 
    * Check if a user name is valid.
    * Returns: Empty string -> User name is valid. Not empty string: The error message for the invalid user-name.
    */
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

    public function createGameSessionWithUser($userName, $userId) {
        if( !isset($userId) || (strlen($userId) == 0) ) {
            throw new Exception("The user ID must not be empty!");
        }

        $userNameCheckResult = $this->isUserNameValid($userName);
        if( $userNameCheckResult != "" ) {
            throw new Exception("Invalid username: $userNameCheckResult");
        }

        $trimmedUserName = trim($userName);

        $gameId = $this->db->createGameSession();

        $this->db->createUserForGameSession($trimmedUserName, $userId, $gameId);

        return $gameId;
    }

    /* 
    * See: GameSessionDB->removeGameSession(...)
    */
    public function removeGameSession($gameSessionId) {
        $this->db->removeGameSession($gameSessionId);
    }

    /* 
    * See: GameSessionDB->removeGameSessions(...)
    */
    public function removeGameSessions($gameSessionIds) {
        $this->db->removeGameSessions($gameSessionIds);
    }


    /* 
    * Add a new user to a game session.
    */
    public function createAndAddUserForGame($userName, $userId, $gameSessionId) {
        if( !isset($userId) || (strlen($userId) == 0) ) {
            throw new Exception("The user ID must not be empty!");
        }

        $userNameCheckResult = $this->isUserNameValid($userName);
        if( $userNameCheckResult != "" ) {
            throw new Exception("Invalid username: $userNameCheckResult");
        }

        $trimmedUserName = trim($userName);
        $this->db->createUserForGameSession($trimmedUserName, $userId, $gameSessionId);
    }
    
    /* 
    * See: GameSessionDB->removeUserFromGameSession(...)
    */
    public function removeUserFromGameSession($userId, $gameSessionId) {
        $this->db->removeUserFromGameSession($userId, $gameSessionId);
    }
}

?>