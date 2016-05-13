<?php

/* Katapy Live Streaming Functions */
class KatapyLive {
	
	static public function getChannelByCd($cd, $libraryCd) {
		$response = KatapyConnect::sendCommand("/channel/cd/" . $cd . "/" . $libraryCd, null);
		return json_decode($response);
	}

	static public function getChannel($id) {
		$response = KatapyConnect::sendCommand("/channel/" . $id, null);
		return json_decode($response);
	}
	
}

?>