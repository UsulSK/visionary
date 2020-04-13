<?php

// For CRUD operations on the DB.

class DB 
{
    // names of database tables

    private static $GAME_TABLE_NAME = 'Visionary_Game';
    private static $USER_TABLE_NAME = 'Visionary_User';

    //  the connection to the MYSQL-database
    private $db_conn;

    //  Constructor
    //  Creates the connection to the MYSQL-database.
    function __construct() {
        if (!file_exists(__DIR__ . '/db_configs.php')) {
            echo "The file db_configs.php does not exist! Upload it in the same folder as db.php. ";
            echo "It must define the DB connection values with: db_servername, db_username, db_password, db_dbname.";
            die();
        }
        
        require_once('db_configs.php');

        $this->db_conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
        
        if ($this->db_conn->connect_error) {
            die("Connection failed: " . $this->db_conn->connect_error);
        } 
    }

    // Deconstructor: Close SQL connection.
    function __destruct() {
        $this->db_conn->close();
    }

    // Create a game.
    // Return: The ID of the created game
    public function createGame() {
        $query = "INSERT INTO " . self::$GAME_TABLE_NAME . " (STATE) VALUES (\"" . GameState::$CREATED . "\")";
        
        $this->db_conn->query($query);

        if ($this->db_conn->error) {
            die("Insert of game failed: " . $this->db_conn->error . '<br>Query: ' . $query);
        }
        
        return $this->db_conn->insert_id;
    }

    // Create a user for a game.
    public function createUserForGame($userName, $userId, $gameId, $position) {
        $query = "INSERT INTO " . self::$USER_TABLE_NAME . " (NAME, ID, GAME_ID, POSITION) VALUES ('$userName', '$userId', $gameId, $position)";
        
        $this->db_conn->query($query);

        if ($this->db_conn->error) {
            die("Insert of user failed: " . $this->db_conn->error . '<br>Query: ' . $query );
        }
    }

    // Get all infos for a game.
    // $gameId: The game for which the infos should be retrieved.
    // Returns: The infos about the game (entity: GameInfo).
    public function getGameInfos($gameId) {
        $query = "SELECT * FROM " . self::$GAME_TABLE_NAME . " WHERE ID = $gameId";
        
        $result = $this->db_conn->query($query);

        if ($this->db_conn->error) {
            die("Query failed: " . $this->db_conn->error . '<br>Query: ' . $query );
        }
        $gameInDb = $result->fetch_assoc();

        if( is_null($gameInDb) ) { // no game found
            return null;
        }

        $users = $this->getUsersForGame($gameId);

        $gameInfo = new GameInfo($users, $gameInDb['STATE']);

        return $gameInfo;
    }

    // Get all users for a game.
    // $gameId: The game for which the users should be retrieved.
    // Returns: An array of users (entity: User).
    private function getUsersForGame($gameId) {
        $query = "SELECT * FROM " . self::$USER_TABLE_NAME . " WHERE GAME_ID = $gameId";
        
        $result = $this->db_conn->query($query);

        if ($this->db_conn->error) {
            die("Query failed: " . $this->db_conn->error . '<br>Query: ' . $query );
        }

        $users = array();
        while($userInDb = $result->fetch_assoc()) {
            $user = new User($userInDb['NAME'], $userInDb['ID'], $userInDb['POSITION']);
            $users[] = $user;
        }

        return $users;
    }

    // Get alle Games where the time since creation is greater then the given time.
    // $minutesSinceGameCreation: The time in minutes which should have passed since the game creation.
    // Returns: An array of game IDs.
    public function getGamesWhichAreOlderThenMinutes($minutesSinceGameCreation) {
        $query = "SELECT * FROM " . self::$GAME_TABLE_NAME . " WHERE CREATION_TIME + INTERVAL $minutesSinceGameCreation MINUTE < NOW()";
        
        $result = $this->db_conn->query($query);

        if ($this->db_conn->error) {
            die("Query failed: " . $this->db_conn->error . '<br>Query: ' . $query );
        }

        $gameIds = array();
        while($gameInDb = $result->fetch_assoc()) {
            $gameIds[] = $gameInDb['ID'];
        }

        return $gameIds;
    }

    // Delete games from DB, with everything which belongs to them (for example: Users).
    // $gameIds: Array of game ids, which should be deleted.
    public function removeGames($gameIds) {

        // delete all users which belong to these games

        $query = "DELETE FROM " . self::$USER_TABLE_NAME . " WHERE GAME_ID IN (" . implode(',', $gameIds) . ")";
        
        $this->db_conn->query($query);

        if ($this->db_conn->error) {
            die("Query failed: " . $this->db_conn->error . '<br>Query: ' . $query );
        }

        // delete all games

        $query = "DELETE FROM " . self::$GAME_TABLE_NAME . " WHERE ID IN (" . implode(',', $gameIds) . ")";
        
        $this->db_conn->query($query);

        if ($this->db_conn->error) {
            die("Query failed: " . $this->db_conn->error . '<br>Query: ' . $query );
        }
    }
}

?>