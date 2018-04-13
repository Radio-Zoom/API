/**
 * This is an example how to refresh fetching title data from now-playing.php
 *
 * @package     
 * @license     http://www.gnu.org/licenses/agpl.html AGPL Version 3
 * @author      Malte Schroeder <post@malte-schroeder.de>
 * @copyright   Copyright (c) 2017-2018 Malte Schroeder (http://www.malte-schroeder.de)
 *
 */


function updateNowPlaying(){
    $.ajax({
      url: "./now-playing.php",
      cache: false,
      success: function(html){
        $("#nowPlaying").html(html);
      }
    });
  }
  updateNowPlaying();
  setInterval( "updateNowPlaying()", 90000 );