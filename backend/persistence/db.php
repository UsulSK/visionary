<?php

// For CRUD operations on the DB.

require_once('db_configs.php');

class DB 
{
    private static $GAME_TABLE_NAME = 'Visionary_Game';
    private static $USER_TABLE_NAME = 'Visionary_User';

    // Initializes the connection to the DB
    public static function initDbConnection() {
        global $db_conn;

        $db_conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($db_conn->connect_error) {
            die("Connection failed: " . $db_conn->connect_error);
        } 
    }

    // Create a game.
    // Return: The ID of the created game
    public static function createGame() {
        global $db_conn;

        $query = "INSERT INTO " . self::$GAME_TABLE_NAME . " VALUES ()";
        
        $db_conn->query($query);

        if ($db_conn->error) {
            die("Insert failed: " . $db_conn->error);
        }
        
        return $db_conn->insert_id;
    }

    // Create a user for a game.
    public static function createUserForGame($userName, $sessionId, $gameId) {
        global $db_conn;

        $query = "INSERT INTO " . self::$USER_TABLE_NAME . " (NAME, ID, GAME_ID) VALUES ('$userName', '$sessionId', $gameId)";
        
        $db_conn->query($query);

        if ($db_conn->error) {
            die("Insert failed: " . $db_conn->error);
        }
    }

    // Create a user for a game.
    public static function getUsersForGame($gameId) {
        global $db_conn;

        $query = "SELECT * FROM " . self::$USER_TABLE_NAME . " WHERE GAME_ID = $gameId";
        
        $result = $db_conn->query($query);

        if ($db_conn->error) {
            die("Insert failed: " . $db_conn->error);
        }

        $users = array();
        while($userInDb = $result->fetch_assoc()) {
            $users[] = $userInDb['NAME'];
        }

        return $users;
    }
}

?>