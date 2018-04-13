<?php
/**
 * These 2 functions can be used to read all available Stats Data from your Icecast2 Server
 * The XML Parser requires to use Admin Password but than has access to all mountpoints, even those that are hidden.
 * The default JSON File access on Icecast2 can be used on unhidden mount points only.
 *
 * @package     
 * @license     http://www.gnu.org/licenses/agpl.html AGPL Version 3
 * @author      Malte Schroeder <post@malte-schroeder.de>
 * @copyright   Copyright (c) 2017-2018 Malte Schroeder (http://www.malte-schroeder.de)
 *
 */


error_reporting(0);

// Access Icecast Admin Stats XML structure
// Original Source Dale Ghent: http://lists.xiph.org/pipermail/icecast/2004-September/007553.html

function getAdminInfo($icecastserver, $icecastadmminpass){
	$data = file_get_contents('http://admin:'.$icecastadmminpass.'@'.$icecastserver.'/admin/stats');
	
	// Now parse the XML output for our mountpoint
		$xml_parser = xml_parser_create();
		xml_parse_into_struct($xml_parser, $data, $vals, $index);
		xml_parser_free($xml_parser);

		$params = array();
		$level = array();
		foreach ($vals as $xml_elem) {
			 if ($xml_elem['type'] == 'open') {
				if (array_key_exists('attributes',$xml_elem)) {
					list($level[$xml_elem['level']],$extra) = 
		array_values($xml_elem['attributes']);
				 } else {
					 $level[$xml_elem['level']] = $xml_elem['tag'];
				 }
			 }
			 if ($xml_elem['type'] == 'complete') {
				 $start_level = 1;
				 $php_stmt = '$params';
				 while($start_level < $xml_elem['level']) {
					 $php_stmt .= '[$level['.$start_level.']]';
					 $start_level++;
				 }
				 $php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
				 eval($php_stmt);
			 }
		}
	return $params;
}


// Actually I don't remember where I found the code basis for his. If you recognize your code and want to be mentioned here, please just let me know.

function getStreamInfo($icecastserver, $icecastmount){
	if($str = file_get_contents('http://'.$icecastserver.'/status-json.xsl?mount='.$icecastmount)){
	#$str = utf8_decode($str);
	$json_a = json_decode($str, true);
	
		if(empty($json_a['icestats']['source']['bitrate'])) {
			$stream['info']['status'] = 'OFF AIR';	
		} 
		else{
				$stream['info']['status'] = 'ON AIR';
				$stream['info']['title'] = $json_a['icestats']['source']['title']; 
				$stream['info']['description'] = $json_a['icestats']['source']['server_description']; 
				$stream['info']['type'] = $json_a['icestats']['source']['server_type']; 
				$stream['info']['start'] = $json_a['icestats']['source']['stream_start']; 
				$stream['info']['bitrate'] = $json_a['icestats']['source']['bitrate']; 
				$stream['info']['listeners'] = $json_a['icestats']['source']['listeners']; 
				$stream['info']['max_listeners'] = $json_a['icestats']['source']['listener_peak']; 
				$stream['info']['genre'] = $json_a['icestats']['source']['genre']; 
				$stream['info']['stream_url'] = $json_a['icestats']['source']['listenurl'];
				$stream['info']['artist_song'] = $json_a['icestats']['source']['title'];
					$x = explode(" - ",$json_a['icestats']['source']['title']);
				$stream['info']['artist'] = $x[0]; 
				$stream['info']['song'] = $x[1];
		}
	}
	return $stream;
	}
?>