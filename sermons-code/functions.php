<?php

function mysqlize($string) {
	if (get_magic_quotes_gpc()) {
		if (ini_get('magic_quotes_sybase')) {
			$string = str_replace("''", "'", $string);
		} else {
			$string = stripslashes($string);
		}
	}

	return mysql_real_escape_string($string);
}

?>