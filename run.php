<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
// Intro with echo
/// Don't Edit /**
include "environment_apps.php";

 echo "Simple Tools by Aldichazkra\n";
 echo "Version \t:".$appv."\n";
 echo "Date \t\t:".date('Y-m-d,h:i:s')."\n\n";
 echo "Select Your Services \n";
$app = file_get_contents("app.json");
$json = json_decode($app,true);
sleep(2);
for($i=0;$i < count($json['apps']); $i++){
echo $i. "\t" . $json['apps']["$i"]['input_name']."\t\n";
sleep(3);
}
echo "Select Services Number: ";
$input = fgets(STDIN);
$n = $input+2+1;
$c = $n-3;
echo "\n";
//Get Selected
sleep(2);
shell_exec('cls');

$n = $input+2+1;
$c = $n-3;
sleep(3);
if(isset($json['apps'][$c]['services_files'])){
  $open = $json['apps'][$c]['services_files'];
  echo "Starting ".$json['apps'][$c]['input_name']." Services....\n";
include "$open";


}
if(empty($json['apps'][$c]['services_files'])){
echo "Cannot Get The Services\n";

}
 /// Get apps

 ?>
