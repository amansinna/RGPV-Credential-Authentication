<?php
require_once("htmlDomParser.php");
$rgpv = file_get_html('https://www.rgpv.ac.in/');


//Fetching ViewState
foreach($rgpv->find('[id=__VIEWSTATE]') as $divs)
$viewState = $divs->value;
$viewState = urlencode($viewState);

//Credentials
$username="************";
$password="****"; 


//Curl Header
$url="https://www.rgpv.ac.in/Index.aspx"; 
$cookie="ASP.NET_SessionId=q0it2t45ti0acj45nwifwp45; __utma=165311676.2106723673.1435573317.1435573317.1435573317.1; __utmb=165311676.2.10.1435573317; __utmc=165311676; __utmz=165311676.1435573317.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); __utmt=1"; 
$postdata = 'ScriptManager1=UserLogin1$UpdPnlLogin|UserLogin1$btnLogin&__LASTFOCUS=&__EVENTTARGET=&__EVENTARGUMENT=&__VIEWSTATE='.$viewState.'&UserLogin1$txtUserName='.$username.'&UserLogin1$txtPassword='.$password.'&UserLogin1$btnLogin.x=26&UserLogin1$btnLogin.y=11';
$ch = curl_init(); 
curl_setopt ($ch, CURLOPT_URL, $url); 
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0"); 
//curl_setopt ($ch, CURLOPT_HTTPHEADER, $myheader); 
curl_setopt ($ch, CURLOPT_TIMEOUT, 60); 
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0); 
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie); 
curl_setopt ($ch, CURLOPT_REFERER, "https://www.rgpv.ac.in/Index.aspx"); 

curl_setopt ($ch, CURLOPT_POSTFIELDS, $postdata); 
curl_setopt ($ch, CURLOPT_POST, 1); 
$result = curl_exec ($ch); 
if (strpos($result, 'StudentHome.aspx') !== false)
    echo 'true';
else
	if(strpos($result, 'aspxerrorpath') !== false)
		echo 'fatalError';
else
	echo 'false';
//echo $result;  
curl_close($ch);

?>