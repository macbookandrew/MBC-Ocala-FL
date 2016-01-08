<?php
require("mysql.php");
require("functions.php");

$sermonID = trim($_GET['id']);
if (!is_numeric($sermonID)) { exit; }

$sermonVideoPath = "../../../uploads/sermon-video/";

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
	
	$sermonAudioFileSize = round(((filesize($sermonVideoPath.$sermonVideoFile) / 1024) / 1024));
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title><?php echo $pageTitle . $siteTitle; ?></title>
	<link type="text/css" href="/wp-content/themes/MBC-Ocala-FL/style.css" rel="stylesheet" />

	<style>
        body {
            color: #ffffff;
            background: none;
            background-color: #5578B0;
            text-align: center
        }
        .title {
            font-size: 12px;
            font-weight: bold;
        }
        .date {
            font-size: 10px;
        }
        .mejs-container {
            display: block;
            margin: 1em auto 0;
        }
    </style>

	<script type="text/javascript" src="/wp-includes/js/jquery/jquery.js"></script>
	<script type="text/javascript" src="/wp-includes/js/mediaelement/mediaelement-and-player.min.js"></script>
	<link href="/wp-includes/js/mediaelement/mediaelementplayer.min.css" rel="stylesheet" />
	<script>
        // using jQuery
        jQuery('video,audio').mediaelementplayer(/* Options */);
    </script>

</head>
<body>

    <img src="../images/audio-player-logo.jpg" alt="Memorial Baptist Church" title="Memorial Baptist Church" />

    <p class="title"><?php echo $sermonTitle; ?> - <?php echo $sermonSpeaker; ?></p>

    <p class="date"><?php echo $sermonServiceTime; ?> - <?php echo date("F j, Y", strtotime($sermonDate)); ?></p>

    <video src="<?php echo $sermonVideoPath.$sermonVideoFile; ?>" autoplay controls></video>

</body>
</html>
