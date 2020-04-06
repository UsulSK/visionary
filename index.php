<?php

// This just "starts" the main controller.
// Reason: All the frontend code should be in one folder and not in the root folder (to have a clear structure).

// also all errors that PHP throws should be shown
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('frontend_classic/main_controller.php'); 

?>