<?php

/* Katapy Connection Setup */
$katapyBase = "http://extapi.katapy.com/extapi"; //do not change!
KatapyConnect::setup($katapyBase, $apiKey);
/* Katapy Caching */
/* Note: you can init your cache every night by simply running a crawler script against your website, it will preload all the MMTV Content. */
/* Content will remain static until the cache refreshes.  Ask us about our new auto-refresh feature. */
$katapyCache_enabled = false; 
$katapyCache_expirysecs = 60 * 2; //2 mins

// Require Library
//require_once("phpfastcache.php");
//KatapyConnect::initCaching($katapyCache_enabled, $katapyCache_expirysecs);

class KatapyConnect {
	
	private static $cache = null;
	private static $cache_durationsecs = 120;
	
	private static $katapyBase = null;
	private static $apiKey = null;
	private static $isTestMode = false;
	private static $isUpdateCacheMode = false;
	private static $isPreloaderMode = false;
	private static $cacheExcludeList = array("/membersearch/", "/membersearchbytype/", "/membersignin/group/", "/memberpasswordreset/group/", "/memberpasswordchange/group/", "/member/", "/memberservices/", "/membersubscription/", "/delete/subscription/", "/memberrating/", "/member/search/", "/member/startswith/", "/videosearch/alphabet/", "/videosearch/recent/", "/videosearch/popular/", "/contentsearch/alphabet/", "/contentsearch/recent/", "/contentsearch/popular/", "/contentusage/");
	
	static public function setup($katapyBase, $apiKey) {
		self::$katapyBase = $katapyBase;
		self::$apiKey = $apiKey;
	}
	
	static public function setTestMode($isTestMode) {
		self::$isTestMode = $isTestMode;
	}
	
	static public function setPreloaderMode($isPreloaderMode) {
		self::$isPreloaderMode = $isPreloaderMode;
	}
	
	static public function setUpdateCacheMode($isUpdateCacheMode) {
		self::$isUpdateCacheMode = $isUpdateCacheMode;
	}
	
	static public function initCaching($cache_enabled, $cache_durationsecs) {
		if ($cache_enabled) {
			self::$cache = new phpFastCache();
			self::$cache_durationsecs = $cache_durationsecs;
		}
	}
	
	static public function getUrl($cmd, $query) {
		$url = self::$katapyBase . $cmd;
		if ($cmd=="/sessionid") {
			return $url . "?proxyfor=" . urlencode(base64_encode($_SERVER['REMOTE_ADDR'])) . "&apikey=" . self::$apiKey;
		}
		if ($query==null) {
			return $url . "?apikey=" . self::$apiKey;
		}
		return $url . "?" . $query . "&apikey=" . self::$apiKey;
	}
	
	static public function initSession() {
		return self::sendCommand("/sessionid", null);
	}

	static public function sendCommand($cmd, $query) {
		$url = self::getUrl($cmd, $query);
		
		if ((self::$cache!=null) && (self::$isTestMode==false) && (self::$isUpdateCacheMode==false) && (self::isExcludedFromCache($url)==false)) {
			$response = self::$cache->get($url);
			if (empty($response)==false) {
				return $response;
			}
		} else {
			if (self::$isTestMode) {
				echo $url . "<br/>";
			}
		}
		$response = file_get_contents($url);
		
		if (self::$cache!=null) {
			self::$cache->set($url, $response, self::$cache_durationsecs);
		}
		if (self::$isUpdateCacheMode) {
			echo "replaced Katapy site cache for " . $url . "<br/>";
		} else if (self::$isPreloaderMode) {
			echo "loaded Katapy site cache for " . $url . "<br/>";
		}
		return $response;
	}

	static public function clearCache() {
		if (self::$cache!=null) {
			self::$cache->clean();
		}
	}
	
	static public function sendPostCommand($cmd, $data) {
		$url = self::getUrl($cmd, null);
		$url = substr($url, 7, strlen($url)-7);
		$host = substr($url, 0, strpos($url, "/"));
		$pathlength = strlen($url)-strlen($host);
		$path = substr($url, strpos($url, "/"), $pathlength);
		return self::httpRequest($host, 80, "POST", $path, $data);
	}

	static private function isExcludedFromCache($key) {
		//echo "testExcluded " . $key;
		foreach (self::$cacheExcludeList as $exclude) {
			if (strpos($key, $exclude)!==false) {
				return true;
			}
		}
		return false;
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

	static public function setCookie($key, $data) {
		$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
		setcookie($key, $data, time()+3600, '/', $domain, false); //expire in an hour
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
	
	static public function sendEmail($libraryCd, $subject, $message, $fromAddress, $toAddress) {
		$params = "subject=" . urlencode($subject) . "&message=" . urlencode($message) . "&from=" . urlencode($fromAddress) . "&to=" . urlencode($toAddress);
		$response = self::sendCommand("/email" . "/" . $libraryCd, $params);
		return $response;
	}


}


if (isset($_REQUEST["mmupdtlib"])) { KatapyConnect::clearCache(); }
if (isset($_REQUEST["mmupdtinvlib"])) { KatapyConnect::clearCache(); }
if (isset($_REQUEST["mmupdtchannel"]) && isset($_REQUEST["mmupdtchannellib"])) { KatapyConnect::clearCache(); }
if (isset($_REQUEST["mmpreloadlib"])) { KatapyConnect::clearCache(); }

if(isset($_REQUEST["ajax"])) { 
	if (strcasecmp($_REQUEST["ajax"], "email")==0) {
		return KatapyAccount::sendEmail($library, $_REQUEST["subject"], $_REQUEST["message"], $_REQUEST["from"], $_REQUEST["to"]);
	}
}

?>