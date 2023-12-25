<?php
	error_reporting(E_ALL);
	
	date_default_timezone_set("UTC");
	
	session_name( sha1( date("Y")."-_-".date("m")."-_-".date("d") ) );
	session_start();
	
	header("Expires: on, 01 Jan 1970 00:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
	if( isset($_SESSION["user"]) )
	{
		define("APP", true);
		
		define("DISABLE_THUMBNAIL", true);
		
		require("lib/libfile.php");
		
		if( isset($_FILES["file"]) && !is_array($_FILES["file"]["error"]) && $_FILES["file"]["error"]==UPLOAD_ERR_OK )
		{
			if( isValidFile($_FILES["file"]["name"]) )
			{
				$mediaPath = uploadFile($_FILES["file"]["tmp_name"], pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
			}
			elseif( isValidImage($_FILES["file"]["name"]) )
			{
				$mediaPath = uploadImage($_FILES["file"]["tmp_name"], pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
			}
			else
			{
				exit( json_encode(["success"=>false, "category"=>4]) );
			}
			
			if($mediaPath!==false)
			{
				exit( json_encode(["success"=>true, "file"=>$mediaPath]) );
			}
			else
			{
				exit( json_encode(["success"=>false, "category"=>3]) );
			}
		}
		else
		{
			exit( json_encode(["success"=>false, "category"=>2]) );
		}
	}
	else
	{
		exit( json_encode(["success"=>false, "category"=>1]) );
	}
?>
