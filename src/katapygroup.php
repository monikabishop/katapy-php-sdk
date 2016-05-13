<?php

/* Katapy Group Functions */
class KatapyGroup {
	
	static public function getGroup($cd) {
		$response = KatapyConnect::sendCommand("/group/" . $cd, null);
		return json_decode($response);
	}
	
	static public function getGroupsByOwner($libraryCd) {
		$response = KatapyConnect::sendCommand("/groups/" . $libraryCd, null);
		return json_decode($response);
	}
	
	static public function getGroupLocations($cd) {
		$response = KatapyConnect::sendCommand("/grouplocations/" . $cd, null);
		return json_decode($response);
	}
	
	static public function searchPublishers($groupId, $searchText, $max) {
		$params = "q=" . urlencode($searchText) . "&max=" . $max;
		$response = KatapyConnect::sendCommand("/membersearch/" . $groupId, $params);
		return json_decode($response);
	}

	static public function getPublishers($groupId, $max) {
		$params = "max=" . $max;
		$response = KatapyConnect::sendCommand("/membersbygroup/" . $groupId, $params);
		return json_decode($response);
	}

	static public function getPublisherCategories($groupId) {
		$response = KatapyConnect::sendCommand("/membercategoriesbygroup/" . $groupId, null);
		return json_decode($response);
	}

	static public function getPublishersByCategory($groupId, $categoryNm, $max) {
		$params = "categoryNm=" . urlencode($categoryNm) . "&max=" . $max;
		$response = KatapyConnect::sendCommand("/membersbygroupandcategory/" . $groupId, $params);
		return json_decode($response);
	}

	static public function searchPublishersByCd($groupCd, $searchText, $max) {
		$params = "q=" . urlencode($searchText) . "&max=" . $max;
		$response = KatapyConnect::sendCommand("/membersearch/cd/" . $groupCd, $params);
		return json_decode($response);
	}

	static public function getPublishersByCd($groupCd, $max) {
		$params = "max=" . $max;
		$response = KatapyConnect::sendCommand("/membersbygroup/cd/" . $groupCd, $params);
		return json_decode($response);
	}

	static public function getPublisherCategoriesByCd($groupCd) {
		$response = KatapyConnect::sendCommand("/membercategoriesbygroup/cd/" . $groupCd, null);
		return json_decode($response);
	}

	static public function getPublisherCategoriesByMemberCd($groupCd, $memberCd) {
		$response = KatapyConnect::sendCommand("/membercategoriesbygroupandmember/" . $groupCd . "/" . $memberCd, null);
		return json_decode($response);
	}

	static public function getPublishersByCategoryAndCd($groupCd, $categoryNm, $max) {
		$params = "categoryNm=" . urlencode($categoryNm) . "&max=" . $max;
		$response = KatapyConnect::sendCommand("/membersbygroupandcategory/cd/" . $groupCd, $params);
		return json_decode($response);
	}

	static public function searchContentsByGroup($groupCd, $searchText, $max) {
		$params = "q=" . urlencode($searchText) . "&max=" . $max;
		$response = KatapyConnect::sendCommand("/contentsearch/group/recent/" . $groupCd, $params);
		return json_decode($response);
	}

	static public function searchVideosByGroup($groupCd, $searchText, $max) {
		$params = "q=" . urlencode($searchText) . "&max=" . $max;
		$response = KatapyConnect::sendCommand("/videosearch/group/recent/" . $groupCd, $params);
		return json_decode($response);
	}

	static public function searchPostsByGroup($groupCd, $searchText, $max) {
		$params = "q=" . urlencode($searchText) . "&max=" . $max;
		$response = KatapyConnect::sendCommand("/postsearch/group/recent/" . $groupCd, $params);
		return json_decode($response);
	}

	static public function getRecentContentsByGroup($groupCd, $max) {
		$params = "max=" . $max;
		$response = KatapyConnect::sendCommand("/contents/group/recent/" . $groupCd, $params);
		return json_decode($response);
	}

	static public function getPopularContentsByGroup($groupCd, $max) {
		$params = "max=" . $max;
		$response = KatapyConnect::sendCommand("/contents/group/popular/" . $groupCd, $params);
		return json_decode($response);
	}

	static public function getRecentVideosByGroup($groupCd, $max) {
		$params = "max=" . $max;
		$response = KatapyConnect::sendCommand("/contents/group/video/recent/" . $groupCd, $params);
		return json_decode($response);
	}

	static public function getPopularVideosByGroup($groupCd, $max) {
		$params = "max=" . $max;
		$response = KatapyConnect::sendCommand("/contents/group/video/popular/" . $groupCd, $params);
		return json_decode($response);
	}

	static public function searchPublishersByType($groupId, $typeId, $searchText) {
		$params = "q=" . urlencode($searchText);
		$response = KatapyConnect::sendCommand("/membersearchbytype/" . $groupId . "/" . $typeId, $params);
		return json_decode($response);
	}
	
	static public function publisherGalleriesByName($groupId, $name) {
		$response = KatapyConnect::sendCommand("/membergalleries/nm/" . $groupId . "/" . $name, null);
		return json_decode($response);
	}
	
	static public function publisherGalleriesByCd($groupId, $cd) {
		$response = KatapyConnect::sendCommand("/membergalleries/cd/" . $groupId . "/" . $cd, null);
		return json_decode($response);
	}
	
	static public function publisherGalleriesByType($groupId, $type) {
		$response = KatapyConnect::sendCommand("/membergalleries/type/" . $groupId . "/" . $type, null);
		return json_decode($response);
	}
	

}

?>