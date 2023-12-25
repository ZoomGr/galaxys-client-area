<?php
class db {

	private $link;

	function __construct()
	{
		$this->link = new mysqli(DB_LOCATION, DB_USER, DB_PASSWORD, DB_NAME);
		if(mysqli_connect_errno())
		{
			printf("Database connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else
		{
			$this->request("SET NAMES utf8;", array());
			$this->request("SET CHARACTER SET utf8;", array());
		}
	}

	function request($query, $params)
	{
		$stmt = $this->link->prepare($query);
		if($stmt!==false)
		{
			if(count($params) > 0)
			{
				$args = array("");
				
				foreach($params as $ind=>$param)
				{
					if(is_string($param))
					{
						$args[0] .= "s";
					}
					elseif(is_float($param))
					{
						$args[0] .= "d";
					}
					elseif(is_int($param))
					{
						$args[0] .= "i";
					}
					else
					{
						exit("Internal error");
					}
					
					$args[] = &$params[$ind];
				}
				
				if(count($args) > 1)
				{
					$operationStatus = $stmt->bind_param(...$args);
					if($operationStatus===false)
					{
						exit($this->link->error);
					}
				}
			}
			
			$operationStatus = $stmt->execute();
			if($operationStatus===true)
			{
				if(substr($query, 0, 6)==="SELECT")
				{
					return $stmt->get_result();
				}
				else
				{
					return $stmt->affected_rows;
				}
			}
			else
			{
				exit($this->link->error);
			}
		}
		else
		{
			exit($this->link->error);
		}
	}
	
	function data($query, $params)
	{
		$result = $this->request($query, $params);
		if($result)
		{
			$ret = array();
			
			foreach($result as $row)
			{
				$ret[] = $row;
			}
			
			return $ret;
		}
		else
		{
			return array();
		}
	}
	
	function insertId()
	{
		return $this->link->insert_id;
	}
	
	function generatePlaceHolders($number)
	{
		$arr = array();
		
		for($i=1; $i<=$number; $i++)
		{
			$arr[] = "?";
		}
		
		return implode(",", $arr);
	}
}
