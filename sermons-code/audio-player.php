<?php
require("mysql.php");
require("functions.php");

$sermonID = trim($_GET['id']);
if (!is_numeric($sermonID)) { exit; }

$sermonAudioPath = "../../../uploads/sermons/";

$sql   = sprintf("SELECT sermons.title, sermons.description, sermons.theDate, serviceTimes.title, sermons.speaker, sermons.audioFile, sermons.videoFile FROM sermons INNER JOIN serviceTimes ON sermons.serviceTimeID = serviceTimes.id WHERE sermons.id = %s", mysqlize($sermonID));
$query = mysql_query($sql);

if ($query) {
	$row = mysql_fetch_row($query);

	$sermonTitle       = $row[0];
	$sermonDescription = $row[1];
	$sermonDate        = $row[2];
	$sermonServiceTime = $row[3];
	$sermonSpeaker     = $row[4];
	$sermonAudioFile   = $row[5];
	$sermonVideoFile   = $row[6];
	
	$sermonAudioFileSize = round(((filesize($sermonAudioPath.$sermonAudioFile) / 1024) / 1024));
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title><?php echo $pageTitle . $siteTitle; ?></title>
	<link type="text/css" href="/wp-content/themes/MBC-Ocala-FL/style.css" rel="stylesheet" />
	<script type="text/javascript" src="../sermons-code/audio-player.js"></script>
	<script type="text/javascript" src="../sermons-code/swfobject1-5/swfobject.js"></script>
</head>
<body style="color: #ffffff; background: none; background-color: #5578B0; text-align: center;">

<img src="../images/audio-player-logo.jpg" alt="Memorial Baptist Church" title="Memorial Baptist Church" />

<div style="font-size: 12px; font-weight: bold;">
	<?php echo $sermonTitle; ?> - <?php echo $sermonSpeaker; ?>
</div>
<div style="font-size: 10px;">
	<?php echo $sermonServiceTime; ?> - <?php echo date("F j, Y", strtotime($sermonDate)); ?>
</div>

<div id="flashcontent" style="margin: 10px 0;"></div>
<script type="text/javascript">
var so = new SWFObject("player.swf", "audioplayer<?php echo $sermonID; ?>", "290", "24", "8", "#5578B0");
so.addVariable("playerID", "<?php echo $sermonID; ?>");
so.addVariable("autostart", "yes");
so.addVariable("soundFile", "<?php echo $sermonAudioPath . $sermonAudioFile; ?>");
so.write("flashcontent");
</script>

</body>
</html>