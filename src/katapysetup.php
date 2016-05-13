<?php

/****** Your Katapy API Key ******************/
$apiKey = "123434234325565465456";

/****** Your Katapy Media Library Code for VOD *******/
$library = "ny2c";

/****** Your MCN Code for your MYCHANNEL administration console *******/
$mcnkey = "katapy";

/****** Mandatory include(s) *****************/
/****** Always include KatapyConnect for **********/
/****** any Katapy PHP API function. *********/
require_once "katapyconnect.php";
<<<<<<< HEAD
=======
require_once "katapyadminconnect.php";
>>>>>>> refs/heads/mbishop

/****** KatapyConnect Config Parameters ***********/
/****** setTestMode(true) echoes the JSON request URLs to Katapy *************/
KatapyConnect::setTestMode(false);
<<<<<<< HEAD
=======
KatapyAdminConnect::setTestMode(false);

>>>>>>> refs/heads/mbishop

/****** Optional include(s) ******************/ 
/****** katapyvod.php includes API functions for VOD Streaming ************/ 
include_once "katapyvod.php";

/****** katapylive.php includes API functions for Live Video Streaming ****/ 
include_once "katapylive.php";

/****** katapydate.php includes common date functions for Katapy Videos ***/ 
include_once "katapydate.php";

/****** katapycms.php includes functions for Katapy Managed Content ***/ 
include_once "katapycms.php";

/****** katapygroup.php includes functions for Katapy MCN support ***/ 
include_once "katapygroup.php";

<<<<<<< HEAD

=======
/****** katapyaccount.php includes functions for Katapy account management ***/ 
include_once "katapyaccount.php";

include_once "katapymember.php";
>>>>>>> refs/heads/mbishop
?>