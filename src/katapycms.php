<?php


class KatapyCms {
	
	static public function version() {
  		echo '3.0';
	}
	
	static public function getGalleries($libraryCd) {
		$response = KatapyConnect::sendCommand("/galleries/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getFolders($libraryCd) {
		$response = KatapyConnect::sendCommand("/galleries/folder/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getGalleriesByFolder($folderCd, $libraryCd) {
		$response = KatapyConnect::sendCommand("/galleriesbyfolder/" . $folderCd . "/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getImageGalleries($libraryCd) {
		$response = KatapyConnect::sendCommand("/galleries/image/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getVideoGalleries($libraryCd) {
		$response = KatapyConnect::sendCommand("/galleries/video/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getTextGalleries($libraryCd) {
		$response = KatapyConnect::sendCommand("/galleries/text/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getBlogGalleries($libraryCd) {
		$response = KatapyConnect::sendCommand("/galleries/blog/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getLinkGalleries($libraryCd) {
		$response = KatapyConnect::sendCommand("/galleries/link/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getLibrary($libraryCd) {
		$response = KatapyConnect::sendCommand("/library/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getIdGallery($libraryCd) {
		$response = KatapyConnect::sendCommand("/gallery/id/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getMetaGallery($libraryCd) {
		$response = KatapyConnect::sendCommand("/gallery/meta/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getContacts($libraryCd) {
		$response = KatapyConnect::sendCommand("/contacts/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getGalleryByCd($cd, $libraryCd) {
		$response = KatapyConnect::sendCommand("/gallery/cd/" . $cd . "/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getGallery($id, $libraryCd) {
		$response = KatapyConnect::sendCommand("/gallery/" . $id, null);
		return json_decode($response);
	}
	
	static public function getAllUpdatedContentsFromLibrary($libraryCd, $date) { //since date/time mm/DD/yyyy 00:00:00
		$params = "date=" . urlencode($date);
		$response = KatapyConnect::sendCommand("/contentsAll/library/" . $libraryCd, $params);
		return json_decode($response);
	}
	
	static public function getUpdatedContentsFromLibrary($libraryCd, $date) { //since date/time mm/DD/yyyy 00:00:00
		$params = "date=" . urlencode($date);
		$response = KatapyConnect::sendCommand("/contents/library/" . $libraryCd, $params);
		return json_decode($response);
	}
	
	static public function getAllContentsFromLibrary($libraryCd) {
		$response = KatapyConnect::sendCommand("/contentsAll/library/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getContentsFromLibrary($libraryCd) {
		$response = KatapyConnect::sendCommand("/contents/library/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getContentsFromGallery($cd, $libraryCd) {
		$response = KatapyConnect::sendCommand("/contents/" . $cd . "/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getImagesFromGallery($cd, $libraryCd) {
		$response = KatapyConnect::sendCommand("/contents/image/" . $cd . "/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getRandomImagesFromGallery($cd, $libraryCd, $num) {
		$response = KatapyConnect::sendCommand("/contentsRandom/image/" . $cd . "/" . $libraryCd . "/" . $num, null);
		return json_decode($response);
	}
	
	static public function getVideosFromGallery($cd, $libraryCd) {
		$response = KatapyConnect::sendCommand("/contents/video/" . $cd . "/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getRandomVideosFromGallery($cd, $libraryCd, $num) {
		$response = KatapyConnect::sendCommand("/contentsRandom/video/" . $cd . "/" . $libraryCd . "/" . $num, null);
		return json_decode($response);
	}

		static public function getRecentContentsFromGallery($cd, $libraryCd, $max) {
		$params = "max=" . $max;
		$response = KatapyConnect::sendCommand("/contents/recent/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}

	static public function getPopularContentsFromGallery($cd, $libraryCd, $max) {
		$params = "max=" . $max;
		$response = KatapyConnect::sendCommand("/contents/popular/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}

	static public function getRecentVideosFromGallery($cd, $libraryCd, $max) {
		$params = "max=" . $max;
		$response = KatapyConnect::sendCommand("/contents/video/recent/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}

	static public function getPopularVideosFromGallery($cd, $libraryCd, $max) {
		$params = "max=" . $max;
		$response = KatapyConnect::sendCommand("/contents/video/popular/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}

	static public function getRecentContentsFromFolder($cd, $libraryCd, $max) {
		$params = "max=" . $max;
		$response = KatapyConnect::sendCommand("/contents/recent/folder/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}

	static public function getPopularContentsFromFolder($cd, $libraryCd, $max) {
		$params = "max=" . $max;
		$response = KatapyConnect::sendCommand("/contents/popular/folder/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}

	static public function getRecentVideosFromFolder($cd, $libraryCd, $max) {
		$params = "max=" . $max;
		$response = KatapyConnect::sendCommand("/contents/video/recent/folder/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}

	static public function getPopularVideosFromFolder($cd, $libraryCd, $max) {
		$params = "max=" . $max;
		$response = KatapyConnect::sendCommand("/contents/video/popular/folder/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}
	
	static public function searchVideosOrderByAlphabet($libraryCd, $searchText) {
		$params = "q=" . urlencode($searchText);
		$response = KatapyConnect::sendCommand("/videosearch/alphabet/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}
	
	static public function searchVideosOrderByRecent($libraryCd, $searchText) {
		$params = "q=" . urlencode($searchText);
		$response = KatapyConnect::sendCommand("/videosearch/recent/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}
	
	static public function searchVideosOrderByPopular($libraryCd, $searchText) {
		$params = "q=" . urlencode($searchText);
		$response = KatapyConnect::sendCommand("/videosearch/popular/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}
	
	static public function searchContentOrderByAlphabet($libraryCd, $searchText) {
		$params = "q=" . urlencode($searchText);
		$response = KatapyConnect::sendCommand("/contentsearch/alphabet/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}
	
	static public function searchContentOrderByRecent($libraryCd, $searchText) {
		$params = "q=" . urlencode($searchText);
		$response = KatapyConnect::sendCommand("/contentsearch/recent/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}
	
	static public function searchContentOrderByPopular($libraryCd, $searchText) {
		$params = "q=" . urlencode($searchText);
		$response = KatapyConnect::sendCommand("/contentsearch/popular/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}
	
	static public function getContent($id, $libraryCd) {
		$response = KatapyConnect::sendCommand("/content/" . $id . "/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getContentByCd($cd, $libraryCd) {
		$response = KatapyConnect::sendCommand("/content/cd/" . $cd . "/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getContentForDevice($id, $libraryCd, $device) {
		$params = "device=" . $device;
		$response = KatapyConnect::sendCommand("/content/" . $id . "/" . $libraryCd, $params);
		return json_decode($response);
	}
	
	static public function captureUsage($id) {
		KatapyConnect::sendCommand("/contentusage/" . $id, null);
	}
	
	static public function getImgthumbUrlById($imgthumbid) {
		return str_replace("katapy.com/extapi", "katapy.com/api", KatapyConnect::getKatapyBase()) . "/mmimgthumb.php?large=false&id=" . $imgthumbid;
	}
	
	static public function getLargeImgthumbUrlById($imgthumbid) {
		return str_replace("katapy.com/extapi", "katapy.com/api", KatapyConnect::getKatapyBase()) . "/mmimgthumb.php?large=true&id=" . $imgthumbid;
	}
	
	
	static public function getImgUrlById($contentid, $filename) {
		return str_replace("katapy.com/extapi", "katapy.com/api", KatapyConnect::getKatapyBase()) . "/mmimg.php?id=" . $contentid
			. "&filename=" . $filename;
	}
	
	static public function getImgUrlByIdAndSize($contentid, $filename, $maxw, $maxh) {
		return str_replace("katapy.com/extapi", "katapy.com/api", KatapyConnect::getKatapyBase()) . "/mmimg.php?id=" . $contentid
			. "&filename=" . urlencode(KatapyConnect::getSizedFilename($filename, $maxw, $maxh))
			. "&maxw=" . $maxw
			. "&maxh=" . $maxh;
	}

	static public function sendEmail($libraryCd, $subject, $message, $fromAddress, $toAddress) {
		$params = "subject=" . urlencode($subject) . "&message=" . urlencode($message) . "&from=" . urlencode($fromAddress) . "&to=" . urlencode($toAddress);
		$response = KatapyConnect::sendCommand("/email" . "/" . $libraryCd, $params);
		return $response;
	}

	static public function getPlaylistByCd($cd, $libraryCd) {
		$response = KatapyConnect::sendCommand("/playlist/cd/" . $cd . "/" . $libraryCd, null);
		return json_decode($response);
	}

	static public function getContentsFromPlaylist($cd, $libraryCd) {
		$response = KatapyConnect::sendCommand("/playlist/contents/" . $cd . "/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getImagesFromPlaylist($cd, $libraryCd) {
		$response = KatapyConnect::sendCommand("/playlist/contents/image/" . $cd . "/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getVideosFromPlaylist($cd, $libraryCd) {
		$response = KatapyConnect::sendCommand("/playlist/contents/video/" . $cd . "/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getContentsFromPlaylistById($id) {
		$response = KatapyConnect::sendCommand("/playlist/id/contents/" . $id, null);
		return json_decode($response);
	}

	static public function getContentsFromPlaylistByIdAndDevice($id, $device) {
		$response = KatapyConnect::sendCommand("/playlist/id/contents/" . $id, "device=" . $device);
		return json_decode($response);
	}

	static public function getContentText($id) {
		$contents = KatapyConnect::sendCommand("/contenttext/" . $id , null);
		if (strpos($contents, '<div class="paragraphContainer"></div>')!==false) {
			return null;
		}
		return $contents;
	}

	static public function getGalleryText($cd, $libraryCd) {
		return KatapyConnect::sendCommand("/gallerytext/" . $cd . "/" . $libraryCd, null);
	}
	

	
}


?>