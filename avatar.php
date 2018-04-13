<?php
/**
 * This is an example how to read the Genre field from a hidden source stream on Icecast2 and output an img.
 *  You can assign and "ID" to your images, what ever id is in the genre field the image should also be in place in your image directory.
 *
 * @package     
 * @license     http://www.gnu.org/licenses/agpl.html AGPL Version 3
 * @author      Malte Schroeder <post@malte-schroeder.de>
 * @copyright   Copyright (c) 2017-2018 Malte Schroeder (http://www.malte-schroeder.de)
 *
 */
error_reporting(0);
header('Access-Control-Allow-Origin: *');
require('include/function.inc.php');
require('include/config.inc.php');
set_time_limit(2);

$automation = "/source0";
$live1 = "/source1";
$live2 = "/source2";

$s1 = getAdminInfo($server1, $adminpass);
$s2 = getAdminInfo($server2, $adminpass);



if ($s2['ICESTATS'][$live2]['GENRE']) {
	$modid = $s2['ICESTATS'][$live2]['GENRE'];
}
else if ($s2['ICESTATS'][$live1]['GENRE']) {
	$modid = $s2['ICESTATS'][$live1]['GENRE'];
}
else if ($s2['ICESTATS'][$automation]['GENRE']) {
	$modid = $s2['ICESTATS'][$automation]['GENRE'];
}	
else if ($s1['ICESTATS'][$live2]['GENRE']) {
	$modid = $s1['ICESTATS'][$live2]['GENRE'];
}
else if ($s1['ICESTATS'][$live1]['GENRE']) {
	$modid = $s1['ICESTATS'][$live1]['GENRE'];
}
else if ($s1['ICESTATS'][$automation]['GENRE']) {
	$modid = $s1['ICESTATS'][$automation]['GENRE'];
}

	
echo '<img src="//www.your-server.de/full-path/to-your/avatar/id_'.$modid.'.jpg" alt="Moderator auf Sendung" class="img now-on-air">';
?>