<?php

// infos about a game session

class GameSessionInfo implements JsonSerializable
{
    private $users = array();
    private $state;

    // infos about the specific game
    private $specificInfos;

    function __construct($users, $state) {
        $this->users = $users;
        $this->state = $state;
        $this->specificInfos = null;
    }

    public function getUsers() {
        return $this->users;
    }

    public function getState() {
        return $this->state;
    }

    public function getSpecificInfos() {
        return $this->specificInfos;
    }

    public function setSpecificInfos($specificInfos) {
        $this->specificInfos = $specificInfos;
    }

    // This specifies how this entity is represented as JSON.
    public function jsonSerialize()
    {
        return array('users' => $this->users, 'state' => $this->state, 'specific' => $this->specificInfos);
    }
}

?>