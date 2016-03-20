<?php
function Url()
{
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
	return $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']);
}