<!DOCTYPE html>
<html>
   
   <head>
      <?php require('common_header.php'); ?>
<?php 
      require_once($controllerDir . '/../../../common/game_session/retrieve_game_infos_js.php');
?>
   </head>
   
   <body>
      
      <h1>Game Lobby for Insider</h1>

      <p> Welcome to the lobby!</p>

      <p> Share this link for other users to join your game:</p>

      <p><b><?php echo $data_forview['shareLink']; ?></b></p>

<?php 
      require_once($controllerDir . '/../../../common/game_session/users_view_component.php');
?>

   </body>

</html>