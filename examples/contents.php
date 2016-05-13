<?php require_once '../src/katapysetup.php'; 
/*****************************************************************************************************
******************************************************************************************************
******************************************************************************************************
Videos from Video Galleries & Playlists
******************************************************************************************************
This example uses the Katapy PHP API to load all videos from a gived video gallery or playlist via the
code identifier in the URL $_REQUEST["cd"].
The library code and Katapy API key are configured in katapyphp/katapysetup.php
In order to get more information about the URL request, go to katapyphp/katapysetup.php and set 
KatapyConnect::setTestMode(true);
******************************************************************************************************
For speed optimization in a production environment, we highly recommend to use caching. 
Please feel free to ask the Katapy team for examples for caching support.
******************************************************************************************************
Website: http://katapy.com
Email: support@katapy.com
******************************************************************************************************
******************************************************************************************************
*****************************************************************************************************/

header('Content-Type: application/json');

if (isset($_REQUEST["cd"])) {
	$galleryCd = $_REQUEST["cd"];
} else {
	//if the request parameter is missing, use a default gallery code for this demo page
	$galleryCd = "nycuncovered"; 
}

if (isset($_REQUEST["type"]) && $_REQUEST["type"]=="playlist") {
	$contents = KatapyVod::getContentsFromPlaylist($galleryCd, $library);
} else {
	$contents = KatapyVod::getContentsFromGallery($galleryCd, $library);
}

//uncomment the line below to display the results from Katapy
//echo json_encode($contents);

//page context for feed links (for absolute URLs)
$serverUrl  = "";


echo '[';
		
$count = 0;
foreach ($contents as $rowcount => $c) {
	if ($c->publishflg=='Y') {
		
		$imgthumb = $serverUrl . "/img/default_poster.png";
		if ($c->{'imgthumbblobId'}!=null) {
			$imgthumb = $c->lrgimgthumb;
		}
		$poster = $c->imgUrl;
		$url = $c->httpUrl;
		$url = str_replace("_LD","_SD",$url);
		$url = str_replace("_LOW","_MED",$url);
		if (isset($c->contentId)) {
			$contentId = $c->contentId;
		} else {
			$contentId = $c->id;
		}
		
		if ($count>0) {
			echo ", ";
		} //else {
		//echo '"' . $g->id . '":';	
		echo '{"id":' . $contentId . ', ';
		echo '"cd":"' . $c->cd . '", ';
		echo '"nm":"' . trim(htmlspecialchars($c->nm)) . '", ';
		echo '"desc":"' . trim(htmlspecialchars($c->shortDesc)) . '", ';
		echo '"duration":"' . substr($c->duration, 11) . '", ';
		echo '"imgthumb":"' . htmlspecialchars($imgthumb) . '", ';
		echo '"poster":"' . htmlspecialchars($poster) . '", ';
		echo '"url":"' . htmlspecialchars($url) . '"}';
		$count++;
	}
}


echo "]";
?>


