<?php
	setPhpShowErrors();

	$allWords = array("Kicker", "Roulette", "Drache", "Krieg", "Honig", "Bombe", "Kasino", "Wolkenkratzer", "Saturn", "Alien", "Peitsche", "Antarktis", "Schneemann",
		"Konzert", "Schokolade", "Jet", "Millionär", "Dinosaurier", "Pirat", "Hupe", "Pinguin", "Spinne", "Geschoss", "Botschaft", "Pistole", "Krankheit", 
		"Spion", "Prinzessin", "Genie", "Dieb", "Oper", "Ritter", "Stadion", "Limousine", "Geist", "Laster", "Lakritze", "Laser", "Tod", "Krankenhaus", "Skelett", 
		"Oktopus", "Hubschrauber", "Känguru", "Mikroskop", "Zentaur", "Superheld", "Teleskop", "Fallschirm", "Schnabeltier", "Olymp", "Satellit", "Engel", "Roboter", 
		"Einhorn", "Hexe", "Bergsteiger", "Taucher", "Gift", "Brücke", "Feuer", "Tisch", "Wal", "Mond", "Fisch", "Doktor", "Kirche", "Gürtel", "Zitrone", "Wind", 
		"Löwe", "Auge", "Luft", "Hase", "Bank", "Gras", "Auflauf", "Zwerg", "Wald", "Auto", "Burg", "Apfel", "Öl", "Koch", "Bär", "Katze", "Leben", "Glück", 
		"Riese", "Gesicht", "Strand", "Hotel", "Wasser", "Papier", "Wurm", "Anwalt", "Forscher", "Tanz", "Karotte", "Ketchup", "Nacht", "Meer", "Fuss", "Maus", 
		"Messer", "Theater", "Polizei", "Schiff", "Pilot", "Daumen", "Lehrer", "Flasche", "Tag", "König", "Glas", "Königin", "Zahn", "Hund", "Pferd", "Schuh", 
		"Stuhl", "Krone", "Eis", "Gold", "Gabel", "Zeit", "Flöte", "Fackel", "Schnee", "Elfenbein", "Soldat", "Pyramide", "Schnur", "Stern", "Ring", "Horn", 
		"Herz", "Ball", "Kanal", "Nadel", "Linie", "Korb", "Blau", "Taste", "Schirm", "Spiel", "Fleck", "Knopf", "Mund", "Akt", "Himalaja", "Bett", "Wand", 
		"Turm", "Karte", "Tor", "Raute", "Kreuz", "Netz", "Punkt", "Pass", "Fläche", "Loch", "Glocke", "Kraft", "Schloss", "Maschine", "Welle", "Strom", "Haupt", 
		"Pol", "Mittel", "Jahr", "Leim", "Seite", "Bau", "Kreis", "Bindung", "Uhr", "New York", "Australien", "Bayern", "Tokio", "Ägypten", "London", "Morgenstern", 
		"Moskau", "China", "Shakespeare", "Hollywood", "Griechenland", "Rom", "Hand", "Ninja", "Brötchen", "Kiwi", "Deutschland", "Staat", "Amerikaner", "Atlantis", 
		"England", "Osten", "Afrika", "Alpen", "Frankreich", "Winnetou", "Mexiko", "Verein", "Feder", "Hamburger", "Berlin", "Adler", "Europa", "Loch Ness", 
		"Peking", "Inka", "Becken", "Optik", "Strasse", "Essen", "Siegel", "Bart", "Blüte", "Moos", "Abgabe", "Bahn", "Tafel", "Bart", "Quartett", "Torte", "Tau", 
		"Chemie", "Arm", "Linse", "Kippe", "Melone", "Fuchs", "Boot", "Korn", "Bande", "Mal", "Batterie", "Dame", "Pflaster", "Erde", "Messe", "Ton", "Römer", 
		"Stamm", "Brand", "Schild", "Lippe", "Miene", "Kokos", "Läufer", "Bund", "Elf", "Iris", "Gang", "Pfeife", "Kiel", "Star", "Leiter", "Ladung", "Bauer", 
		"Strudel", "Bremse", "Hahn", "Kapele", "Strauss", "Satz", "Grund", "Kater", "Matte", "Kerze", "Wirtschaft", "Dichtung", "Gehalt", "Chor", "Feige", "Erika", 
		"Mangel", "Rolle", "Stock", "Dietrich", "Schule", "Ente", "Schotten", "Mark", "Lager", "Fall", "Jura", "Niete", "Geschirr", "Knie", "Drossel", "Hering", 
		"Sekretär", "Drucker", "Blinker", "Stift", "Flügel", "Schein", "Funken", "Bock", "Po", "Atlas", "Stempel", "Schelle", "Leuchte", "Umzug", "Finger", "Riegel", 
		"Mast", "Käfer", "Bogen", "Wanze", "Scheibe", "Schalter", "Schimmel", "Demo", "Bein", "Börse", "Takt", "Fliege", "Jäger", "Kunde", "Nuss", "Schlange", 
		"Tempo", "Bach", "Vorsatz", "Gericht", "Kamm", "Busch", "Platte", "Decke", "Rücken", "Maler", "Heide", "Boxer", "Reif", "Ausdruck", "Zug", "Kiefer", 
		"Washington", "Mini", "Gut", "Kohle", "Grad", "Brause", "Viertel", "Rute", "Bulle", "Figur", "Fest", "Zoll", "Loge", "Mutter", "Riemen", "Verband", "Hut", 
		"Watt", "Horst", "Luxemburg", "Birne", "Note", "Film", "Absatz", "Blatt", "Mandel", "Indien", "Fessel", "Schale", "Aufzug", "Quelle", "Harz", "Wurf", 
		"Golf", "Rost", "Rost", "Nagel", "Toast", "Zylinder", "Muschel", "Würfel", "Weide", "Kapitän", "Lösung", "Rasen", "Rock", "Krebs", "Flur", "Steuer", 
		"Zelle", "Barren", "Löffel", "Futter", "Schuppen", "Orange", "Pension");
	

	// names are not set: show the start view

	if ( !isset($_GET["names"]) ) {

		// create random words

		$names_forview = createWords($allWords);

		// create random code

		$code_forview = createCode();

		// show the start view (for team captains)

		require_once('codenames_start_view.php');
	}

	// names are set: show words to playsers/captains

	else {

		// prepare variables for game view

		$words_forview = explode("_", $_GET["names"]);
		$allWords_forview = $allWords;

		// show the game view

		require_once('codenames_game_view.php');
	}



	// =========== functions ==========


	// Create the code for a game
	// Returns: The code for a game.
	function createCode() {
		$startTeam = rand(1,2);
		$code = '00000001111111122222222X' . $startTeam;
		$code = str_shuffle($code);

		return $code;
	}

	// Create the words for a game
	// $allWords: all possible words which can be used for a game
	// Returns: The words for a game.
	function createWords($allWords) {
		$wordCount = count($allWords);
		$numbers = range(0, $wordCount-1);
		shuffle($numbers);
		$names = $numbers[0];
		for ($i = 1; $i < 25; $i++) {
			$names = $names . '_' . $numbers[$i];
		}

		return $names;
	}

	// Configure PHP to show as many errors as it can to help debugging
	function setPhpShowErrors() {
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	}
?>