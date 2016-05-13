<?php

/* Katapy ADMIN Connection Setup */
$katapyAdminBase = "http://mychannel.katapy.com"; //do not change!
//$katapyAdminBase = "http://localhost/KTMYCHANNEL"; //do not change!

KatapyAdminConnect::setup($katapyAdminBase, $apiKey);

class KatapyAdminConnect {
	
	private static $katapyBase = null;
	private static $apiKey = null;
	private static $isTestMode = false;
	


	static public function setup($katapyBase, $apiKey) {
		self::$katapyBase = $katapyBase;
		self::$apiKey = $apiKey;
	}
	
	static public function setTestMode($isTestMode) {
		self::$isTestMode = $isTestMode;
	}

	static public function getUrl($cmd, $query) {
		$url = self::$katapyBase . $cmd;
		if ($query==null) {
			return $url . "?apikey=" . self::$apiKey;
		}
		return $url . "?" . $query . "&apikey=" . self::$apiKey;
	}

	static public function sendCommand($cmd, $query) {
		//if (self::$isTestMode) {
		//	echo "sendCommand<br/>";
		//}
		$url = self::getUrl($cmd, $query);
		
		if (self::$isTestMode) {
			echo $url . "<br/>";
		}
		
		$response = file_get_contents($url);
		
		return $response;
	}

	static public function sendPostCommand($cmd, $data) {
		$url = self::getUrl($cmd, null);
		$url = substr($url, 7, strlen($url)-7);
		$host = substr($url, 0, strpos($url, "/"));
		$pathlength = strlen($url)-strlen($host);
		$path = substr($url, strpos($url, "/"), $pathlength);
		return self::httpRequest($host, 80, "POST", $path, $data);
	}
		
	static public function validCookie($key) {
		if (isset($_COOKIE[$key])==false) {
			return false;
		}
		if ($_COOKIE[$key]=="") {
			return false;
		}
		return true;
	}
	
	static public function getCookie($key) {
		return base64_decode($_COOKIE[$key]);
	}
	
	static public function getSizedFilename($filename, $width, $height) {
		if ($filename==null) {
			return "null";
		}
		if (strrpos($filename, ".")===false) {
			return $filename;
		}
		$prefix = substr($filename, 0, strrpos($filename, "."));
		$ext = substr($filename, strrpos($filename, "."));
		return $prefix . "." . $width . "x" . $height . $ext;
	}
	
	static public function getPageName() {
		return substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"],"/"), strlen($_SERVER["SCRIPT_NAME"]));
	}
	
	static public function getKatapyBase() {
		return self::$katapyBase;
	}
	
	static public function httpRequest($host, $port, $method, $path, $params) {
	  // Params are a map from names to values
	  $paramStr = "";
	  foreach ($params as $name => $val) {
		$paramStr .= $name . "=";
		$paramStr .= urlencode($val);
		$paramStr .= "&";
	  }
	
	  // Assign defaults to $method and $port, if needed
	  if (empty($method)) {
		$method = 'GET';
	  }
	  $method = strtoupper($method);
	  if (empty($port)) {
		$port = 80; // Default HTTP port
	  }
	
	  // Create the connection
	  $sock = fsockopen($host, $port);
	  if ($method == "GET") {
		$path .= "?" . $paramStr;
	  }
	  fputs($sock, "$method $path HTTP/1.1\r\n");
	  fputs($sock, "Host: $host\r\n");
	  fputs($sock, "Content-type: " .
				   "application/x-www-form-urlencoded\r\n");
	  if ($method == "POST") {
		fputs($sock, "Content-length: " . 
					 strlen($paramStr) . "\r\n");
	  }
	  fputs($sock, "Connection: close\r\n\r\n");
	  if ($method == "POST") {
		fputs($sock, $paramStr);
	  }
	
	  // Buffer the result
	  $result = "";
	  while (!feof($sock)) {
		$result .= fgets($sock,1024);
	  }
	
	  fclose($sock);
	  return $result;
	}
	
	static public function displayError($path) {
		//no results, redirect to error page
		Header( "HTTP/1.1 301 Redirect" );
		Header( "Location: " . $path);
		exit("Unable to process request");
	}

	static public function redirect($path) {
		//no results, redirect to error page
		Header( "HTTP/1.1 301 Redirect" );
		Header( "Location: " . self::$katapyBase . $path);
		exit();
	}
	
	static public function sendEmail($libraryCd, $subject, $message, $fromAddress, $toAddress) {
		$params = "subject=" . urlencode($subject) . "&message=" . urlencode($message) . "&from=" . urlencode($fromAddress) . "&to=" . urlencode($toAddress);
		$response = self::sendCommand("/email" . "/" . $libraryCd, $params);
		return $response;
	}

}


?>