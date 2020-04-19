
<?php 

/*
* This creates the Javascript which retrieves periodically the game infos from the server via Ajax.
* Other scripts can then use this data.
*/

?>

<script>
         $(document).ready(
            requestGameInfo
         );

         var gameDataCallbacks = [];

         function requestGameInfo() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200) {
                  var lobbyData = JSON.parse(this.responseText);

                  // give the game data to all who need it
                  for (index = 0; index < gameDataCallbacks.length; ++index) {
                     var gameDataCallback = gameDataCallbacks[index];
                     gameDataCallback(lobbyData); 
                  }

                  setTimeout(requestGameInfo, 1000);
               }
            };
            xhttp.open("POST", "<?php echo $data_forview['linkForRecievingGameInfosPerAjax'] ?>", true);
            xhttp.send();
         }

</script>