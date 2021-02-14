<?php
/**
 * Get JSON Data from your Icecast2 Server to be used with mairlist-control

 *
 * @package     
 * @license     http://www.gnu.org/licenses/agpl.html AGPL Version 3
 * @author      Malte Schroeder <post@malte-schroeder.de>
 * @copyright   Copyright (c) 2017-2021 Malte Schroeder (http://www.malte-schroeder.de)
 *
 */

header('Access-Control-Allow-Origin: *');
require('include/function.inc.php');
require('include/config.inc.php');

$s1 = getAdminInfo($server1, $adminpass);

echo json_encode($s1, JSON_FORCE_OBJECT);
#print_r ($s1);
?>
