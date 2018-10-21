<?php
class session
{
	function setdata($data = array())
	{
		if($data)
		{
			foreach($data as $key=>$val)
			{
				$_SESSION[$key]=$val;
			}
		}
	}
	function clear($data = array())
	{
		if($data)
		{
			foreach($data as $key)
			{
				unset($_SESSION[$key]);
			}
		}
	}
	function destroy()
	{
		session_destroy();
	}
	function get($key)
	{
		if(isset($_SESSION[$key]))
			return $_SESSION[$key];
		return NULL;
	}
	function set($key,$value)
	{
		if(isset($_SESSION[$key]))
			$_SESSION[$key] = $value;
		else
			$_SESSION[$key] = $value;
	}
}
?>