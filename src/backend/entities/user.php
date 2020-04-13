<?php

// a user

class User implements JsonSerializable
{
    private $name;
    private $id;
    private $position;


    function __construct($name, $id, $position) {
        $this->name = $name;
        $this->id = $id;
        $this->position = $position;
    }

    public function getName() {
        return $this->name;
    }

    public function getId() {
        return $this->id;
    }

    public function getPosition() {
        return $this->position;
    }

    // This specifies how this entity is represented as JSON.
    public function jsonSerialize()
    {
        return array('name' => $this->name, 'id' => $this->id, 'position' => $this->position);
    }
}

?>