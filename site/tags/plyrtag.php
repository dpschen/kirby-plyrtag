<?php
/*
 * kirbytag plyrtag
 * implements html syntax for plyr video, vimeo & youtube player
 *
 * call plyr.setup(); to initialize videos
 *
 * copyright: Dominik Pschenitschn | pschen.de
 * license: http://www.gnu.org/licenses/gpl-3.0.txt GPLv3 License
 *
 */
 kirbytext::$tags['plyrvideo'] = array(
   'attr' => array(
     'h264',
     'webm'
   ),
   'html' => function($tag) {
     $source = $tag->attr('plyrvideo');

     $baseurl =  url('/video/');
     $posterurl = $baseurl . urlencode($source) . '.png';


     if ($tag->attr('h264') === null || strtolower($tag->attr('h264')) === 'true' ) {
       $mp4url = $baseurl . urlencode($source) . '.mp4';
       $mp4source = '<source src="' . $mp4url . '" type="video/mp4">';}
     else {
       $mp4source = "";}

     if ($tag->attr('webm') === null || strtolower($tag->attr('webm')) === 'true' ) {
       $webmurl = $baseurl . urlencode($source) . '.webm';
       $webmsource = '<source src="' . $webmurl . '" type="video/webm">';}
     else {
       $webmsource = "";}

     if (file_exists($source . '.png')) {
       $postersource = 'poster="' . $posterurl . '"';
     } else {
       $postersource = '';
     }


     return '<video controls="controls" ' . $postersource . '>' .
       $mp4source .
       $webmsource .
       '</video>';

   }
 );

kirbytext::$tags['plyrvimeo'] = array(
  'attr' => array(
    'options'
  ),
  'html' => function($tag) {
    $videoID = $tag->attr('plyrvimeo');
    return '<div data-type="vimeo" data-video-id="' . $videoID  . '"></div>';
  }
);

kirbytext::$tags['plyryoutube'] = array(
  'attr' => array(
    'options'
  ),
  'html' => function($tag) {
    $videoID = $tag->attr('plyryoutube');
    return '<div data-type="youtube" data-video-id="' . $videoID  . '"></div>';
  }
);
