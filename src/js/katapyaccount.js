// JavaScript Document
if(typeof katapyaccount=="undefined"){
var katapyaccount = {
serverUrl:"",

//*********************************************************************************//
//** APPUSER **********************************************************************//
//*********************************************************************************//

signin: function(email, password) {
	password = Base64.encode(password);
	var url =  this.serverUrl + "/katapyphp/katapyaccount.php?ajax=signin&email=" + encodeURI(email)
			+ "&password=" + encodeURI(password);
	
	
	var response = this.submitRequest(url);
    if (response.length>0 && response.indexOf("http")==0) {
    	///success
		location.href = response;
		//return response;
	} else {
		return response;
	}


},

directupload: function() {
	var url =  this.serverUrl + "/katapyphp/katapyaccount.php?ajax=directupload";
	var response = this.submitRequest(url);
	location.href = response;
},

userForgotPassword: function(email) {
	var url =  this.serverUrl + "/katapyphp/katapyaccount.php?ajax=forgotpassword&email=" + encodeURI(email);
	alert(url);
	var response = this.submitRequest(url);
	alert(response);
	location.href = response;
},

userForgotEmail: function() {
	var url =  this.serverUrl + "/katapyphp/katapyaccount.php?ajax=forgotemail";
	var response = this.submitRequest(url);
	location.href = response;
},

//*********************************************************************************//
//** EMAIL ******************************************************************//
//*********************************************************************************//

postEmail: function(subject, message, from, to) {
	var url =  this.serverUrl + "/katapyphp/katapyconnect.php?ajax=email?subject=" + encodeURI(subject) + "&message=" + encodeURI(message) + "&to=" + encodeURI(to) + "&from=" + encodeURI(from) ;
	return this.submitRequest(url);
},

//*********************************************************************************//
//** GENERIC **********************************************************************//
//*********************************************************************************//


submitRequest: function(theurl) {
	var response =  $.ajax({
		  url: theurl,
		  cache: false,
		  async: false
	}).responseText;
	//if (!$.browser.msie) {
	//	response = response.trim();
	//}
	return response;
},

submitPostRequest: function(theurl, data) {
	var regex = new RegExp('\\+', 'g');
	data = data.replace(regex, "%2B");
	regex = new RegExp('%22', 'g');
	data = data.replace(regex, "&quot;");
	var response =  $.ajax({
		  url: theurl,
		  cache: false,
		  async: false,
		  type: 'POST',
		  contentType: 'application/json',
		  data: data,
		  dataType: 'text',
	}).responseText;
	if (response==undefined) {
		return "bad request";
	}
	//if (!$.browser.msie) {
	//	response = response.trim();
	//}
	return response;
},

setCookie : function(c_name, value){
	var exdays = 365;
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString() + "; path=/");
	document.cookie=c_name + "=" + c_value;
},

getCookie : function(check_name, return_if_not_found) {
	var a_all_cookies = document.cookie.split( ';' );
	var a_temp_cookie = '';
	var cookie_name = '';
	var cookie_value = '';
	for ( i = 0; i < a_all_cookies.length; i++ ) {
		a_temp_cookie = a_all_cookies[i].split( '=' );
		cookie_name = a_temp_cookie[0].replace(/^\s+|\s+$/g, '');
		if ( cookie_name == check_name ) {
			if ( a_temp_cookie.length > 1 )	{
				cookie_value = unescape( a_temp_cookie[1].replace(/^\s+|\s+$/g, '') );
			}
			return cookie_value;
		}
		a_temp_cookie = null;
		cookie_name = '';
	}
	return return_if_not_found;
}

};}