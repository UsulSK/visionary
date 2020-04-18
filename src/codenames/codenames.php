<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Codenames</title>
    <link rel="stylesheet" type="text/css" href="/../common/global.css">
	<link rel="stylesheet" type="text/css" href="codenames.css">
  </head>
  
  <script>
	function changeWord2(wordId) {
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

  <body>
	<table class="codenames_words">
	  <?php
	
	$alleBegriffe = array("Kicker", "Roulette" , "Drache" , "Krieg" , "Honig" , "Bombe" , "Kasino" , "Wolkenkratzer" , "Saturn" , "Alien" , "Peitsche" , "Antarktis" , "Schneemann" , "Konzert" , "Schokolade" , "Jet" , "Millionär" , "Dinosaurier" , "Pirat" , "Hupe" , "Pinguin" , "Spinne" , "Geschoss" , "Botschaft" , "Pistole" , "Krankheit" , "Spion" , "Prinzessin" , "Genie" , "Dieb" , "Oper" , "Ritter" , "Stadion" , "Limousine" , "Geist" , "Laster" , "Lakritze" , "Laser" , "Tod" , "Krankenhaus" , "Skelett" , "Oktopus" , "Hubschrauber" , "Känguru" , "Mikroskop" , "Zentaur" , "Superheld" , "Teleskop" , "Fallschirm" , "Schnabeltier" , "Olymp" , "Satellit" , "Engel" , "Roboter" , "Einhorn" , "Hexe" , "Bergsteiger" , "Taucher" , "Gift" , "Brücke" , "Feuer" , "Tisch" , "Wal" , "Mond" , "Fisch" , "Doktor" , "Kirche" , "Gürtel" , "Zitrone" , "Wind" , "Löwe" , "Auge" , "Luft" , "Hase" , "Bank" , "Gras" , "Auflauf" , "Zwerg" , "Wald" , "Auto" , "Burg" , "Apfel" , "Öl" , "Koch" , "Bär" , "Katze" , "Leben" , "Glück" , "Riese" , "Gesicht" , "Strand" , "Hotel" , "Wasser" , "Papier" , "Wurm" , "Anwalt" , "Forscher" , "Tanz" , "Karotte" , "Ketchup" , "Nacht" , "Meer" , "Fuss" , "Maus" , "Messer" , "Theater" , "Polizei" , "Schiff" , "Pilot" , "Daumen" , "Lehrer" , "Flasche" , "Tag" , "König" , "Glas" , "Königin" , "Zahn" , "Hund" , "Pferd" , "Schuh" , "Stuhl" , "Krone" , "Eis" , "Gold" , "Gabel" , "Zeit" , "Flöte" , "Fackel" , "Schnee" , "Elfenbein" , "Soldat" , "Pyramide" , "Schnur" , "Stern" , "Ring" , "Horn" , "Herz" , "Ball" , "Kanal" , "Nadel" , "Linie" , "Korb" , "Blau" , "Taste" , "Schirm" , "Spiel" , "Fleck" , "Knopf" , "Mund" , "Akt" , "Himalaja" , "Bett" , "Wand" , "Turm" , "Karte" , "Tor" , "Raute" , "Kreuz" , "Netz" , "Punkt" , "Pass" , "Fläche" , "Loch" , "Glocke" , "Kraft" , "Schloss" , "Maschine" , "Welle" , "Strom" , "Haupt" , "Pol" , "Mittel" , "Jahr" , "Leim" , "Seite" , "Bau" , "Kreis" , "Bindung" , "Uhr" , "New York" , "Australien" , "Bayern" , "Tokio" , "Ägypten" , "London" , "Morgenstern" , "Moskau" , "China" , "Shakespeare" , "Hollywood" , "Griechenland" , "Rom" , "Hand" , "Ninja" , "Brötchen" , "Kiwi" , "Deutschland" , "Staat" , "Amerikaner" , "Atlantis" , "England" , "Osten" , "Afrika" , "Alpen" , "Frankreich" , "Winnetou" , "Mexiko" , "Verein" , "Feder" , "Hamburger" , "Berlin" , "Adler" , "Europa" , "Loch Ness" , "Peking" , "Inka" , "Becken" , "Optik" , "Strasse" , "Essen" , "Siegel" , "Bart" , "Blüte" , "Moos" , "Abgabe" , "Bahn" , "Tafel" , "Bart" , "Quartett" , "Torte" , "Tau" , "Chemie" , "Arm" , "Linse" , "Kippe" , "Melone" , "Fuchs" , "Boot" , "Korn" , "Bande" , "Mal" , "Batterie" , "Dame" , "Pflaster" , "Erde" , "Messe" , "Ton" , "Römer" , "Stamm" , "Brand" , "Schild" , "Lippe" , "Miene" , "Kokos" , "Läufer" , "Bund" , "Elf" , "Iris" , "Gang" , "Pfeife" , "Kiel" , "Star" , "Leiter" , "Ladung" , "Bauer" , "Strudel" , "Bremse" , "Hahn" , "Kapele" , "Strauss" , "Satz" , "Grund" , "Kater" , "Matte" , "Kerze" , "Wirtschaft" , "Dichtung" , "Gehalt" , "Chor" , "Feige" , "Erika" , "Mangel" , "Rolle" , "Stock" , "Dietrich" , "Schule" , "Ente" , "Schotten" , "Mark" , "Lager" , "Fall" , "Jura" , "Niete" , "Geschirr" , "Knie" , "Drossel" , "Hering" , "Sekretär" , "Drucker" , "Blinker" , "Stift" , "Flügel" , "Schein" , "Funken" , "Bock" , "Po" , "Atlas" , "Stempel" , "Schelle" , "Leuchte" , "Umzug" , "Finger" , "Riegel" , "Mast" , "Käfer" , "Bogen" , "Wanze" , "Scheibe" , "Schalter" , "Schimmel" , "Demo" , "Bein" , "Börse" , "Takt" , "Fliege" , "Jäger" , "Kunde" , "Nuss" , "Schlange" , "Tempo" , "Bach" , "Vorsatz" , "Gericht" , "Kamm" , "Busch" , "Platte" , "Decke" , "Rücken" , "Maler" , "Heide" , "Boxer" , "Reif" , "Ausdruck" , "Zug" , "Kiefer" , "Washington" , "Mini" , "Gut" , "Kohle" , "Grad" , "Brause" , "Viertel" , "Rute" , "Bulle" , "Figur" , "Fest" , "Zoll" , "Loge" , "Mutter" , "Riemen" , "Verband" , "Hut" , "Watt" , "Horst" , "Luxemburg" , "Birne" , "Note" , "Film" , "Absatz" , "Blatt" , "Mandel" , "Indien" , "Fessel" , "Schale" , "Aufzug" , "Quelle" , "Harz" , "Wurf" , "Golf" , "Rost" , "Rost" , "Nagel" , "Toast" , "Zylinder" , "Muschel" , "Würfel" , "Weide" , "Kapitän" , "Lösung" , "Rasen" , "Rock" , "Krebs" , "Flur" , "Steuer" , "Zelle" , "Barren" , "Löffel" , "Futter" , "Schuppen" , "Orange" , "Pension");
	$anzahlBegriffe = count($alleBegriffe);
	$startTeam = rand(1,2);
	
	if (!isset($_GET["code"]) && !isset($_GET["names"])) {
		$code = '00000001111111122222222X' . $startTeam;
		$code = str_shuffle($code);
		
		$numbers = range(0, $anzahlBegriffe-1);
		shuffle($numbers);
		
		$names = $numbers[0];
		for ($i = 1; $i < 25; $i++) {
			$names = $names . '_' . $numbers[$i];
		}
		
		echo 'Please copy the following link and share it with the other team members:<br><br>';
		?>
		
		<a href="<?php echo '/codenames/codenames.php?names=' . $names ?>">Link for team members</a>
		
		<?php
		echo '<br><br><br>Please copy the following link, open it and share it with the other team captain:<br><br>';
		?>
		
		<a href="<?php echo '/codenames/codenames.php?names=' . $names . '&code=' . $code ?>">Link for team captains</a>
		
		<?php
	}
	else {
		
		$begriffe = explode("_", $_GET["names"]);
			
		if (!isset($_GET["code"]) && isset($_GET["names"])){

			?>
			<tr>
			<?php
				for ($i = 0; $i < 5; $i++) {
					echo '<td>';
					?>
					<div id="<?php echo $begriffe[$i] ?>" onclick="changeWord2('<?php echo $begriffe[$i] ?>')" style="color:black; -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;" unselectable="on" onselectstart="return false;"><?php echo $alleBegriffe[$begriffe[$i]] ?></div>
					<?php
					echo '</td>';
					}
			?>
			</tr>
			<tr>
			<?php
				for ($i = 5; $i < 10; $i++) {
					echo '<td>';
					?>
					<div id="<?php echo $begriffe[$i] ?>" onclick="changeWord2('<?php echo $begriffe[$i] ?>')" style="color:black; -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;" unselectable="on" onselectstart="return false;"><?php echo $alleBegriffe[$begriffe[$i]] ?></div>
					<?php
					echo '</td>';
					}
			?>
			</tr>
			<tr>
			<?php
				for ($i = 10; $i < 15; $i++) {
					echo '<td>';
					?>
					<div id="<?php echo $begriffe[$i] ?>" onclick="changeWord2('<?php echo $begriffe[$i] ?>')" style="color:black; -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;" unselectable="on" onselectstart="return false;"><?php echo $alleBegriffe[$begriffe[$i]] ?></div>
					<?php
					echo '</td>';
					}
			?>
			</tr>
			<tr>
			<?php
				for ($i = 15; $i < 20; $i++) {
					echo '<td>';
					?>
					<div id="<?php echo $begriffe[$i] ?>" onclick="changeWord2('<?php echo $begriffe[$i] ?>')" style="color:black; -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;" unselectable="on" onselectstart="return false;"><?php echo $alleBegriffe[$begriffe[$i]] ?></div>
					<?php
					echo '</td>';
					}
			?>
			</tr>
			<tr>
			<?php
				for ($i = 20; $i < 25; $i++) {
					echo '<td>';
					?>
					<div id="<?php echo $begriffe[$i] ?>" onclick="changeWord2('<?php echo $begriffe[$i] ?>')" style="color:black; -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;" unselectable="on" onselectstart="return false;"><?php echo $alleBegriffe[$begriffe[$i]] ?></div>
					<?php
					echo '</td>';
					}
			?>
			</tr>
			<?php
			echo '<br>';
		  ?>
		</table>

		<p> By clicking on a word you can change its font color from black to <span style="color: red">red</span> to <span style="color: blue">blue</span> to <span style="color: #F3F2EE">grey</span> and back to black. This might help you to remember which words have already been guessed. </p>
		<p> Be careful: all color coding will be gone if you reload the page.</p>
		<?php
			}
		
		if (isset($_GET["code"]) && isset($_GET["names"])){
				
			$zeilen = str_split($_GET["code"]);
			
			?>
			<tr>
			<?php
				for ($i = 0; $i < 5; $i++) {
					echo '<td>';
					?>
					<input type="checkbox">
					<?php
					echo '<br>';
					if ($zeilen[$i] == '0'){
						echo '<font color="grey">' . $alleBegriffe[$begriffe[$i]] . '</font>';
					}
					else if ($zeilen[$i] == '1'){
						echo '<font color="red">' . $alleBegriffe[$begriffe[$i]] . '</font>';
					}
					else if ($zeilen[$i] == '2'){
						echo '<font color="blue">' . $alleBegriffe[$begriffe[$i]] . '</font>';
					}
					else if ($zeilen[$i] == 'X'){
						echo '<b>' . $alleBegriffe[$begriffe[$i]] . '</b>';
					}
					echo '</td>';
					}
			?>
			</tr>
			<tr>
			<?php
				for ($i = 5; $i < 10; $i++) {
					echo '<td>';
					?>
					<input type="checkbox">
					<?php
					echo '<br>';
					if ($zeilen[$i] == '0'){
						echo '<font color="grey">' . $alleBegriffe[$begriffe[$i]] . '</font>';
					}
					else if ($zeilen[$i] == '1'){
						echo '<font color="red">' . $alleBegriffe[$begriffe[$i]] . '</font>';
					}
					else if ($zeilen[$i] == '2'){
						echo '<font color="blue">' . $alleBegriffe[$begriffe[$i]] . '</font>';
					}
					else if ($zeilen[$i] == 'X'){
						echo '<b>' . $alleBegriffe[$begriffe[$i]] . '</b>';
					}
					echo '</td>';
					}
			?>
			</tr>
			<tr>
			<?php
				for ($i = 10; $i < 15; $i++) {
					echo '<td>';
					?>
					<input type="checkbox">
					<?php
					echo '<br>';
					if ($zeilen[$i] == '0'){
						echo '<font color="grey">' . $alleBegriffe[$begriffe[$i]] . '</font>';
					}
					else if ($zeilen[$i] == '1'){
						echo '<font color="red">' . $alleBegriffe[$begriffe[$i]] . '</font>';
					}
					else if ($zeilen[$i] == '2'){
						echo '<font color="blue">' . $alleBegriffe[$begriffe[$i]] . '</font>';
					}
					else if ($zeilen[$i] == 'X'){
						echo '<b>' . $alleBegriffe[$begriffe[$i]] . '</b>';
					}
					echo '</td>';
					}
			?>
			</tr>
			<tr>
			<?php
				for ($i = 15; $i < 20; $i++) {
					echo '<td>';
					?>
					<input type="checkbox">
					<?php
					echo '<br>';
					if ($zeilen[$i] == '0'){
						echo '<font color="grey">' . $alleBegriffe[$begriffe[$i]] . '</font>';
					}
					else if ($zeilen[$i] == '1'){
						echo '<font color="red">' . $alleBegriffe[$begriffe[$i]] . '</font>';
					}
					else if ($zeilen[$i] == '2'){
						echo '<font color="blue">' . $alleBegriffe[$begriffe[$i]] . '</font>';
					}
					else if ($zeilen[$i] == 'X'){
						echo '<b>' . $alleBegriffe[$begriffe[$i]] . '</b>';
					}
					echo '</td>';
					}
			?>
			</tr>
			<tr>
			<?php
				for ($i = 20; $i < 25; $i++) {
					echo '<td>';
					?>
					<input type="checkbox">
					<?php
					echo '<br>';
					if ($zeilen[$i] == '0'){
						echo '<font color="grey">' . $alleBegriffe[$begriffe[$i]] . '</font>';
					}
					else if ($zeilen[$i] == '1'){
						echo '<font color="red">' . $alleBegriffe[$begriffe[$i]] . '</font>';
					}
					else if ($zeilen[$i] == '2'){
						echo '<font color="blue">' . $alleBegriffe[$begriffe[$i]] . '</font>';
					}
					else if ($zeilen[$i] == 'X'){
						echo '<b>' . $alleBegriffe[$begriffe[$i]] . '</b>';
					}
					echo '</td>';
					}
			?>
			</tr>
			<?php
			echo '<br>';
		  ?>
		</table>
		
		<?php
				echo '<br><br>';
				if ($startTeam=1) {
					echo '<font color="red">Red begins</font>';
				}
				else if ($startTeam=2) {
					echo '<font color="blue">Blue begins</font>';
				}
				else {
					echo 'Oops, something went wrong.';
				}
		?>
		<p> Be careful: all checkboxes will be unchecked if you reload the page.</p>
	
		<?php
		}
		}
	?> 

	
	

  </body>
</html>