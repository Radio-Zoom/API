<?php
/**
 * Find out who is broadcastingg and show the related image.
 *
 * @package     
 * @license     http://www.gnu.org/licenses/agpl.html AGPL Version 3
 * @author      Malte Schroeder <post@malte-schroeder.de>
 * @copyright   Copyright (c) 2017-2018 Malte Schroeder (http://www.malte-schroeder.de)
 *
 */

error_reporting(0);
header('Access-Control-Allow-Origin: *');
require('function.inc.php');
require('config.inc.php');
set_time_limit(2);

$automation = "/automation";
$live1 = "/live1";
$live2 = "/live2";

$s1 = getAdminInfo($server1, $adminpass);
$s2 = getAdminInfo($server2, $adminpass);
$StreamMon0 = getStreamMonitor($mairlistrest, '/runtimedata/StreamMonitorOnAir0');
$StreamMon1 = getStreamMonitor($mairlistrest, '/runtimedata/StreamMonitorOnAir1');



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
	if ($StreamMon1 == 1) {
		$modid = $s1['ICESTATS'][$live2]['GENRE'];
		}
		else
		{
		$modid = $s1['ICESTATS'][$automation]['GENRE'];
		}
}
else if ($s1['ICESTATS'][$live1]['GENRE']) {
	if ($StreamMon0 == 1) {
		$modid = $s1['ICESTATS'][$live1]['GENRE'];
		}
		else
		{
		$modid = $s1['ICESTATS'][$automation]['GENRE'];
		}
	
}
else if ($s1['ICESTATS'][$automation]['GENRE']) {
	$modid = $s1['ICESTATS'][$automation]['GENRE'];
}

	
echo '<img src="//www.radio-zoom.de/fileadmin/avatar/id_'.$modid.'.jpg" alt="Moderator auf Sendung" class="img now-on-air">';
?>