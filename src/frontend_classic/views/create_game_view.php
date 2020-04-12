<html>
   
   <head>
      <?php require('common_header.php'); ?>
   </head>
   
   <body>
      
      <h1>Create your game!</h1>

      <?php 
      
      if(isset($error)) {
         echo '<b>Error: ' . $error . '</b>';
      }
      
      ?>

      <form method="post">
         <label for="username">Chose a name to start a game:</label><br>
         <input type="text" name="username"><br>
         <br>
         <input type="hidden" name="action" value="create"><br>
         <input type="hidden" name="controller" value="create_game">
         <input type="submit" value="Go!">
      </form> 

   </body>

</html>