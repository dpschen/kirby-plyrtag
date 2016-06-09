<?php
/*
 * kirbytag plyrtag
 * implements html syntax for plyr video, vimeo & youtube player
 * add plyr css and js and
 * call plyr.setup(); to initialize videos
 *
 * syntax:
 * (plyr: video mp4: /path/to/video.mp4 webm: /path/to/video.webm)
 * (plyr: VIMEOID)
 * (plyr: YOUTUBEID)
 *
 * copyright: Dominik Pschenitschn | pschen.de
 * license: http://www.gnu.org/licenses/gpl-3.0.txt GPLv3 License
 *
 */
 kirbytext::$tags['plyr'] = array(
  'attr' => array(
    'poster',
    'hls',
    'mp4',
    'webm',
    'id'
  ),
  'html' => function($tag) {

    $type = $tag->attr('plyr');

    // check if html5video, youtube or vimeo
    if (strtolower($type) === 'video') {
      // is html5video
      $baseurl =  url('/video/');

      if (strtolower($tag->attr('mp4')) !== '') {
        $mp4source = $tag->attr('mp4');
        $mp4url = $baseurl . urlencode($mp4source);
        $mp4source = '<source src="' . $mp4url . '" type="video/mp4">';
      } else {
        $mp4source = "";
      }

      if (strtolower($tag->attr('webm')) !== '') {
        $mp4source = $tag->attr('mp4');
        $webmurl = $baseurl . urlencode($mp4source);
        $webmsource = '<source src="' . $webmurl . '" type="video/webm">';}
      else {
        $webmsource = "";
      }

      $poster = $tag->attr('poster');
      if (file_exists($baseurl . urlencode($poster))) {

        $posterurl = $baseurl . urlencode($poster);
        $postersource = 'poster="' . $posterurl . '"';
      } else {
        $postersource = '';
      }

      return '<video controls="controls" ' . $postersource . '>' .
        $hlssource .
        $mp4source .
        $webmsource .
        'Dein Browser kann HTML5-Video nicht. Nimm eine aktuelle Version. Your browser does not support the video tag, choose an other browser.' .
        '</video>';
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
