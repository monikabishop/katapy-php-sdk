<?php

/* Katapy Live Streaming & Broadcast Channel Functions */
class KatapyChannel {
	
	static public function getChannelByCd($cd, $libraryCd) {
		$response = KatapyConnect::sendCommand("/channel/cd/" . $cd . "/" . $libraryCd, null);
		return json_decode($response);
	}

	static public function getChannel($id) {
		$response = KatapyConnect::sendCommand("/channel/" . $id, null);
		return json_decode($response);
	}

	static public function getScheduleByChannelAndDate($cd, $libraryCd, $date) {  //e.g. 05/23/2013
		$params = "date=" . urlencode($date);
		$response = KatapyConnect::sendCommand("/schedule/channel/date/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}
	
	static public function getScheduleByChannelAndContent($cd, $libraryCd, $contentId) {
		$params = "content=" . $contentId;
		$response = KatapyConnect::sendCommand("/schedule/channelandcontent/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}
	
	static public function getScheduleByChannelAndDateAndTime($cd, $libraryCd, $date, $start, $end) {  //e.g. 05/23/2013    00:00:00  05:00:00
		$params = "date=" . urlencode($date) . "&start=" . urlencode($start) . "&end=" . urlencode($end);
		$response = KatapyConnect::sendCommand("/schedule/channel/date/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}
	
	static public function getProgramByChannelAndDate($cd, $libraryCd, $date) {  //e.g. 05/23/2013
		$params = "date=" . urlencode($date) . "&mode=program";
		$response = KatapyConnect::sendCommand("/schedule/channel/date/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}
	
	static public function getProgramByChannelAndDateAndTime($cd, $libraryCd, $date, $start, $end) {  //e.g. 05/23/2013    00:00:00  05:00:00
		$params = "date=" . urlencode($date) . "&start=" . urlencode($start) . "&end=" . urlencode($end) . "&mode=program";
		$response = KatapyConnect::sendCommand("/schedule/channel/date/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}
	
	static public function getUpcomingScheduleByChannel($cd, $libraryCd, $start, $max) {  //e.g. 05/23/2013 00:00:00    10
		$params = "max=" . $max . "&start=" . urlencode($start);
		$response = KatapyConnect::sendCommand("/schedule/channel/upcoming/" . $cd . "/" . $libraryCd, $params);
		return json_decode($response);
	}
	
	static public function getCurrentlyPlaying($scheduleitems) {
		if (sizeof($scheduleitems)==0) {
			return null;
		}
		$now = new DateTime("now");
		foreach ($scheduleitems as $rowcount => $scheduleitem){
			if (new DateTime($scheduleitem->startT)<=$now && new DateTime($scheduleitem->endT)>$now) {
				return $scheduleitem;
			}
		}
		return null;
	}
	
	static public function getSeekSeconds($nowplaying) {
		if ($nowplaying==null) {
			return 0;
		}
		$now = new DateTime("now");
		$interval = date_diff($now, new DateTime($nowplaying->effT));
		return $interval->h*3600 + $interval->i*60 + $interval->s;
	}
	
}

?>