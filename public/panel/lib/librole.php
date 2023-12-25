<?php
	function findRoleByName($name)
	{
		global $db;

		$results = $db->data("SELECT * FROM roles WHERE role_name=?", array($name));
		if( count($results) > 0 )
		{
			return $results[0];
		}
		else
		{
			return false;
		}
	}

	function findRoleById($id)
	{
		global $db;

		$results = $db->data("SELECT * FROM roles WHERE role_id=?", array($id));
		if( count($results) > 0 )
		{
			return $results[0];
		}
		else
		{
			return false;
		}
	}

	function getRoles()
	{
		global $db;

		return $db->data("SELECT * FROM roles", array());
	}

	function attachRoleToUser($roleId, $uid)
	{
		global $db;

        $db->request("UPDATE users SET role_id=? WHERE user_id=?", array($roleId, $uid));
        $queryResult = $db->request("INSERT INTO user_roles (ur_user, ur_role) VALUES (?, ?)", array($uid, $roleId));
		if($queryResult===1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function getUserRoles($uid)
	{
		global $db;

		$ret = array();

		$results = $db->data("SELECT * FROM user_roles WHERE ur_user=?", array($uid));
		foreach($results as $result)
		{
			$ret[] = $result["ur_role"];
		}

		return $ret;
	}

	function saveRole($entityId)
	{
		global $db;

		if( isset($_POST["role"]) && is_string($_POST["role"]) )
		{
			if( ctype_digit($_POST["role"]) )
			{
				$role = findRoleById($_POST["role"]);
				if($role!==false)
				{
					setRole($entityId, $role["role_id"]);
				}
				else
				{
					unsetRole($entityId);
				}
			}
			else
			{
				unsetRole($entityId);
			}
		}
		else
		{
			unsetRole($entityId);
		}
	}

	function unsetRole($entityId)
	{
		global $db;

		$db->request("UPDATE entities SET entity_role=NULL WHERE entity_id=?", array($entityId));
	}

	function setRole($entityId, $roleId)
	{
		global $db;

		$db->request("UPDATE entities SET entity_role=? WHERE entity_id=?", array($roleId, $entityId));
	}
?>
