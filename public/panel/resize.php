<?php
	if(isset($argv) && is_array($argv) && isset($argv[1]) && is_string($argv[1]) && is_file($argv[1]))
	{
		require("lib/libfile.php");
		
		echo resize($argv[1]);
	}