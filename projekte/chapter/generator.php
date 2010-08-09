<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Space Marine Chapter Generator</title>
<h1>Space Marine Chapter Generator</h1>

<?php


// Farben
$first[] = "Dark";
$first[] = "Black";
$first[] = "Red";
$first[] = "White";
$first[] = "Blue";
$first[] = "Gray";
$first[] = "Crimson";
$first[] = "Azure";
$first[] = "Indigo";
$first[] = "Emerald";
$first[] = "Jade";
$first[] = "Onyx";
// Substanzen
$first[] = "Blood";
$first[] = "Iron";
$first[] = "Steel";
$first[] = "Golden";
$first[] = "Silver";
$first[] = "Bronze";
$first[] = "Stone";
$first[] = "Obsidian";
$first[] = "Fire";
$first[] = "Flame";
$first[] = "Pyro";
$first[] = "Ice";
$first[] = "Frost";
$first[] = "Snow";
$first[] = "Rain";
$first[] = "Air";
$first[] = "Earth";
$first[] = "Desert";
$first[] = "Void";
$first[] = "Thunder";
$first[] = "Lightning";
$first[] = "Bone";
$first[] = "Ivory";
$first[] = "Flesh";
// Objekte
$first[] = "Sun";
$first[] = "Solar";
$first[] = "Moon";
$first[] = "Lunar";
$first[] = "Sea";
$first[] = "Ocean";
$first[] = "Sky";
$first[] = "Night";
$first[] = "Dawn";
$first[] = "Twilight";
$first[] = "Storm";
$first[] = "Typhoon";
$first[] = "Blizzard";
$first[] = "Hurricane";
$first[] = "Tornado";
$first[] = "Cloud";
$first[] = "Throne";
$first[] = "Vulcan";
// Abstrakt
$first[] = "Ultra";
$first[] = "Alpha";
$first[] = "Delta";
$first[] = "Omega";
$first[] = "Sigma";
$first[] = "Halo";
$first[] = "Nova";
$first[] = "Neo";
$first[] = "Nebula";
$first[] = "Astral";
$first[] = "Plasma";
$first[] = "Aqua";
$first[] = "Aurora";
$first[] = "Omni";
$first[] = "Arctic";
$first[] = "Mighty";
$first[] = "Imperial";
$first[] = "Emperors";
$first[] = "Space";
$first[] = "Death";
$first[] = "Ghost";
$first[] = "Spirit";
$first[] = "Soul";
$first[] = "Genesis";
$first[] = "Eternity";
$first[] = "Justice";
$first[] = "Fate";
$first[] = "Truth";
$first[] = "Light";
$first[] = "Doom";
$first[] = "War";
$first[] = "Battle";
$first[] = "Hate";
$first[] = "Shadow";
$first[] = "Zero";
$first[] = "Thousand";
$first[] = "Celestial";
$first[] = "Strike";
$first[] = "Execution";
$first[] = "Vigilance";
$first[] = "Infinity";
$first[] = "Vengeance";
$first[] = "Redemption";
$first[] = "Absolution";
$first[] = "Judgment";
$first[] = "Doom";
$first[] = "War";
$first[] = "Perdition";
$first[] = "Oblivion";
$first[] = "Hate";
$first[] = "Immortal";
$first[] = "Grief";
$first[] = "Purity";
$first[] = "Victory";
$first[] = "Phantom";
// Adjetive
$first[] = "Grimm";
$first[] = "Dire";
$first[] = "Ire";
$first[] = "Fury";
$first[] = "Fierce";
$first[] = "Flaming";
$first[] = "Wrath";
$first[] = "Burning";
$first[] = "Bright";
$first[] = "Bane";
$first[] = "Swift";
$first[] = "Cresent";
$first[] = "Dread";
$first[] = "Desolate";
$first[] = "Eternal";
$first[] = "Pale";
$first[] = "Silent";




// Tiere
$second[] = "Ravens";
$second[] = "Crows";
$second[] = "Eagles";
$second[] = "Falcons";
$second[] = "Hawks";
$second[] = "Owls";
$second[] = "Swans";
$second[] = "Condors";
$second[] = "Vultures";
$second[] = "Griffins";
$second[] = "Minotaurs";
$second[] = "Bears";
$second[] = "Wolves";
$second[] = "Hounds";
$second[] = "Foxes";
$second[] = "Jackels";
$second[] = "Otters";
$second[] = "Lions";
$second[] = "Tigers";
$second[] = "Panthers";
$second[] = "Cougars";
$second[] = "Dragons";
$second[] = "Wyrms";
$second[] = "Wyverns";
$second[] = "Serpents";
$second[] = "Stalions";
$second[] = "Snakes";
$second[] = "Vipers";
$second[] = "Raptors";
$second[] = "Sharks";
$second[] = "Scorpoions";
$second[] = "Wasps";
$second[] = "Hornets";
$second[] = "Kraken";
// Waffen
$second[] = "Swords";
$second[] = "Guns";
$second[] = "Shields";
$second[] = "Spears";
$second[] = "Arrows";
$second[] = "Axes";
$second[] = "Hammers";
$second[] = "Anvil";
$second[] = "Scythes";
$second[] = "Blades";
$second[] = "Tanks";
$second[] = "Crosses";
$second[] = "Tridents";
// Gruppen
$second[] = "Decimators";
$second[] = "Marines";
$second[] = "Scions";
$second[] = "Templars";
$second[] = "Knights";
$second[] = "Warriors";
$second[] = "Crusaders";
$second[] = "Conquerors";
$second[] = "Invaders";
$second[] = "Champions";
$second[] = "Spectres";
$second[] = "Marauders";
$second[] = "Brothers";
$second[] = "Brotherhood";
$second[] = "Brethren";
$second[] = "Lancers";
$second[] = "Enforcers";
$second[] = "Advocates";
$second[] = "Paladins";
$second[] = "Guard";
$second[] = "Monarchs";
$second[] = "Guardians";
$second[] = "Archons";
$second[] = "Squadron";
$second[] = "Defenders";
$second[] = "Sentinels";
$second[] = "Consuls";
$second[] = "Warlords";
$second[] = "Corps";
$second[] = "Children";
$second[] = "Corsairs";
$second[] = "Sons";
$second[] = "Collosi";
$second[] = "Giants";
$second[] = "Machines";
$second[] = "Avengers";
$second[] = "Saviors";
$second[] = "Executors";
$second[] = "Wraiths";
$second[] = "Phantom";
$second[] = "Cardinals";
$second[] = "Harbingers";
$second[] = "Herlads";
$second[] = "Raiders";
$second[] = "Riders";
$second[] = "Praetors";
$second[] = "Heroes";
$second[] = "Prophets";
$second[] = "Adepts";
// Verben
$second[] = "Drinkers";
$second[] = "Eaters";
$second[] = "Hunters";
$second[] = "Runners";
$second[] = "Punishers";
$second[] = "Reavers";
$second[] = "Reapers";
$second[] = "Bringers";
$second[] = "Dealers";
$second[] = "Bearers";
$second[] = "Haunters";
$second[] = "Callers";
$second[] = "Keepers";
$second[] = "Seers";
// Mythen und Abstrakt
$second[] = "Angels";
$second[] = "Devils";
$second[] = "Ghosts";
$second[] = "Scars";
$second[] = "Lords";
$second[] = "Flames";
$second[] = "Banners";
$second[] = "Hearts";
$second[] = "Star";
$second[] = "Suns";
$second[] = "Moons";
$second[] = "Tears";
$second[] = "Roses";
// Singular
$second[] = "Reign";
$second[] = "Order";
$second[] = "Chapter";
$second[] = "Will";
$second[] = "Chapel";
$second[] = "Legion";
$second[] = "Army";
$second[] = "Watch";
// Körperteile
$second[] = "Fists";
$second[] = "Hands";
$second[] = "Heads";
$second[] = "Claws";
$second[] = "Fangs";
$second[] = "Tusks";
$second[] = "Thorns";
$second[] = "Teeth";
$second[] = "Wings";
$second[] = "Skulls";
$second[] = "Talons";






for($i=0; $i<1; $i++){
  $one = rand(0, count($first)-1);
  $two = rand(0, count($second)-1);
  print ("<p><a href='javascript:window.location.reload()'>Zufälliger Ordensname</a>: <b>".$first[$one] . " " . $second[$two] . "</b></p>");
}

print "Einer von ".count($first)*count($second). " möglichen Space Marine Ordensnamen <br/>";
print "Zusammengesetzt aus ".count($first)." Descriptoren und " .count($second) .  " Konzepten <br/><br/>";


?>
