<?php

// The main controller:
// It "calls" the right controller to handle the request.
// It also starts the session.
// It also catches exceptions and displays them.


try {

    session_start();

    require_once('frontend_configs.php'); 

    require_once(__DIR__ . '/../backend/visionary_api.php');

    $visionary = new Visionary();

    $controller = getControllerToHandleHtmlRequest();

    // go to the right page

    if($controller == "creategame") {
        require_once('creategame_controller.php'); 
    }

    // unkown page

    else {
        throw new Exception("Unkown page: $controller");
    }

} catch (Exception $e) {   
    echo "<h1>Caught exception:</h1> \n";
    echo $e->getMessage();
}


// look into the HTML request to get the controller which should handle the request (default: create game controller)
function getControllerToHandleHtmlRequest() {
    $controller = 'creategame';

    if( isset(($_POST["controller"])) ) {
        $controller = $_POST["controller"];
    }
    else if( isset(($_GET["controller"])) ) {
        $controller = $_GET["controller"];
    }

    return $controller;
} 

?>