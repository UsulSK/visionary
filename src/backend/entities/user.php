<?php

// a user

class User implements JsonSerializable
{
    private $name;


    function __construct($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    // This specifies how this entity is represented as JSON.
    public function jsonSerialize()
    {
        return array('name' => $this->name);
    }
}

?>