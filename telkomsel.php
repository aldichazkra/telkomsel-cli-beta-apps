<?php
session_start();

include "telkomsel_functions.php";
sleep(1);
echo "===============================================\n";
sleep(2);
echo "Welcome To Telkomsel Mini Services\n";
echo "Security Dimulai\n";
//// Security By HTTP_XANDGC
$set = GetSession();
$hg = json_decode($set,true);
echo $hg['msg'];
echo "\nKeamanan Selesai\n";
echo "Ambil Nomor Secara Otomatis\n";
$msisdn = GetMSISDN();
echo "MSISDN \t\t\t\t : ".$msisdn."\n";
sleep(4);
Echo "\n\n Trying Get Your Token \n";
$token = json_decode(AutoToken(GetMsisdn()),true);
$tokens = $token['idToken'];
echo "Your Token : $tokens \n";
/// Getting Package
sleep(2);
Echo "=================================================================================================\n";
Echo "|                                         PEMBELIAN PAKET                                        |\n";
Echo "=================================================================================================\n";
$package = GetPackage();
$decode = json_decode($package,true);
sleep(2);
for($i=0;$i < count($decode); $i++){
echo $i.")\n"."Nama Paket : \t".$decode[$i][1]." \n"."Kode Paket : \t".$decode["$i"][0]."\n"."Harga      : \t".$decode["$i"][2]."\n"."Info Paket : \t".$decode["$i"][3]."\n\n";
sleep(3);
}
Echo "=================================================================================================\n";
Echo "Pilih Paket yang Anda inginkan:";
$package = fgets(STDIN);
$r = $package + 8;
$s = $r-8;
if(isset($decode[$s][0])){
echo "\n";
Echo "Pembelian Paket Untuk ".$decode[$s][1]." Seharga ".$decode[$s][2]. "\n";

echo "\nMemulai PATCHING NEW TOKEN untuk Pembelian\n";
$NEWTOKEN = GetPatchToken($msisdn,$tokens);
echo "Result $NEWTOKEN";

echo "\nMemulai untuk Pembelian ".$decode[$s][1]." (".$decode[$s][0].") \n";
echo BuyPackage($NEWTOKEN,$decode[$s][0]);
}else{
echo "Package ID Not Found";
}
/// Pembelian Paket Dimulai
