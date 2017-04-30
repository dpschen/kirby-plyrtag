<?php
/*
 * kirbytag plyrtag
 * implements html syntax for plyr video, audio vimeo & youtube player
 *
 * by Dominik Pschenitschni http://pschen.de) | https://github.com/dpschen
 * based on kirbytag-html5video https://github.com/jbeyerstedt/kirby-kirbytag-html5video by Jannik Beyerstedt
 * license: http://www.gnu.org/licenses/gpl-3.0.txt GPLv3 License
 *
 */
 kirbytext::$tags['plyr'] = array(
  'attr' => array(
    'poster',
    'hls',
    'mp4',
    'webm',
    'mp3',
    'ogg'
  ),
  'html' => function($tag) {

    $type = $tag->attr('plyr');

    // check if html5video, audio, youtube or vimeo
    if (strtolower($type) === 'video') {
      // is html5video

      // check if should use globalVideoFolder
      if (c::get('plyrtag.globalVideoFolder', false) == true) {
        $globalVideoFolderName = c::get('plyrtag.globalVideoFolderName', 'video');
        if ($tag->page()->site()->languages()) { // multi-language site
          $baseVideoPath = $tag->page()->site()->language()->url() . '/' . $globalVideoFolderName . '/';
        } else { // single-language site
          $baseVideoPath = $tag->page()->site()->url() . '/' . $globalVideoFolderName . '/';
        }
      } else {
        $baseVideoPath = $tag->page()->url() . '/';
      }

      if (strtolower($tag->attr('hls')) !== '') {
        $hlsurl = $baseVideoPath . urlencode($tag->attr('hls'));
        $hlssource = '<source src="' . $hlsurl . '" type="application/x-mpegurl">';}
      else {
        $hlssource = "";
      }

      if (strtolower($tag->attr('mp4')) !== '') {
        $mp4url = $baseVideoPath . urlencode($tag->attr('mp4'));
        $mp4source = '<source src="' . $mp4url . '" type="video/mp4">';
      } else {
        $mp4source = "";
      }

      if (strtolower($tag->attr('webm')) !== '') {
        $webmurl = $baseVideoPath . urlencode($tag->attr('webm'));
        $webmsource = '<source src="' . $webmurl . '" type="video/webm">';}
      else {
        $webmsource = "";
      }

      $poster = $tag->attr('poster');
      if (file_exists($baseVideoPath . urlencode($poster))) {

        $posterurl = $baseVideoPath . urlencode($poster);
        $postersource = 'poster="' . $posterurl . '"';
      } else {
        $postersource = '';
      }

      return '<video controls="controls" ' . $postersource . '>' .
        $hlssource .
        $mp4source .
        $webmsource .
        'Dein Browser unterstützt kein HTML5 Video. Bitte verwende eine aktuelle Version.' .
        '</video>';

    } else if (strtolower($type) === 'audio') {
      // is audio

      // check if should use globalAudioFolder
      if (c::get('plyrtag.globalAudioFolder', false) == true) {
        $globalAudioFolderName = c::get('plyrtag.globalAudioFolderName', 'audio');
        if ($tag->page()->site()->languages()) { // multi-language site
          $baseAudioPath = $tag->page()->site()->language()->url() . '/' . $globalAudioFolderName . '/';
        } else { // single-language site
          $baseAudioPath = $tag->page()->site()->url() . '/' . $globalAudioFolderName . '/';
        }
      } else {
        $baseAudioPath = $tag->page()->url() . '/';
      }

      if (strtolower($tag->attr('mp3')) !== '') {
        $mp3url = $baseAudioPath . urlencode($tag->attr('mp3'));
        $mp3source = '<source src="' . $mp3url . '" type="audio/mp3">';
      } else {
        $mp3source = "";
      }

      if (strtolower($tag->attr('ogg')) !== '') {
        $oggurl = $baseAudioPath. urlencode($tag->attr('ogg'));
        $oggsource = '<source src="' . $oggurl . '" type="audio/ogg">';
      } else {
        $oggsource = "";
      }

      return '<audio controls>' .
        $mp3source .
        $oggsource .
      '</audio>';

    } else {
      // check if youtube id
      // https://webapps.stackexchange.com/questions/54443/format-for-id-of-youtube-video/54448#54448
      // http://thisinterestsme.com/check-see-http-resource-exists-php/
      // https://stackoverflow.com/questions/29166402/verify-if-video-exist-with-youtube-api-v3
      $headers = get_headers('https://www.youtube.com/oembed?format=json&url=http://www.youtube.com/watch?v=' . $type);
      if(is_array($headers) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$headers[0]) : false) {
        // is youtube
        $videoID = $type;
        return '<div data-type="youtube" data-video-id="' . $videoID  . '"></div>';
      } else {
        // should be vimeo
        $videoID = $type;
        return '<div data-type="vimeo" data-video-id="' . $videoID  . '"></div>';
      }
    }
  }
 );
