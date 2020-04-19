<!DOCTYPE html>
<html>
   
   <head>
      <?php require('common_header.php'); ?>
   </head>
   
   <body>
      
      <h1>Join a game of Insider!</h1>

<?php 
      $data_forview['controller'] = 'show_game';
      require_once($controllerDir . '/../../../common/game_session/join_game_form.php');
?>

   </body>

</html>