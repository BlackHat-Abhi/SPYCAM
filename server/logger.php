<?php
date_default_timezone_set("Asia/Kolkata");

function getUserIP() {
    $ip = $_SERVER['REMOTE_ADDR'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $ip = trim(end($ipList));
    }
    return $ip;
}

$ip = getUserIP();
$time = date("H:i:s");

$info = @json_decode(file_get_contents("http://ip-api.com/json/$ip"));
$country = $info->country ?? "Unknown";
$region = $info->regionName ?? "Unknown";
$city = $info->city ?? "Unknown";

$log = "[$time] IP: $ip | $country, $region, $city\n";
file_put_contents("ip.log", $log, FILE_APPEND);
file_put_contents("combined.log", $log, FILE_APPEND);
echo $log;
?>
