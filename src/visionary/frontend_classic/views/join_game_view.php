<!DOCTYPE html>
<html>
   
   <head>
      <?php require('common_header.php'); ?>
   </head>
   
   <body>
      
      <h1>Join a game</h1>

<?php 

      if(isset($error_forview)) {
         echo '<b>Error: ' . $error_forview . '</b>';
      }

?>

      <form method="post">
         <label for="username">Chose a name to join a game:</label><br>
         <input type="text" name="username"><br>
         <br>
         <input type="hidden" name="action" value="join"><br>
         <input type="hidden" name="controller" value="show_game">
         <input type="submit" value="Go!">
      </form> 

   </body>

</html>