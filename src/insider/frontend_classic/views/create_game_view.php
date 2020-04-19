<!DOCTYPE html>
<html>
   
   <head>
      <?php require('common_header.php'); ?>
   </head>
   
   <body>
      
      <h1>Create your Insider game!</h1>

<?php 
      $data_forview['controller'] = 'start_insider';
      require_once($controllerDir . '/../../../common/game_session/create_game_session_form.php');
      
?>


   </body>
