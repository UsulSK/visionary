<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Codenames</title>
    <link rel="stylesheet" type="text/css" href="/../common/global.css">
    <link rel="stylesheet" type="text/css" href="codenames.css">
    <script>
        function changeWordColor(wordId) {
            oldColor = document.getElementById(wordId).style.color;

            if( oldColor=='black') {
                document.getElementById(wordId).style.color = 'red';
            } else if( oldColor=='red') {
                document.getElementById(wordId).style.color = 'blue';
            } else if( oldColor=='blue') {
                document.getElementById(wordId).style.color = '#F3F2EE';
            } else  {
                document.getElementById(wordId).style.color = 'black';
            }
        }
    </script>
  </head>

  <body>

    <table class="codenames_words">
<?php
        $isCaptain = false;
        if( isset($_GET["code"]) ) {
			$isCaptain = true;
			$codes = str_split($_GET["code"]);
			$nrOfRed = substr_count($_GET["code"], "1");
			$nrOfBlue = substr_count($_GET["code"], "2");

			$beginMessage = '<font color="red">Red begins</font>';
			if($nrOfBlue > $nrOfRed) {
				$beginMessage = '<font color="blue">Blue begins</font>';
			}
        }

        $wordCounter = 0;
        foreach ($words_forview as $word) {

            //start new table row
            if( $wordCounter % 5 == 0 )
            {
                //close previous row (except when this is the first row)
                if( $wordCounter != 0 )
                {
                    echo '</tr>' . "\n";
                }
                echo '<tr>' . "\n";
            }

?>
            <td class="codenames_words">
<?php
                if( $isCaptain ) {
?>
					<input type="checkbox">
					<div id="word_<?php echo $word ?>" class="wordtype_<?php echo $codes[$wordCounter] ?>">
<?php
				}
				else {
?>
					<div id="word_<?php echo $word ?>" onclick="changeWordColor('word_<?php echo $word ?>')" 
						style="color:black; -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;" 
						unselectable="on" onselectstart="return false;">
<?php
				}

							echo $allWords_forview[$word];
?>
                </div>
            </td>
<?php
            $wordCounter++;
        }
?>
        </tr>
    </table>
    <br>
<?php
        if( !$isCaptain ) {
			
?>
    <p>By clicking on a word you can change its font color from black to <span style="color: red">red</span> 
        to <span style="color: blue">blue</span> to <span style="color: #F3F2EE">grey</span> and back to black. 
        This might help you to remember which words have already been guessed.
    </p>
    <p>Be careful: all color coding will be gone if you reload the page.</p>
<?php
        }
        else
        {
?>
    <p>Be careful: all checkboxes will be unchecked if you reload the page.</p>
    <p><?php echo $beginMessage ?></p>
<?php
        }
?>
</body>
</html>