<?php

/* Katapy Member Functions */
class KatapyMember {
	
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
	
	static public function searchMembers($groupId, $searchText) {
		$params = "q=" . urlencode($searchText);
		$response = KatapyConnect::sendCommand("/membersearch/" . $groupId, $params);
		return json_decode($response);
	}
	
	static public function searchMembersByType($groupId, $typeId, $searchText) {
		$params = "q=" . urlencode($searchText);
		$response = KatapyConnect::sendCommand("/membersearchbytype/" . $groupId . "/" . $typeId, $params);
		return json_decode($response);
	}
	
	static public function memberGalleriesByName($groupId, $name) {
		$response = KatapyConnect::sendCommand("/membergalleries/nm/" . $groupId . "/" . $name, null);
		return json_decode($response);
	}
	
	static public function memberGalleriesByCd($groupId, $cd) {
		$response = KatapyConnect::sendCommand("/membergalleries/cd/" . $groupId . "/" . $cd, null);
		return json_decode($response);
	}
	
	static public function memberGalleriesByType($groupId, $type) {
		$response = KatapyConnect::sendCommand("/membergalleries/type/" . $groupId . "/" . $type, null);
		return json_decode($response);
	}
	
	static public function getUpcomingEventsByGroup($cd, $start, $max) {  //e.g. 05/23/2013 00:00:00    10
		$params = "max=" . $max . "&start=" . urlencode($start);
		$response = KatapyConnect::sendCommand("/events/group/upcoming/" . $cd, $params);
		return json_decode($response);
	}

	static public function getUpcomingEventsByLibrary($cd, $start, $max) {  //e.g. 05/23/2013 00:00:00    10
		$params = "max=" . $max . "&start=" . urlencode($start);
		$response = KatapyConnect::sendCommand("/events/upcoming/" . $cd, $params);
		return json_decode($response);
	}

	static public function getEvent($id) { 
		$response = KatapyConnect::sendCommand("/event/" . $id, null);
		return json_decode($response);
	}
	
	static public function getEventText($id) {
		$contents = KatapyConnect::sendCommand("/eventtext/" . $id , null);
		//if (strpos($contents, '<div class="paragraphContainer"></div>')!==false) {
		//	return null;
		//}
		return $contents;
	}
	
	static public function getScheduleByChannelAndDate($cd, $date) {  //e.g. 05/23/2013
		$params = "date=" . urlencode($date);
		$response = KatapyConnect::sendCommand("/events/group/date/" . $cd, $params);
		return json_decode($response);
	}

	static public function signinMember($cd, $email, $password) {
		$params = "email=" . urlencode($email) . "&password=" . urlencode($password);
		$response = KatapyConnect::sendCommand("/membersignin/group/" . $cd, $params);
		return json_decode($response);
	}
	
	static public function resetMemberPassword($cd, $email) {
		$params = "email=" . urlencode($email);
		$response = KatapyConnect::sendCommand("/memberpasswordreset/group/" . $cd, $params);
		return $response;
	}
	
	static public function changeMemberPassword($id, $password, $newpassword, $notify) {
		$params = "notify=" . $notify . "&password=" . urlencode($password)  . "&newpassword=" . urlencode($newpassword);
		$response = KatapyConnect::sendCommand("/memberpasswordchange/group/" . $id, $params);
		return $response;
	}
	
	static public function getMember($id) {
		$response = KatapyConnect::sendCommand("/member/" . $id, null);
		return json_decode($response);
	}
	
	static public function getMemberServices($id) {
		$response = KatapyConnect::sendCommand("/memberservices/" . $id, null);
		return json_decode($response);
	}
	
	static public function getMemberServicesByGroup($id) {
		$response = KatapyConnect::sendCommand("/memberservices/group/" . $id, null);
		return json_decode($response);
	}
	
	static public function getMemberServiceByGroupAndCd($id, $cd) {
		$response = KatapyConnect::sendCommand("/memberservices/groupandcd/" . $id . "/" . $cd, null);
		return json_decode($response);
	}
	
	static public function getMemberSubscriptions($id) {
		$response = KatapyConnect::sendCommand("/membersubscription/" . $id, null);
		return json_decode($response);
	}
	
	static public function postMember($data) {
		$data = json_decode($data);
		$response = KatapyConnect::sendMmPostCommand("/post/member", $data);
		return $response;
	}
	
	static public function postSubscription($data) {
		$data = json_decode($data);
		$response = KatapyConnect::sendMmPostCommand("/post/subscription", $data);
		return $response;
	}
	
	static public function deleteSubscription($id, $su) {
		$params = "su=" . $su;
		$response = KatapyConnect::sendCommand("/delete/subscription/" . $id, $params);
		return $response;
	}
	
	static public function getMemberRatings($id) {
		$response = KatapyConnect::sendCommand("/memberrating/" . $id, null);
		return json_decode($response);
	}
	
	static public function postRating($data) {
		$data = json_decode($data);
		$response = KatapyConnect::sendMmPostCommand("/post/rating", $data);
		return $response;
	}
	
	static public function searchGroupusers($cd, $q) {
		$params = "q=" . $q . "&max=100";
		$response = KatapyConnect::sendCommand("/member/search/" . $cd, $params);
		return json_decode($response);
	}
	
	static public function getGroupusersStartingWith($cd, $q) {
		$params = "q=" . $q . "&max=100";
		$response = KatapyConnect::sendCommand("/member/startswith/" . $cd, $params);
		return json_decode($response);
	}
	
}

?>