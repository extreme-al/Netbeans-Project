<?php
/* connection functions to keep them safe (?)from prying eyes */

try
{
	$link = mysqli_connect('localhost', 'joke-user', 'joke-pass');
	if (!$link)
	{
		showError('Unable to connect to database');
	}
} catch (Exception $ex)
{
	showError('Caught exception:' ,  $e->getMessage());
}

if (!mysqli_set_charset($link, 'utf8'))
{
	showError('Unable to set charset');
}

if (!mysqli_select_db($link, 'ijdb'))
{
	showError('Unable to select records');
}