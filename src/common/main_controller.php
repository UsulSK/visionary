<?php

require_once('helper_functions.php');
setPhpShowErrors();

/*
* The main function for handling HTTP requests.
* $controllerDir: The path to the directory of the controllers
* $viewsDir: The path to the directory of the views
* $defaultController: The controller which will handle the request if no controller was given in the HTTP request
*/
function handleHttpRequest($controllerDir, $viewsDir, $defaultController) {
    global $showView, $data_forview;
    
    try { // every Exception will be caught and displayed
        session_start();
        $controllerName = getControllerToHandleHttpRequest($defaultController);

        // Convention: The controller file-name is the same as the value of the controller-attribute in the HTTP request.
        // So lets check if a file with that name exists.
        
        $controllerFileName = $controllerName . '.php';
        $controllerFileNameFullPath = $controllerDir . '/' . $controllerFileName;
        if (!file_exists($controllerFileNameFullPath)) {
            throw new Exception("No controller exists with file name $controllerFileNameFullPath!");
        }

        // The file which contains the controller logic exists. So include it, so that it can handle the request.

        require($controllerFileNameFullPath); 

        //  Convention: The controller should have determined the view to show in the variable $showView.
        //  So this view should be shown now.
    
        //  Not all HTTP requests expect a HTML page as a result (for example Ajax requests). So $showView might be null which means there is no view to be shown.
        if( !is_null($showView) ) {
    
            // Convention: The view file-name is the same as the value of $showView.
            // So lets check if a file with that name exists.
            
            $viewFileName = $showView . '_view.php';
            $viewFileNameFullPath = $viewsDir . '/' . $viewFileName;
            if (!file_exists($viewFileNameFullPath)) {
                throw new Exception("No view exists with file name $viewFileNameFullPath!");
            }
    
            // show the view
            
            require($viewFileNameFullPath); 
        }

    } catch (Exception $e) {
        // Show the error and end excecution
        echo "<h1>Caught exception:</h1> \n";
        echo $e->getMessage();
        die;
    }
}

    
/* 
* Looks into the HTTP request to get the controller which should handle the request.
* $defaultController: The controller which will handle the request if no controller was given in the HTTP request
* Returns: The name of the controller which should handle the HTTP request.
*/
function getControllerToHandleHttpRequest($defaultController) {
    $controller = getAttributeValueFromHttpRequest("controller");

    //  if no controller was given, then use default controller
    if( is_null($controller) )
    {
        return $defaultController;    
    }

    return $controller;
}

?>