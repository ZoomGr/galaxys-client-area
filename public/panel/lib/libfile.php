<?php
	function resize($source)
	{
		$image = FALSE;

		$mimeType = mime_content_type($source);

		if($mimeType==="image/png")
		{
			$image = imagecreatefrompng($source);
		}
		elseif($mimeType==="image/jpeg")
		{
			$image = imagecreatefromjpeg($source);
		}
		elseif($mimeType==="image/gif")
		{
			$image = imagecreatefromgif($source);
		}

		if( $image !== false )
		{
			ob_start();

			$maxWidth = 1920;
			$maxHeight = 1080;

			list($width_orig, $height_orig) = getimagesize($source);

			$scaleWidth = $width_orig / $maxWidth;
			$scaleHeight = $height_orig / $maxHeight;

			if($scaleWidth > 1 || $scaleHeight > 1)
			{
				if($scaleWidth > $scaleHeight)
				{
					$scale = $scaleWidth;
				}
				else
				{
					$scale = $scaleHeight;
				}

				$width = round($width_orig / $scale);
				$height = round($height_orig / $scale);
			}
			else
			{
				$width = $width_orig;
				$height = $height_orig;
			}

			$image_p = imagecreatetruecolor($width, $height);
			if($mimeType==="image/png")
			{
				imagealphablending($image_p, false);

				imagesavealpha($image_p, true);
			}

			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

			if($mimeType==="image/png")
			{
				imagepng($image_p);
			}
			elseif($mimeType==="image/jpeg")
			{
				imagejpeg($image_p, null, 80);
			}
			elseif($mimeType==="image/gif")
			{
				imagegif($image_p);
			}

			return ob_get_clean();
		}
		else
		{
			return false;
		}
	}

	function uploadImage($sourcePath, $extension)
	{
		$year = date("Y");
		$month = date("m");
		$day = date("d");

		$mediaDir = "../media/".$year."/".$month."/".$day;

		if( !is_dir($mediaDir) )
		{
			mkdir($mediaDir, 0777, true);
		}

		if( is_dir($mediaDir) )
		{
			$filename = bin2hex( openssl_random_pseudo_bytes(20) );

			$mediaPath = $mediaDir."/".$filename.".".$extension;

			if( !is_file($mediaPath) )
			{
				if( defined("DISABLE_THUMBNAIL") && DISABLE_THUMBNAIL===true )
				{
					$result = file_put_contents($mediaPath, resize($sourcePath));
				}
				else
				{
					ob_start();

					passthru("php resize.php ".$sourcePath, $output);

					$result = file_put_contents($mediaPath, ob_get_clean());
				}

				if($result!==FALSE)
				{
					return $mediaPath;
				}
				else
				{
					return FALSE;
				}
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	function uploadFile($sourcePath, $extension)
	{
		$year = date("Y");
		$month = date("m");
		$day = date("d");

		$mediaDir = "../media/".$year."/".$month."/".$day;

		if( !is_dir($mediaDir) )
		{
			mkdir($mediaDir, 0777, true);
		}

		if( is_dir($mediaDir) )
		{
			$filename = bin2hex( openssl_random_pseudo_bytes(20) );

			$mediaPath = $mediaDir."/".$filename.".".$extension;

			if( move_uploaded_file($sourcePath, $mediaPath) )
			{
				return $mediaPath;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	function isValidImage($img)
	{
		$validExtensions = array("jpg", "jpeg", "png", "gif");

		$extension = pathinfo($img, PATHINFO_EXTENSION);

		foreach($validExtensions as $validExtension)
		{
			if($extension===$validExtension || $extension===strtoupper($validExtension))
			{
				return TRUE;
			}
		}

		return FALSE;
	}

	function isValidFile($img)
	{
		$validExtensions = array("pdf", "doc", "xls", "ppt", "docx", "xlsx", "pptx", "zip", "rar", "7zip", "svg");

		$extension = pathinfo($img, PATHINFO_EXTENSION);

		foreach($validExtensions as $validExtension)
		{
			if($extension===$validExtension || $extension===strtoupper($validExtension))
			{
				return TRUE;
			}
		}

		return FALSE;
	}

	function delFileAt($fieldName, $entityId)
	{
		global $db;

		$fieldPrefix = parseColumnPrefix($fieldName);

		$tableName = getTableName($fieldPrefix);

		$oldData = $db->data("SELECT ".$fieldName." AS oldPath FROM ".$tableName." WHERE ".$fieldPrefix."_entity=?", array($entityId));
		if( count($oldData) > 0 )
		{
			if( is_file($oldData[0]["oldPath"]) )
			{
				if( unlink($oldData[0]["oldPath"]) )
				{
					$db->request("UPDATE ".$tableName." SET ".$fieldName."=NULL WHERE ".$fieldPrefix."_entity=?", array($entityId));
				}
			}
		}
	}

	function delFileAtLang($fieldName, $entityId, $languageId)
	{
		global $db;

		$fieldPrefix = parseColumnPrefix($fieldName);

		$tableName = getTableName($fieldPrefix);

		$oldData = $db->data("SELECT ".$fieldName." AS oldPath FROM ".$tableName." WHERE ".$fieldPrefix."_entity=? AND ".$fieldPrefix."_lang=?", array($entityId, $languageId));
		if( count($oldData) > 0 )
		{
			if( is_file($oldData[0]["oldPath"]) )
			{
				if( unlink($oldData[0]["oldPath"]) )
				{
					$db->request("UPDATE ".$tableName." SET ".$fieldName."=NULL WHERE ".$fieldPrefix."_entity=? AND ".$fieldPrefix."_lang=?", array($entityId, $languageId));
				}
			}
		}
	}

	function delGalleryFile($entityId, $fileId)
	{
		global $db;

		$results = $db->data("SELECT * FROM entity_gallery WHERE eg_entity=? AND eg_id=?", array($entityId, $fileId));
		if( count($results) > 0 )
		{
			if( is_file($results[0]["eg_path"]) )
			{
				if( unlink($results[0]["eg_path"]) )
				{
					$db->request("DELETE FROM entity_gallery WHERE eg_id=?", array($results[0]["eg_id"]));

					$db->request("DELETE FROM entity_gallery_lang WHERE egl_gallery=?", array($results[0]["eg_id"]));
				}
			}
		}
	}
?>
