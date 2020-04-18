<?php

/*
* Clean old data in the database.
* Outputs some logging infos in case this script is called directly from browser for debugging purposes.
* This script should be run once in a while as a cronjob by your PHP hoster!
*/

setPhpShowErrors();

require_once(__DIR__ . '/../backend/visionary_api.php');
$visionary = new VisionaryFacade();

$minutesAfterGameWasCreatedUntilItShouldBeDeleted = 60 * 24;    //=one day
$oldGameIds = $visionary->getGamesWhichAreOlderThenMinutes($minutesAfterGameWasCreatedUntilItShouldBeDeleted);

echo 'Old games: <br>';
var_dump($oldGameIds);
echo '<br>';

$visionary->removeGames($oldGameIds);

echo 'Done! <br>';

// =========== functions ==========


// Configure PHP to show as many errors as it can to help debugging
function setPhpShowErrors() {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

?>