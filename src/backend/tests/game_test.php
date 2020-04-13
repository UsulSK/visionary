<?php

require_once(__DIR__ . '/../visionary_api.php');

/** 
* This tests game creation.
*
* [TEST]
*/
class CreateGameTest
{
    private $sut;
    private $commonGameId;

    /**
    * [BEFORECLASS]
    */
    public function initTests() {
        $this->sut = new VisionaryFacade();
        $this->commonGameId = null;
    }

    /**
    * [BEFORE]
    */
    public function before() {
    }

    /**
    * [TEST]
    */
    public function createGameWithTooShortUserNameFails() {
        $wasExceptionThrown = false;
        try {
            $this->createGameWithUser("a", "abcdef");
        } catch (Exception $error) {
            $wasExceptionThrown = true;
        }

        testAssertTrue($wasExceptionThrown, "An exception should be thrown, because user name is too short.");
    }

    /**
    * [TEST]
    */
    public function createGameWithEmptySessionIdFails() {
        $wasExceptionThrown = false;
        try {
            $this->createGameWithUser("validname", "");
        } catch (Exception $error) {
            $wasExceptionThrown = true;
        }

        testAssertTrue($wasExceptionThrown, "An exception should be thrown, because user ID is empty.");
    }

    /**
    * [TEST]
    */
    public function createGameSucceeds() {

        // GIVEN

        $userName = "hans";
        $userId = "abcdef";

        // WHEN and THEN

        $gameId = $this->createGameWithUser($userName, $userId);
        testAssertNotNull($gameId, "The creation of the game should return a game ID.");

        $gameInfo = $this->getGameInfos($gameId);
        testAssertNotNull($gameInfo, "The game should exist and have game infos.");

        $users = $gameInfo->getUsers();
        
        testAssertEquals(sizeof($users), 1, "There should be one user.");
        $user = $users[0];
        testAssertEquals($user->getName(), $userName, "The users name should be \"$userName\".");
        testAssertEquals($user->getId(), $userId, "The users ID should be \"$userId\".");
        testAssertEquals($user->getPosition(), "1", "The users position should be 1.");
        
        testAssertEquals($gameInfo->getState(), GameState::$CREATED, "The game state should be \"" . GameState::$CREATED . "\".");

        $this->commonGameId = $gameId;
    }

    /**
    * [TEST]
    */
    public function removeGameSucceeds() {
        if( is_null($this->commonGameId) ) {
            testFail("This test needs previous test for game creation to be successfull, so that removal of that game can be tested.");
        }

        testLog("Remove game for id=" . $this->commonGameId);
        $this->sut->removeGames(array($this->commonGameId));

        $gameInfo = $this->getGameInfos($this->commonGameId);
        testAssertNull($gameInfo, "The game should NOT exist and thus game infos should be \"null\".");
    }

    private function getGameInfos($gameId) {
        testLog("Get game info for game id=$gameId");

        return $this->sut->getGameInfos($gameId);
    }

    private function createGameWithUser($userName, $userId) {
        testLog("Creating a game with the user: name=$userName, id=$userId");

        return $this->sut->createGameWithUser($userName, $userId);
    }
}

?>