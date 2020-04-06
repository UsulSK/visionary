<html>
   
   <head>
      <title><?php echo $APP_TITLE;?></title>
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
         <input type="text" id="username" name="username"><br>
         <br>
         <input type="hidden" id="action" name="action" value="create"><br>
         <input type="hidden" id="controller" name="controller" value="creategame">
         <input type="submit" value="Go!">
      </form> 

   </body>

</html>