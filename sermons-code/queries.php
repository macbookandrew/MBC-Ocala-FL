<?php
/*
$query  = $all_sermons
$query1 = $speakers
$query2 = $years
$query3 = $latest_year
*/

$clearFilters = trim($_GET["clearfilters"]);
if (strlen($clearFilters) == 0)
	$clearFilters = 0;

if ($clearFilters) {
	unset($_SESSION["sermons_speakerFilter"]);
  unset($_SESSION["sermons_yearFilter"]);
}


//get latest year
$latest_year = mysql_query("SELECT YEAR(theDate) FROM sermons WHERE isActive='True' ORDER BY theDate DESC LIMIT 1") or die(mysql_error($link).' - line 15 of <code>queries.php</code>');

if (mysql_num_rows($latest_year)) {
	while ($row = mysql_fetch_row($latest_year)) {
		$sermonYear = $row[0];
	}
}


//process filters
$speakerFilter = trim(strtolower($_GET["speaker_filter"]));
$yearFilter = trim(strtolower($_GET["year_filter"]));

$filterQuery = "";
if ($speakerFilter == "all") {
	$_SESSION["sermons_speakerFilter"] = $speakerFilter;
} elseif (strlen($speakerFilter)) {
	//$_SESSION["sermons_speakerFilter"] = $speakerFilter;
	$filterQuery .= " AND speaker LIKE '" . mysqlize($speakerFilter) . "'";
} else {
	$speakerFilter = "all";
	$_SESSION["sermons_speakerFilter"] = $speakerFilter;
	//$filterQuery .= " AND speaker LIKE '" . mysqlize($speakerFilter) . "'";
}

if (strlen($yearFilter) > 0) {
  $_SESSION["sermons_yearFilter"] = $yearFilter;
} else {
  //$yearFilter = date('Y');
  $yearFilter = $sermonYear;
  $_SESSION["sermons_yearFilter"] = $yearFilter;
}
$filterQuery .= " AND YEAR(theDate) = '$yearFilter'";

//if (strlen($filterQuery) > 0) {
$_SESSION["sermons_filterQuery"]   = $filterQuery;
$_SESSION["sermons_speakerFilter"] = $speakerFilter;
$_SESSION["sermons_yearFilter"] = $yearFilter;
//}


//get all sermons
$all_sermons_query = sprintf("SELECT sermons.id, sermons.title, sermons.description, sermons.theDate, serviceTimes.title, sermons.speaker, sermons.audioFile, sermons.videoFile FROM sermons INNER JOIN serviceTimes ON sermons.serviceTimeID = serviceTimes.id WHERE isActive='True' %s ORDER BY theDate DESC, serviceTimes.xorder DESC, sermons.id DESC", $_SESSION["sermons_filterQuery"]);

$all_sermons = mysql_query($all_sermons_query) or die(mysql_error($link).' - line 59 of <code>queries.php</code>');


//get distinct list of sermon speakers
$speakers_query = sprintf("SELECT DISTINCT speaker FROM sermons WHERE isActive='True' ORDER BY speaker");
$speakers = mysql_query($speakers_query) or die(mysql_error($link).' - line 64 of <code>queries.php</code>');

//get distinct list of sermon years
$years_query = sprintf("SELECT DISTINCT YEAR(theDate) FROM sermons WHERE isActive='True' ORDER BY theDate DESC");
$years = mysql_query($years_query) or die(mysql_error($link).' - line 68 of <code>queries.php</code>');
?>