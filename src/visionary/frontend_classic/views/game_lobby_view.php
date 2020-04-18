<!DOCTYPE html>
<html>
   
   <head>
      <?php require('common_header.php'); ?>
      <script>
         $(document).ready(
            requestUserLobbyData
         );

         function requestUserLobbyData() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200) {
                  var lobbyData = JSON.parse(this.responseText);
                  handleLobbyDataFunction(lobbyData);

                  setTimeout(requestUserLobbyData, 1000);
               }
            };
            xhttp.open("POST", "<?php echo $getLobbyDataLink_forview; ?>", true);
            xhttp.send();
         }

         function handleLobbyDataFunction(lobbyData) {
            var userlistContent = "";

            for (index = 0; index < lobbyData.users.length; ++index) {
               var user = lobbyData.users[index];
               userlistContent = userlistContent + user.name + "<br>"; 
            }
            $( "#userlist" ).html(userlistContent);
         }

      </script>
   </head>
   
   <body>
      
      <h1>Game lobby</h1>

      <p> Welcome to the lobby!</p>

      <p> Share this link for other users to join your game:</p>

      <p><b><?php echo $shareLink_forview; ?></b></p>

      <p> Users: </p>

      <div id="userlist"></div>

   </body>

</html>