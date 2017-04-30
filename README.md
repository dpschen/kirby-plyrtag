# kirby plyrtag | Kirbytag for [plyr player](https://github.com/Selz/plyr)
Implements html syntax for plyr video, audio, vimeo & youtube player

by Dominik Pschenitschni
[pschen.de](http://pschen.de) | [Github](https://github.com/dpschen)

## Introduction

This is an extension of kirbytext for the [kirby cms](getkirby.com), which adds an easy way to embed your self-hosted html5-video and audio sources, vimeo & youtube player with the beautiful plyr as UI.

This extension can handle mp4 (h.264), webm and HTTP-live-streaming sources as well as a poster. You can select, which sources you have (for audio mp3 / ogg).

It is as well possible to embed a YouTube or Vimeo video via the video ID. Kirby plyrtag automatically detects if the ID is from YouTube or Vimeo and includes. For this it is better to [**enable caching**](https://getkirby.com/docs/developer-guide/advanced/caching) in kirby (because the detection takes some time).

## Quick setup
1. Store the plyrtag.php in
  ```html
  site/tags/
  ```

2. __(Optional for self hosted media)__ Store your video / audio files in the content folder of your page.

3. Add plyr css and js and as told in the [plyr readme.](https://github.com/Selz/plyr/blob/master/readme.md)

  Include the plyr.css stylsheet into your `<head>`.

  ```html
  <link rel="stylesheet" href="path/to/plyr.css">
  ```

  Include the plyr.js script before the closing ```</body>``` tag and then call ```plyr.setup();``` to initialize it.

  ```html
  <script src="path/to/plyr.js"></script>
  <script>plyr.setup();</script>
  ```

## Use tag
Add a kirbytag to your content-file (txt) at the point you want the video to be.

### For self hosted videos

By default paths are relative to the current page folder (can be changed with [kirby options](#kirby_options)).

```mk
(plyr: video mp4: video.mp4 webm: video.webm hls: hlsFolder/hlsfile.m3u8 poster: poster.jpg)
```

Just use the tag attributes that you need (eg. just ```mp4```, ```web``` and ```poster```).

(I didn't test HLS yet, so I don't know if that works. Help in converting videos is welcome).

### For self hosted audios

Just use the attributes that you need.

```mk
(plyr: audio mp3: audio.mp3 ogg: audio.ogg)
```

### For YouTube videos

```mk
(plyr: YOUTUBEID)
```

### For Vimeo videos

```mk
(plyr: VIMEOID)
```

## Kirby options<a name="kirby_options"></a>

**Optional for self hosted files:** Store your media files in a separate folders, so you can prevent those huge files from being added to git or dropbox (by excluding them from the sync). Add options to your [kirby config file](https://getkirby.com/docs/developer-guide/configuration/options).

**Exclude this folder from dropbox-sync before you add any content to that folder! Or move the content temporary to another folder! Otherwise all the content in the excluded folder will be removed from the local directory (but not the server)**

### Video Files

<table class="table" width="100%" id="fullscreen-options">
  <thead>
    <tr>
      <th width="30%">Option</th>
      <th width="10%">Type</th>
      <th width="10%">Default</th>
      <th width="50%">Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><code>plyrtag.globalVideoFolder</code></td>
      <td>Boolean</td>
      <td><code>false</code></td>
      <td>Toggles if your video files should be stored in a global video folder (default: <code>video</code>) in your kirby root folder.</td>
    </tr>
    <tr>
      <td><code>plyrtag.globalVideoFolderName</code></td>
      <td>String</td>
      <td><code>video</code></td>
      <td>Set a different name for the global video folder.</td>
    </tr>
  </tbody>
</table>

### Audio Files

<table class="table" width="100%" id="fullscreen-options">
  <thead>
    <tr>
      <th width="30%">Option</th>
      <th width="10%">Type</th>
      <th width="10%">Default</th>
      <th width="50%">Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><code>plyrtag.globalAudioFolder</code></td>
      <td>Boolean</td>
      <td><code>false</code></td>
      <td>Toggles if your audio files should be stored in a global audio folder (default: <code>audio</code>) in your kirby root folder.</td>
    </tr>
    <tr>
      <td><code>plyrtag.globalAudioFolderName</code></td>
      <td>String</td>
      <td><code>audio</code></td>
      <td>Set a different name for the global audio folder.</td>
    </tr>
  </tbody>
</table>

### Example configuration

```php
c::set('plyrtag.globalVideoFolder', true);
c::set('plyrtag.globalVideoFolderName', 'myVideoFolder');

c::set('plyrtag.globalAudioFolder', true);
c::set('plyrtag.globalAudioFolderName', 'myAudioFolder');
```

## Todo:
- [x] Add audio support (added in 0.2.0)
- [ ] Auto detect if the source files exist.
- [ ] Find out how to easy convert files to hls (I don't use it myself yet). Any ideas?
- [ ] Find a better (faster ) method to find out if video id is from youtube or vimeo.

License: http://www.gnu.org/licenses/gpl-3.0.txt GPLv3 License

Based on [kirbytag html5video](https://github.com/jbeyerstedt/kirby-kirbytag-html5video) by Jannik Beyerstedt from Hamburg, Germany
[jannikbeyerstedt.de](http://jannikbeyerstedt.de) | [Github](https://github.com/jbeyerstedt).
Thanks!
