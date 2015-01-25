<?php
if (isset($_POST['submit']))
{
	$name = mysql_real_escape_string($_POST['name']);
	$email = mysql_real_escape_string($_POST['email']);
	$reason = mysql_real_escape_string($_POST['reason']);
	$text = mysql_real_escape_string($_POST['text']);

	// Administrator
	$admin = ADMIN_EMAIL;
	$reason2 = "Contact | $reason | $name ";

	if (empty($name))
	{
		$tpl = new raintpl();
		$tpl->assign('error', 'You have not specified a name.');
		$tpl->draw('error');
	}
	elseif (empty($email))
	{
		$tpl = new raintpl();
		$tpl->assign('error', 'You have not specified a email.');
		$tpl->draw('error');
	}
	elseif (empty($reason))
	{
		$tpl = new raintpl();
		$tpl->assign('error', 'You have not specified a reason.');
		$tpl->draw('error');
	}
	elseif (empty($text))
	{
		$tpl = new raintpl();
		$tpl->assign('error', 'You have not specified a message.');
		$tpl->draw('error');
	}
	else
	{
		mail($admin, $reason2, $text, 'From:' . $email);
		$tpl = new raintpl();
		$tpl->assign('error', 'Your contact request has been sent.');
		$tpl->draw('success');
	}
}
else
{
	$tpl = new raintpl();
	$tpl->draw('contact');
}
?>
