<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Codenames</title>
    <link rel="stylesheet" type="text/css" href="/../common/global.css">
	<link rel="stylesheet" type="text/css" href="codenames.css">
  </head>

  <body>
		<p>Please copy the following link and share it with the other team members:</p>
		<br>
		<a href="<?php echo '/codenames/codenames.php?names=' . $names_forview ?>">Link for team members</a>
		<br>
		<br>
		<p>Please copy the following link, open it and share it with the other team captain:</p>
		<br>
		<a href="<?php echo '/codenames/codenames.php?names=' . $names_forview . '&code=' . $code_forview ?>">Link for team captains</a>

  </body>
</html>