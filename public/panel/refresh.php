<?php
	date_default_timezone_set("UTC");
	
	session_name( sha1( date("Y")."-_-".date("m")."-_-".date("d") ) );
	session_start();
	
	header("Expires: on, 01 Jan 1970 00:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Refresh</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<style>html, body{margin:0 0 0 0;padding:0 0 0 0;}</style>
</head>

<body><meta http-equiv="refresh" content="1200; url=<?php echo $_SERVER["SCRIPT_NAME"] ?>"></body>

</html>
