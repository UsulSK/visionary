<?php

// a user

class User implements JsonSerializable
{
    private $name;
    private $id;
    private $position;
    private $isReady;


    function __construct($name, $id, $position, $isReady) {
        $this->name = $name;
        $this->id = $id;
        $this->position = $position;

        if( $isReady == 0 ) {
            $this->isReady = false;
        } else if( $isReady == 1 ) {
            $this->isReady = true;
        } else {
            $this->isReady = $isReady;
        }
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

    public function isReady() {
        return $this->isReady;
    }

    // This specifies how this entity is represented as JSON.
    public function jsonSerialize()
    {
        return array('name' => $this->name, 'id' => $this->id, 'position' => $this->position, 'isReady' => $this->isReady);
    }
}

?>