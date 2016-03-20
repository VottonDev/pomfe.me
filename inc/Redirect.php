<?php
function Redirect($string = '')
{
	$url = strval($string);

	if(filter_var($url, FILTER_VALIDATE_URL))
	{
		header('Location: ' . $url);
		die();
	}

	return false;
}