<?php

// Open mysql connection
if (!($link = mysql_connect("localhost", "memorial_user", "nustuv6w")))
  echo "ERROR connecting to host.";

if (!mysql_select_db("memorial_memorial", $link))
  echo "ERROR connecting to database.";
?>
