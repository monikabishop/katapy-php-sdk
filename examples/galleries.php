<?php require_once '../src/katapysetup.php'; 
/*****************************************************************************************************
******************************************************************************************************
******************************************************************************************************
Video Galleries & Playlists
******************************************************************************************************
This example uses the Katapy PHP API to load all video galleries and playlists from a given library.
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

$galleries = KatapyVod::getGalleries($library);
//uncomment the line below to see the results from Katapy
//echo json_encode($galleries);

//page context for feed links (for absolute URLs)
$serverUrl  = "";

echo '[';

$gcount = 0;
foreach ($galleries as $rowcount => $g) {
	if ($g->publishflg=='Y'  //check if gallery is published
		&& (($g->typeCd=="VIDEO" && $g->pubcontentCount>0) //check if gallery contains published videos
			|| ($g->typeCd=="PLAYL" && $g->videocount>0))) {  //check if playlist contains any videos
		
		$imgthumb = htmlspecialchars($serverUrl . "/img/default_poster.png");
		if ($g->{'imgthumbblobId'}!=null) {
			$imgthumb = htmlspecialchars(KatapyVod::getLargeImgthumbUrlById($g->{'imgthumbblobId'}));
		}
		$url = $serverUrl . '/examples/contents.php?cd=' . $g->cd;
		if ($g->typeCd=="FOLDE" && $loadContentByFolder) {
			$url .= "&byfolder=true";
		} else if ($g->typeCd=="PLAYL") {
			$url .= "&type=playlist";
		}
		
		if ($gcount>0) {
			echo ", ";
		}
		echo '{"id":' . $g->id . ', ';
		echo '"cd":"' . $g->cd . '", ';
		echo '"nm":"' . htmlspecialchars($g->nm) . '", ';
		echo '"desc":"' . htmlspecialchars($g->shortDesc) . '", ';
		echo '"videocount":' . $g->pubcontentCount . ', ';
		echo '"imgthumb":"' . htmlspecialchars($imgthumb) . '", ';
		echo '"feed":"' . htmlspecialchars($url) . '"}';
		$gcount++;
	}
}

echo "]";
	?>	


