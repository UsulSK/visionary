<?php 
      
      if(isset($data_forview['error'])) {
         echo '<b>Error: ' . $data_forview['error'] . '</b>';
      }
      
?>

      <form method="post">
         <label for="username">Choose a name to start a game:</label><br>
         <input type="text" name="username"><br>
         <br>
         <input type="hidden" name="action" value="create"><br>
         <input type="hidden" name="controller" value="<?php echo $data_forview['controller'] ?>">
         <input type="submit" value="Go!">
      </form> 