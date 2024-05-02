<?php
	function getUserType($uid)
	{
		global $db;

		$results = $db->data("SELECT * FROM users WHERE user_id=?", array($uid));
		if( count($results) > 0 )
		{
			return $results[0]["user_type"];
		}
		else
		{
			return false;
		}
	}

	function findUserById($id)
	{
		global $db;

		$results = $db->data("SELECT * FROM users WHERE user_id=?", array($id));
		if( count($results) > 0 )
		{
			return $results[0];
		}
		else
		{
			return false;
		}
	}

	function findUserByEmail($email)
	{
		global $db;

		$results = $db->data("SELECT * FROM users WHERE email=?", array($email));
		if( count($results) > 0 )
		{
			return $results[0];
		}
		else
		{
			return false;
		}
	}

	function isEditableUserType($userType)
	{
        if(empty($userType) && (USER_TYPE ==="ROOT" || USER_TYPE==="ADMIN")) {
            return true;
        }

		if($userType==="ROOT")
		{
			if(USER_TYPE==="ROOT")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		elseif($userType==="ADMIN")
		{
			if(USER_TYPE==="ROOT" || USER_TYPE==="ADMIN")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		elseif($userType==="AUTHOR")
		{
			if(USER_TYPE==="ROOT" || USER_TYPE==="ADMIN")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		elseif($userType==="CUSTOMER")
		{
			if(USER_TYPE==="ROOT" || USER_TYPE==="ADMIN")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
?>
