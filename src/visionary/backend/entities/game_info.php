<?php

// infos about a game

class GameInfo implements JsonSerializable
{
    private $users = array();
    private $state;


    function __construct($users, $state) {
        $this->users = $users;
        $this->state = $state;
    }

    public function getUsers() {
        return $this->users;
    }

    public function getState() {
        return $this->state;
    }

    // This specifies how this entity is represented as JSON.
    public function jsonSerialize()
    {
        return array('users' => $this->users, 'state' => $this->state);
    }
}

?>