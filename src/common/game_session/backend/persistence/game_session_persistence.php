<?php

// For CRUD operations on the DB.

class GameSessionDB
{
    // names of database tables

    private static $GAME_SESSION_TABLE_NAME = 'Common_GameSession';
    private static $USER_TABLE_NAME = 'Common_User';

    //  the connection to the MYSQL-database
    private $db_conn;

    /* 
    * Constructor: Creates the connection to the MYSQL-database.
    */
    function __construct() {
        $pathToDbConfigs = __DIR__ . '/../../../db_configs.php';

        if (!file_exists($pathToDbConfigs)) {
            echo "The file $pathToDbConfigs does not exist! Please create it! ";
            echo "It must define the DB connection values with: db_servername, db_username, db_password, db_dbname.";
            die();
        }
        
        require_once($pathToDbConfigs);

        $this->db_conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
        
        if ($this->db_conn->connect_error) {
            throw new Exception("Connection failed: " . $this->db_conn->connect_error);
        } 
    }

    /* 
    * Deconstructor: Close SQL connection.
    */
    function __destruct() {
        $this->db_conn->close();
    }


    /*
    * Get all users for a game session.
    * $gameSessionId: The game session for which the users should be retrieved.
    * Returns: An array of users (entity: User).
    */
    private function getUsersForGameSession($gameSessionId) {
        $query = "SELECT * FROM " . self::$USER_TABLE_NAME . " WHERE GAME_SESSION_ID = $gameSessionId";
        
        $result = $this->db_conn->query($query);

        if ($this->db_conn->error) {
            throw new Exception("Retrieving of users failed for id $gameSessionId: " . $this->db_conn->error . '<br>Query: ' . $query);
        }

        $users = array();
        while($userInDb = $result->fetch_assoc()) {
            $user = new User($userInDb['NAME'], $userInDb['ID'], $userInDb['POSITION'], $userInDb['READY']);
            $users[] = $user;
        }

        return $users;
    }

    /*
    * Get all infos for a game session.
    * $gameSessionId: The game session for which the infos should be retrieved.
    * Returns: The infos about the game session (entity: GameInfo).
    */
    public function getGameSessionInfo($gameSessionId) {
        $query = "SELECT * FROM " . self::$GAME_SESSION_TABLE_NAME . " WHERE ID = $gameSessionId";
        
        $result = $this->db_conn->query($query);

        if ($this->db_conn->error) {
            throw new Exception("Retrieving of game session info failed for id $gameSessionId: " . $this->db_conn->error . '<br>Query: ' . $query);
        }
        $gameInDb = $result->fetch_assoc();

        if( is_null($gameInDb) ) { // no game found
            return null;
        }

        $users = $this->getUsersForGameSession($gameSessionId);

        $gameSessionInfo = new GameSessionInfo($users, $gameInDb['STATE']);

        return $gameSessionInfo;
    }

    /* 
    * Create a game session.
    * Return: The ID of the created game session
    */
    public function createGameSession() {
        $query = "INSERT INTO " . self::$GAME_SESSION_TABLE_NAME . " (STATE) VALUES (\"" . GameSessionState::$CREATED . "\")";
        
        $this->db_conn->query($query);

        if ($this->db_conn->error) {
            throw new Exception("Insert of game session failed: " . $this->db_conn->error . '<br>Query: ' . $query);
        }
        
        return $this->db_conn->insert_id;
    }

    /* 
    * Create a user for a game session.
    */
    public function createUserForGameSession($userName, $userId, $gameSessionId) {
        $query = "INSERT INTO " . self::$USER_TABLE_NAME . " (NAME, ID, GAME_SESSION_ID, POSITION, READY) ";
        $query = $query . " SELECT '" . $userName . "', '" . $userId . "', " . $gameSessionId . ", MAX(POSITION) + 1, FALSE";
        $query = $query . " FROM " . self::$USER_TABLE_NAME . " WHERE GAME_SESSION_ID = " . $gameSessionId;
        
        $this->db_conn->query($query);

        if ($this->db_conn->error) {
            throw new Exception("Insert of user $userName with ID $userId for game $gameSessionId failed: " . $this->db_conn->error . '<br>Query: ' . $query);
        }
    }

    /* 
    * Delete a game session from DB.
    * This should also delete all attached entities from other tables, because they should have a FK to this.
    * $gameSessionId: The ID of the game session which should be deleted.
    */
    public function removeGameSession($gameSessionId) {
        $query = "DELETE FROM " . self::$GAME_SESSION_TABLE_NAME . " WHERE ID = $gameSessionId";
        
        $this->db_conn->query($query);

        if ($this->db_conn->error) {
            throw new Exception("Removal of game session failed: " . $this->db_conn->error . '<br>Query: ' . $query);
        }
    }


    /* 
    * Get alle game sessions where the time since creation is greater then the given time.
    * $minutesSinceGameCreation: The time in minutes which should have passed since the game session creation.
    * Returns: An array of game session IDs.
    */
    public function getGameSessionsWhichAreOlderThenMinutes($minutesSinceGameSessionCreation) {
        $query = "SELECT * FROM " . self::$GAME_SESSION_TABLE_NAME . " WHERE CREATION_TIME + INTERVAL $minutesSinceGameSessionCreation MINUTE < NOW()";
        
        $result = $this->db_conn->query($query);

        if ($this->db_conn->error) {
            throw new Exception("Retrieval of old game sessions failed: " . $this->db_conn->error . '<br>Query: ' . $query);
        }

        $gameIds = array();
        while($gameInDb = $result->fetch_assoc()) {
            $gameIds[] = $gameInDb['ID'];
        }

        return $gameIds;
    }

    /* 
    * Delete game sessions from DB.
    * Other entities which belong to the game session should be removed automatically, because they should have a FK defined.
    * $gameSessionIds: Array of game session ids, which should be deleted.
    */
    public function removeGameSessions($gameSessionIds) {
        $query = "DELETE FROM " . self::$GAME_SESSION_TABLE_NAME . " WHERE ID IN (" . implode(',', $gameSessionIds) . ")";
        
        $this->db_conn->query($query);

        if ($this->db_conn->error) {
            throw new Exception("Removal of game sessions failed: " . $this->db_conn->error . '<br>Query: ' . $query);
        }
    }
    
    /* 
    * Remove a user from a game session.
    */
    public function removeUserFromGameSession($userId, $gameSessionId) {
        $query = "DELETE FROM " . self::$USER_TABLE_NAME . " WHERE ID = '" . $userId . "' AND GAME_SESSION_ID = $gameSessionId";
        
        $this->db_conn->query($query);

        if ($this->db_conn->error) {
            throw new Exception("Removal of user $userId from game session $gameSessionId failed: " . $this->db_conn->error . '<br>Query: ' . $query);
        }
    }
}
?>