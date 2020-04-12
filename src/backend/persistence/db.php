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

    // Create a game.
    // Return: The ID of the created game
    public function createGame() {
        $query = "INSERT INTO " . self::$GAME_TABLE_NAME . " VALUES ()";
        
        $this->db_conn->query($query);

        if ($this->db_conn->error) {
            die("Insert failed: " . $this->db_conn->error);
        }
        
        return $this->db_conn->insert_id;
    }

    // Create a user for a game.
    public function createUserForGame($userName, $userId, $gameId) {
        $query = "INSERT INTO " . self::$USER_TABLE_NAME . " (NAME, ID, GAME_ID) VALUES ('$userName', '$userId', $gameId)";
        
        $this->db_conn->query($query);

        if ($this->db_conn->error) {
            die("Insert failed: " . $this->db_conn->error);
        }
    }

    // Create a user for a game.
    public function getUsersForGame($gameId) {
        $query = "SELECT * FROM " . self::$USER_TABLE_NAME . " WHERE GAME_ID = $gameId";
        
        $result = $this->db_conn->query($query);

        if ($this->db_conn->error) {
            die("Insert failed: " . $this->db_conn->error);
        }

        $users = array();
        while($userInDb = $result->fetch_assoc()) {
            $users[] = $userInDb['NAME'];
        }

        return $users;
    }
}

?>