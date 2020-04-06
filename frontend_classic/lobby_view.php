<html>
   
   <head>
      <title><?php echo $APP_TITLE;?></title>
   </head>
   
   <body>
      
      <h1>Game lobby</h1>

      <p> Welcome to the lobby!</p>

      <p> Users: </p>

      <?php 
      
      foreach ($users as $user) {
         echo '<p>' . $user . '</p>';
      }
      
      ?>
   </body>

</html>