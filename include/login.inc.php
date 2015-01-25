<?php
if (isset($_POST['login']))
{
	$username = mysql_real_escape_string($_POST['username']);
	$password = mysql_real_escape_string($_POST['password']);
	$passhash = hash('sha256', $password);
	
	if (empty($username))
	{
		$tpl = new raintpl();
		$tpl->assign('error', 'You have no username specified.');
		$tpl->draw('error');
	}
	elseif (empty($password))
	{
		$tpl = new raintpl();
		$tpl->assign('error', 'You have no password specified.');
		$tpl->draw('error');
	}
	else
	{
		$sql = "SELECT id, username, password, level FROM user WHERE username = '$username' AND password = '$passhash'";
		$res = mysql_query($sql) or die(mysql_error());
		
		if (mysql_num_rows($res))
		{
			while ($user = mysql_fetch_array($res))
			{
				$_SESSION['login'] = true;
				$_SESSION['login_id'] = $user['id'];
				
				$id = $user['id'];
				$ip = $_SERVER['REMOTE_ADDR'];
				
				$sql = "UPDATE user SET last_login = now(), last_ip = '$ip' WHERE id = '$id'";
				$res = mysql_query($sql) or die(mysql_error());
				
				if ($res == true)
				{
					if ($user['level'] == 1)
					{
						$_SESSION['login_admin'] = true;
						header ("Location: ?p=articles&function=list");
					}
					else
					{
						$_SESSION['login_admin'] = false;
						header ("Location: ?p=articles&function=list");
					}
				}
			}
		}
		else
		{
			$tpl = new raintpl();
			$tpl->assign('error', 'The username / password was not found in our databse.');
			$tpl->draw('error');
		}
	}
}
else
{
	$tpl = new raintpl();
	$tpl->draw('login');
}
?>
