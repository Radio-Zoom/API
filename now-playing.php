<?php 
/**
 * This is an example how to read current running title from 2 different servers with 2 mountpoints configured with the Icecast Fallback mount.
 * It provides double redundancy and makes sure a title is displayed even if one of your servers does not respond.
 *
 * @package     
 * @license     http://www.gnu.org/licenses/agpl.html AGPL Version 3
 * @author      Malte Schroeder <post@malte-schroeder.de>
 * @copyright   Copyright (c) 2017-2018 Malte Schroeder (http://www.malte-schroeder.de)
 *
 */
header('Access-Control-Allow-Origin: *');
require('include/function.inc.php');
require('include/config.inc.php');

$stream1 = getStreamInfo($server1, $mount1);
$stream2 = getStreamInfo($server1, $mount2);
$stream3 = getStreamInfo($server2, $mount1);
$stream4 = getStreamInfo($server2, $mount2);

if (($stream4['info']['status']) == 'OFF AIR') {
	if (($stream3['info']['status']) == 'OFF AIR') {
		if (($stream2['info']['status']) == 'OFF AIR') {
			if (($stream1['info']['status']) == 'OFF AIR') {
				echo "Zur Zeit leider keine Titelinformaitionen";}
				else {
				echo $stream1['info']['artist_song'];
				}
			}
			else {
			echo $stream2['info']['artist_song'];
			}			
		}
		else {
		echo $stream3['info']['artist_song'];
		}
	}
	else {
	echo $stream4['info']['artist_song'];	

	}


?>