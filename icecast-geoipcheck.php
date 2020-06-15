<?php
/*
 * Simple GEO IP blocking with Icecast
 *
 * Restrict by IP origin of continent (AF, AN, AS, EU, NA, OC, SA) or Country (see https://dev.maxmind.com/geoip/legacy/codes/iso3166/ for list of 2 letter country codes)
 *
 *
*/
$continent=geoip_continent_code_by_name(@$_POST['ip']);
$country=geoip_country_code_by_name(@$_POST['ip']);


if($continent=="EU") { // Define your restrictions - for example only allow the continent of EU
	header("icecast-auth-user: 1");
	header("icecast-auth-message: geo-ok");
	$status="GEO OK";
}else{
        header("icecast-auth-user: 0");
	header("icecast-auth-message: geo-blocked");
	$status="GEO blocked";
}

$log=date("Y-m-d H:i:s")." ".@$_POST['ip']." ".$continent." ".$country." ".$status." ".@$_POST['action']." ".@$_POST['mount']." ".@$_POST['server']." ".@$_POST['port']." ".@$_POST['user']." ".@$_POST['pass']." ".@$_POST['client']." ".@$_POST['agent']."\n";

// You shouldn't need to this in production, but it's handy when setting up
file_put_contents("/tmp/debug.txt",$log,FILE_APPEND);
