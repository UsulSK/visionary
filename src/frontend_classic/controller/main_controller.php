<?php

/* 
* The main controller:
* It starts the session.
* It catches exceptions and displays them.
* It "calls" the right controller to handle the request.
* Then it "calls" the view, which the controller determined, to show to the user.
*/ 


try { // every Exception will be caught and displayed

    setPhpShowErrors();
    session_start();

    require_once(__DIR__ . '/../../backend/visionary_api.php');
    $visionary = new VisionaryFacade();
    
    require_once(__DIR__ . '/../utils/global_helper_functions.php');

    $controllerName = getControllerToHandleHttpRequest();

    // Convention: The controller file-name is the same as the value of the controller-attribute in the HTTP request.
    // So lets check if a file with that name exists.
    
    $controllerFileName = $controllerName . '.php';
    if (!file_exists(__DIR__ . '/' . $controllerFileName)) {
        throw new Exception("No controller exists with name $controllerFileName!");
    }

    // The file which contains the controller logic exists. So include it, so that it can handle the request.

    require($controllerFileName); 

    //  Convention: The controller should have determined the view to show in the variable $showView.
    //  So this view should be shown now.

    //  Not all HTTP requests expect a HTML page as a result (for example Ajax requests). So $showView might be null which means there is no view to be shown.
    if( !is_null($showView) ) {

        // Convention: The view file-name is the same as the value of $showView.
        // So lets check if a file with that name exists.
        
        $viewFileName = $showView . '_view.php';
        if (!file_exists(__DIR__ . '/../views/' . $viewFileName)) {
            throw new Exception("No view exists with name $viewFileName!");
        }

        // show the view
        
        require(__DIR__ . '/../views/' . $viewFileName); 
    }

} catch (Exception $e) {
    
    // Show the error end end excecution

    echo "<h1>Caught exception:</h1> \n";
    echo $e->getMessage();
    die;
}

// Configure PHP to show as many errors as it can to help debugging
function setPhpShowErrors() {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}


// Looks into the HTML request to get the controller which should handle the request (default: create game controller).
// Returns: The name of the controller which should handle the HTTP request.
function getControllerToHandleHttpRequest() {
    $controller = getAttributeValueFromHttpRequest("controller");

    //  if no action was given, then default is to create a game
    if( is_null($controller) )
    {
        return "create_game";    
    }

    return $controller;
} 

?>