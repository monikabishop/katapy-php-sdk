# katapy-php-sdk
Simply integrate Katapy into your Website with the Katapy PHP SDK.

This repository contains the open source PHP SDK that allows you to access the Katapy Platform from your PHP app. Except as otherwise noted,
the Katapy PHP SDK is licensed under the Apache Licence, Version 2.0
(http://www.apache.org/licenses/LICENSE-2.0.html).


System Requirements
-------------------
PHP 5.4 or greater


Installing the Katapy SDK for PHP
---------------------------------
Download the source code and unzip it in your project.


Configuration
-------------
Replace the {library} and {apikey} inside katapyphp/katapysetup.php with your Katapy library and API key which can be obtained from the Katapy support team.
```php
/****** Your Katapy API Key ******************/
$apiKey = "123434234325565465456";

/****** Your Katapy Media Library Code for VOD *******/
$library = "ny2c";
```

Usage
-----
The minimal setup requires the following line:

```php
require_once 'katapy-php-sdk/src/katapysetup.php';
```

To make API calls:
```php
$galleries = KatapyVod::getGalleries($library);
//uncomment the line below to display the results from Katapy
//echo json_encode($galleries);
```

Examples
-----
The [examples] are a good place to start.

1) galleries.php 
This page uses the Katapy PHP API to load all video galleries and playlists from a given library.
It does not require any URL parameters.
Example URL: http://localhost/KATAPYPHP/examples/galleries.php

2) examples/contents.php?cd=[GALLERY_CODE]
This page uses the Katapy PHP API to load all videos from a given video gallery or playlist via the
code identifier in the URL $_REQUEST["cd"].
This identifier is provided to you in the galleries.php example. You can also checkout the gallery code in the Katapy Admin Console on the General Settings page for the gallery.
Example URL: http://localhost/KATAPYPHP/examples/contents.php?cd=videos

