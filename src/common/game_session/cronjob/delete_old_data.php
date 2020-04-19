<?php

/*
* Clean old data in the database.
* Outputs some logging infos in case this script is called directly from browser for debugging purposes.
* This script should be run once in a while as a cronjob by your PHP hoster!
*/

setPhpShowErrors();

try {
    require_once(__DIR__ . '/../backend/control/game_session.php');
    $gameSessionManager = new GameSessionManager();

    $minutesAfterGameSessionWasCreatedUntilItShouldBeDeleted = 60 * 24;    //=one day
    $oldGameSessionIds = $gameSessionManager->getGameSessionsWhichAreOlderThenMinutes($minutesAfterGameSessionWasCreatedUntilItShouldBeDeleted);

    echo 'Old games: <br>';
    var_dump($oldGameSessionIds);
    echo '<br>';

    $gameSessionManager->removeGameSessions($oldGameSessionIds);

    echo 'Done! <br>';
} catch (Exception $error) {
    echo '<p><b><font color="red">Error:<br>' . $error->getMessage() . '</font></b></p>';
}

// =========== functions ==========


// Configure PHP to show as many errors as it can to help debugging
function setPhpShowErrors() {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

?>