<?php

/* Katapy Common Date Functions */
class KatapyDate {
	
	static public function getTimezone($offsetHours) {
		$offsetInSecs = $offsetHours * 3600;
		$timezoneName = timezone_name_from_abbr("", $offsetInSecs, 0);
		return new DateTimeZone($timezoneName);
	}
	
	static public function toTime($input) { //use for durations
		$then = new DateTime( $input );
		return date_format($then, 'H:i:s');
	}
	
	static public function toSeconds($input) { //use for durations
		$str_time = self::toTime($input); //"23:12:95"
		$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
		sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
		return $hours * 3600 + $minutes * 60 + $seconds;
	}
	
	static public function formatDate($input) {
		$then = new DateTime( $input );
		return date_format($then, 'l d F Y h:i');
	}
	
	static public function getElapsedTime($input) {

		$timeT = new DateTime( $input );
		$now = new DateTime( 'now' );
	
		//DateInterval
		$diff = date_diff($timeT,$now);
	
		if (floor($diff->y)>0) {
			//show years and months
			$numberOfUnits = floor($diff->y);
			$elapsed = $numberOfUnits . " yr".(($numberOfUnits>1)?'s':'');
			if (floor($diff->m)>0) {
				$numberOfUnits = floor($diff->m);
				 return $elapsed . " " . $numberOfUnits . " mth".(($numberOfUnits>1)?'s':'');
			}
			return $elapsed;
		} else if (floor($diff->m)>0) {
			//show months and days
			$numberOfUnits = floor($diff->m);
			$elapsed = $numberOfUnits . " mth".(($numberOfUnits>1)?'s':'');
			if (floor($diff->d)>0) {
				$numberOfUnits = floor($diff->d);
				return $elapsed . " " . $numberOfUnits . " day".(($numberOfUnits>1)?'s':'');
			}
			return $elapsed;
		} else if (floor($diff->d)>0) {
			//show months and days
			$numberOfUnits = floor($diff->d);
			$elapsed = $numberOfUnits . " day".(($numberOfUnits>1)?'s':'');
			if (floor($diff->h)>0) {
				$numberOfUnits = floor($diff->h);
				return $elapsed . " " . $numberOfUnits . " hr".(($numberOfUnits>1)?'s':'');
			}
			return $elapsed;
		} else if (floor($diff->h)>0) {
			//show months and days
			$numberOfUnits = floor($diff->h);
			$elapsed = $numberOfUnits . " hr".(($numberOfUnits>1)?'s':'');
			if (floor($diff->i)>0) {
				$numberOfUnits = floor($diff->i);
				return $elapsed . " " . $numberOfUnits . " min".(($numberOfUnits>1)?'s':'');
			}
			return $elapsed;
		} else if (floor($diff->i)>0) {
			//show months and days
			$numberOfUnits = floor($diff->i);
			$elapsed = $numberOfUnits . " min".(($numberOfUnits>1)?'s':'');
			if (floor($diff->s)>0) {
				$numberOfUnits = floor($diff->s);
				return $elapsed . " " . $numberOfUnits . " sec".(($numberOfUnits>1)?'s':'');
			}
			return $elapsed;
		} else {
			$numberOfUnits = floor($diff->s);
			if ($numberOfUnits<0) {
				$numberOfUnits = 0;
			}
			return $elapsed . " " . $numberOfUnits . " sec".(($numberOfUnits>1)?'s':'');
		}
	
		return "";
	}

	
}

?>