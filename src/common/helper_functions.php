<?php

/*
* Here global helper functions are defined which can then be used everywhere.
*/

/*
* Gets the value of an attribute from a HTTP request, no matter if it was a GET or POST request.
* Returns 'null' if the value was not sent in the HTTP request.
*/
function getAttributeValueFromHttpRequest($nameOfAttribute) {
    if( isset(($_POST[$nameOfAttribute])) ) {
        return $_POST[$nameOfAttribute];
    }
    else if( isset(($_GET[$nameOfAttribute])) ) {
        return $_GET[$nameOfAttribute];
    }

    return null;
}

/*
* Configure PHP to show as many errors as it can to help debugging
*/
function setPhpShowErrors() {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

/*
* Gets the ID of the current user.
* The ID is based on the session ID, so it is the same for each session.
* Reason the session ID is not used directly: Users will be given to clients along with their IDs.
*    So the session ID should not be used in order to prevent session hijacking.
*/
function getUserId() {
    return sha1(session_id());
}

/*
* check if a user with a certain ID is already part of the game session
*/
function isUserIdInGameSessionUsers($userId, $gameSessionInfo) {
    $userIdsOfGameSession = $gameSessionInfo->getUsers();
    foreach ($userIdsOfGameSession as $userIdOfUserInGameSession) {
        if( $userIdOfUserInGameSession->getId() == $userId ) {
            return true;
        }
    }

    return false;
}

?>