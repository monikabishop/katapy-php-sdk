<?php


/* Katapy Account Functions */
class KatapyAccount {

	static public function signinVerify($email, $password, $mcnkey) {
		$params = "verify=true&email=" . urlencode($email) . "&password=" . urlencode($password);
		//echo $params;
		//$response = KatapyConnect::test();
		//$response = KatapyConnect::sendCommand("/galleries/emamaccount", null);
		$response = KatapyAdminConnect::sendCommand("/signonAuto.php", $params);
		$decoded = unserialize(base64_decode($response));

		if ($decoded=="false" || $decoded==false) {
			//login failed
			KatapyConnect::setCookie("ktusr", "");
			return $response;
		} else {
			//login success
			KatapyConnect::setCookie("ktusr", $response);
			$params = "email=" . urlencode($email) . "&password=" . urlencode($password) . "&jsessionid=" . urlencode($decoded->sessionid). "&mcn=" . $mcnkey;
			return KatapyAdminConnect::getUrl("/signonAuto.php", $params);
			//exit();
		}
		
	}

	static public function signinVerifyTest($email, $password, $mcnkey) {
		$params = "verify=true&email=" . urlencode($email) . "&password=" . urlencode($password);
		echo $params . "<br/>";
		//$response = KatapyConnect::test();
		//$response = KatapyConnect::sendCommand("/galleries/emamaccount", null);
		$response = KatapyAdminConnect::sendCommand("/signonAuto.php", $params);
		echo $response . "<br/>";
		$decoded = unserialize(base64_decode($response));

		if ($decoded=="false" || $decoded==false) {
			//login failed
			KatapyConnect::setCookie("ktusr", "");
			return $response;
		} else {
			//login success

			KatapyConnect::setCookie("ktusr", $response);
			$params = "email=" . urlencode($email) . "&password=" . urlencode($password) . "&jsessionid=" . urlencode($decoded->sessionid). "&mcn=" . $mcnkey;
			return KatapyAdminConnect::getUrl("/signonAuto.php", $params);
			//exit();
		}
		
	}

	static public function getRedirectUploadUrl($jsessionid, $mcnkey) {
		return KatapyAdminConnect::getUrl("/dashboard.php", "jsessionid=" . $jsessionid . "&mcn=" . $mcnkey);
	}
	
	/*
	static public function getOrCreateGalleryByCd($voomtagCd, $voomtagFolderCd, $libraryCd) {
		//load gallery
		$response = KatapyConnect::sendCommand("/gallery/cd/" . $voomtagCd . "/" . $libraryCd, null);
		$gallery = json_decode($response);
		if ($gallery!=null) {
			return $gallery;
		}

		$folder = KatapyVod::getGalleryByCd($voomtagFolderCd, $libraryCd);
		$gallery = array();
		$gallery["id"] = 0;
		$gallery["cd"] = $voomtagCd;
		$gallery["nm"] = $voomtagCd;
		$gallery["parentId"] = $folder->id;
		$gallery["mediactrCd"] = $libraryCd;
		$gallery["typeCd"] = "VIDEO";

		$response = self::postGallery(json_encode($gallery));
		$gallery["id"] = $response;
		return json_decode(json_encode($gallery));
	}

	static public function triggerImport($libraryCd, $galleryId, $contentId, $fileSize, $fileName) {
		$params = "su=" . $GLOBALS["voomServerId"] . "&cat=" . $galleryId . "&content=" . $contentId . "&size=" . $fileSize . "&file=" . urlencode($fileName);
		$response = KatapyConnect::sendCommand("/fspimport/" . $libraryCd, $params);
		return $response;
	}

	static public function stripResponse($response) {
		return self::getLastLine($response);
	}

	static public function getLastLine($string, $n = 1) {
	    $lines = explode("\n", $string);
	    $lines = array_slice($lines, -$n);
	    return implode("\n", $lines);
	}*/
	
}



if(isset($_REQUEST["ajax"])) { 
	include_once 'katapysetup.php';
	if (strcasecmp($_REQUEST["ajax"], "signin")==0) {
		$response = KatapyAccount::signinVerify($_REQUEST["email"], $_REQUEST["password"], $mcnkey);
		echo $response;
	} else if (strcasecmp($_REQUEST["ajax"], "signintest")==0) {
		echo "test<br/>";
		$response = KatapyAccount::signinVerifyTest($_REQUEST["email"], $_REQUEST["password"], $mcnkey);
		echo $response;
	} else if (strcasecmp($_REQUEST["ajax"], "forgotpassword")==0) {
		$params = "u=" . base64_encode($_REQUEST["email"]);
		$url = $katapyAdminBase . "/index.php?fp=true&" . $params;
		echo $url;
		//header("Location: " . $katapyAdminUrl . "/index.php?fp=true&" . $params);
		//exit;
	} else if (strcasecmp($_REQUEST["ajax"], "forgotemail")==0) {
		$url = $katapyAdminBase . "/index.php?fe=true";
		echo $url;
		//header("Location: " . $katapyAdminUrl . "/index.php?fe=true");
		//exit;
	} else if (strcasecmp($_REQUEST["ajax"], "directupload")==0) {
		$url = $katapyAdminBase . "/dashboard.php";
		echo $url;
		//header("Location: " . $katapyAdminUrl . "/index.php?fe=true");
		//exit;
	}
}



?>