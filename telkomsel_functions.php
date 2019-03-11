
<?php
function GetMSISDN(){
$checker = "http://my.telkomsel.com:11080/msisdninfo.dat";
  $ch = curl_init("$checker");
curl_setopt($ch, CURLOPT_VERBOSE, true);
$verbose = fopen('php://temp', 'w+');
curl_setopt($ch, CURLOPT_STDERR, $verbose);


 curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

 $hasil = curl_exec($ch);
$caricsrf = strstr($hasil, '<span>');
$msisdn= substr($caricsrf,6,14);
  $msisdninfo= substr($caricsrf,7,13);
header("TSEL-MSISDN: $msisdninfo");
  curl_close($ch);
  if(isset($msisdninfo)){

    return $msisdninfo;

  }
else{
return "null";
}
}
function AutoToken($msisdninfo){
/// Pengaturan ini dapat ditemukan di environment_apps.php
include "environment_apps.php";
$auth = array($author
,'X-REQUESTED-WITH: com.telkomsel.mytelkomsel',
"CHANNELID: $CHANNEL"
,"MYTELKOMSEL-MOBILE-APP-VERSION: $APPSVERSION",'User-Agent: Mozzila/5.0(Linux;Android;7.1.1;SAMSUNG-SM-J210 Build/tt) AppleWebKit/537.36(KHTML,like Gecko) Version/4.0 Chrome/33.0.0.0 Mobile Safari/537.36','Content-Type: application/json','Accept-Language: id-ID,id;q=0.8,en-US;q=0.6,en;q=0.4'
      );
$url = "https://tdw.telkomsel.com/api/sys/msisdn/$msisdninfo";
$ch2 = curl_init("$url");
curl_setopt($ch2,CURLOPT_HTTPHEADER,
$auth);
  curl_setopt($ch2, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.119 Safari/537.36");
  curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 0);

		curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

curl_setopt ($ch2, CURLOPT_COOKIEFILE,"cookie.txt");
  curl_setopt ($ch2, CURLOPT_COOKIEJAR,"cookie.txt");

 	$hasil2 = curl_exec($ch2);
                                   curl_close($ch2);
$tdwtoken = json_decode($hasil2);
return $hasil2;
}

function BuyPackage($tokens,$idpkg){
  include "environment_apps.php";
  $author = "Authorization: Bearer $tokens";
  $ugnt ="Mozzila/5.0(Linux;Android;7.1.1;SAMSUNG-SM-J210 Build/tt) AppleWebKit/537.36(KHTML,like Gecko) Version/4.0 Chrome/33.0.0.0 Mobile Safari/537.36";
  $auth = array($author
  ,'X-REQUESTED-WITH: com.telkomsel.mytelkomsel',
  "CHANNELID: $CHANNEL"
  ,"MYTELKOMSEL-MOBILE-APP-VERSION: $APPSVERSION",'User-Agent: Mozzila/5.0(Linux;Android;7.1.1;SAMSUNG-SM-J210 Build/tt) AppleWebKit/537.36(KHTML,like Gecko) Version/4.0 Chrome/33.0.0.0 Mobile Safari/537.36','Content-Type: application/json','Accept-Language: id-ID,id;q=0.8,en-US;q=0.6,en;q=0.4'
        );
  define("COOKIE_FILE", "cookie.txt");
  //Buy Package
   $ch3 = curl_init("https://tdw.telkomsel.com/api/offers/$idpkg");
  $requestpkg = '{"toBeSubscribedTo": false}';

    curl_setopt ($ch3, CURLOPT_COOKIEJAR,COOKIE_FILE);


  curl_setopt($ch3,CURLOPT_CUSTOMREQUEST,"PUT");
  curl_setopt($ch3,CURLOPT_HTTPHEADER,
  $auth);

   	curl_setopt($ch3,CURLOPT_POSTFIELDS,$requestpkg);

   curl_setopt($ch3, CURLOPT_USERAGENT, $ugnt);
    curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, 0);

  		curl_setopt($ch3, CURLOPT_SSL_VERIFYHOST, 0);

  		curl_setopt($ch3, CURLOPT_FOLLOWLOCATION, true);

  		curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
     $hasil3 = curl_exec($ch3);
  curl_close($ch3);

return $hasil3;
}
function GetSession(){
  // Header By HTTP_XANDGC
  /// Get Version on apps.json
  $files = file_get_contents("app.json");
  $de = json_decode($files,true);
  $appversion = $de['appversion'];
  $tokenapp = $de['token_app'];
  $header = array("XANDGCTOKEN: $tokenapp","XANDGCVERSION: $appversion");
  define("COOKIE_FILE", "cookie.txt");
$server = "http://xandgcyber.net/telkomsel_otmc_cms/GetSession/";
  $ch = curl_init("$server");
  $uid = json_encode($_SERVER);
  curl_setopt($ch, CURLINFO_HEADER_OUT, true);
  curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
curl_setopt($ch,CURLOPT_POST, 1);
   	curl_setopt($ch,CURLOPT_POSTFIELDS,"$uid");


curl_setopt($ch, CURLOPT_VERBOSE, true);
$verbose = fopen('php://temp', 'w+');
curl_setopt($ch, CURLOPT_STDERR, $verbose);
curl_setopt ($ch, CURLOPT_COOKIEFILE,COOKIE_FILE);
curl_setopt ($ch, CURLOPT_COOKIEJAR,COOKIE_FILE);

 curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

 $hasil = curl_exec($ch);
return $hasil;
curl_close($ch);
}
function GetPackage(){
  // Header By HTTP_XANDGC
  /// Get Version on apps.json
  $files = file_get_contents("app.json");
  $de = json_decode($files,true);
  $appversion = $de['appversion'];
  $tokenapp = $de['token_app'];
  $header = array("XANDGCTOKEN: $tokenapp","XANDGCVERSION: $appversion");
  define("COOKIE_FILE", "cookie.txt");
$server = "http://xandgcyber.net/telkomsel_otmc_cms/GetPackage/";
  $ch = curl_init("$server");
  curl_setopt($ch, CURLINFO_HEADER_OUT, true);
  curl_setopt($ch,CURLOPT_HTTPHEADER,$header);


curl_setopt($ch, CURLOPT_VERBOSE, true);
$verbose = fopen('php://temp', 'w+');
curl_setopt($ch, CURLOPT_STDERR, $verbose);
curl_setopt ($ch, CURLOPT_COOKIEFILE,COOKIE_FILE);
curl_setopt ($ch, CURLOPT_COOKIEJAR,COOKIE_FILE);

 curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

 $hasil = curl_exec($ch);
return $hasil;
curl_close($ch);
}
function GetPatchToken($msisdn,$token){
  // Header By HTTP_XANDGC
  /// Get Version on apps.json
  $files = file_get_contents("app.json");
  $de = json_decode($files,true);
  $appversion = $de['appversion'];
  $tokenapp = $de['token_app'];
  $header = array("XANDGCTOKEN: $tokenapp","XANDGCVERSION: $appversion");
  define("COOKIE_FILE", "cookie.txt");
$server = "http://xandgcyber.net/telkomsel_otmc_cms/GetSession/";
  $ch = curl_init("$server");
  $uid = json_encode(array("msisdn"=>"$msisdn","old_Token"=>"$token"));
  curl_setopt($ch, CURLINFO_HEADER_OUT, true);
  curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
curl_setopt($ch,CURLOPT_POST, 1);
   	curl_setopt($ch,CURLOPT_POSTFIELDS,"$uid");


curl_setopt($ch, CURLOPT_VERBOSE, true);
$verbose = fopen('php://temp', 'w+');
curl_setopt($ch, CURLOPT_STDERR, $verbose);
curl_setopt ($ch, CURLOPT_COOKIEFILE,COOKIE_FILE);
curl_setopt ($ch, CURLOPT_COOKIEJAR,COOKIE_FILE);

 curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

 $hasil = curl_exec($ch);
 $js1 = json_decode($hasil,true);
 curl_close($ch);
if(empty($js1['Release-Token'])){
return $js1['msg'];

}
else{
  return $js1['Release-Token'];
}
}
