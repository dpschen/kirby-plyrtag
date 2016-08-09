# kirby plyrtag | Kirbytag for [plyr player](https://github.com/Selz/plyr)
Implements html syntax for plyr video, vimeo & youtube player

by Dominik Pschenitschni
[pschen.de](http://pschen.de) | [Github](https://github.com/dpschen)

## Introduction

This is an extension of kirbytext for the [kirby cms](getkirby.com), which adds an easy way to embed your self-hosted html5-video and audio sources, vimeo & youtube player with the beautiful plyr as UI.

This extension can handle mp4 (h.264), webm and HTTP-live-streaming sources as well as a poster. You can select, which sources you have (for audio mp3 / ogg).

It is as well possible to embed a YouTube or Vimeo video via the video ID. Kirby plyrtag automatically detects if the ID is from YouTube or Vimeo and includes. For this it is better to **enable caching** in kirby (because the detection takes some time).

## Quick setup
  1. Add plyr css and js and as told in the [plyr readme.](https://github.com/Selz/plyr/blob/master/readme.md)
  Include the plyr.css stylsheet into your `<head>`.

  ```html
      <link rel="stylesheet" href="path/to/plyr.css">
  ```
  2. Store the plyrtag.php in
    ```
        site/tags/
    ```

  3. **Optional for self hosted videos:** Store your video files in a folder named ```video```
    in your html-root (or change the `$baseurl` in plyrtag.php if you want a different folder).
      * have a name for your video-files, e.g. "NAME"
      * name and store it with this sceme:

  4. Add a kirbytag to your content-file (txt) at the point you want the video to be:  

    * **Self hosted videos**

      Just use the attributes that you need.
      The all paths are relative to the ```video``` folder of step 3.

      ```
      (plyr: video hls: path/to/hlsFolder/hlsfile.m3u8 mp4: path/to/video.mp4 webm: path/to/video.webm poster: path/to/poster.jpg)
      ```

      (I didn't test HLS yet, so I don't know if that works. Help in converting videos is welcome).

    * **Self hosted audios**

      Just use the attributes that you need.

      ```
      (plyr: audio mp3: path/to/audio.mp3 ogg: path/to/audio.ogg)
      ```

    * **YouTube videos**

      ```
      (plyr: YOUTUBEID)
      ```
    * **Vimeo videos**

      ```
      (plyr: VIMEOID)
      ```

  3. Call plyr.setup(); to initialize videos.


## Why not store the video files in the content folder?
The videos are stored in a separate folder, so you can prevent those huge files from being added to git or dropbox (by excluding the video folder from the sync).

**Exclude this folder from dropbox-sync before you add any content to that folder! Or move the content temporary to another folder! Otherwise alle the content in the excluded folder will be removed from the local directory (but not the server)**

## Why not do the same for audio files?
Because audio files are usually much smaller then video files I thought it's alright to just add them in the content folder or where else you like them to be.

## Todo:
- [x] Add audio support (added in 0.2.0)
- [ ] Auto detect if the source files exist.
- [ ] Find out how to easy convert files to hls (I don't use it myself yet). Any ideas?
- [ ] Find a better (faster ) method to find out if video id is from youtube or vimeo.

License: http://www.gnu.org/licenses/gpl-3.0.txt GPLv3 License

Based on [kirbytag html5video](https://github.com/jbeyerstedt/kirby-kirbytag-html5video) by Jannik Beyerstedt from Hamburg, Germany
[jannikbeyerstedt.de](http://jannikbeyerstedt.de) | [Github](https://github.com/jbeyerstedt).
Thanks!
