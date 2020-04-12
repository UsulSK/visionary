<?php

/*
* Here global helper functions are defined which can then be used everywhere.
*/

//  Gets the value of an attribute from a HTTP request, no matter if it was a GET or POST request.
//  Returns 'null' if the value was not sent in the HTTP request.
function getAttributeValueFromHttpRequest($nameOfAttribute) {
    if( isset(($_POST[$nameOfAttribute])) ) {
        return $_POST[$nameOfAttribute];
    }
    else if( isset(($_GET[$nameOfAttribute])) ) {
        return $_GET[$nameOfAttribute];
    }

    return null;
} 

?>