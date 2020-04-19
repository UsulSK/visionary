

<script>

        function updateUsers(gameData) {
            var userlistContent = "";
            for (index = 0; index < gameData.users.length; ++index) {
               var user = gameData.users[index];

                if( user.id == "<?php echo $data_forview['userId'] ?>") {
                    userlistContent = userlistContent + "<b>" + user.name + "</b><br>"; 
                }
                else {
                    userlistContent = userlistContent + user.name + "<br>"; 
                }

            }
            $( "#userlist" ).html(userlistContent);
        }

        gameDataCallbacks.push(updateUsers); 
         
</script>

<p> Users: </p>

<div id="userlist"></div>