<?php

if (strpos($serverName, 'mediascore.avpreserve.com') !== FALSE)
{
	define('ENVIRONMENT', 'production');
}
else if (strpos($serverName, '108.166.74.254') !== FALSE)
{
	define('ENVIRONMENT', 'qa');
}
else
{
	define('ENVIRONMENT', 'local');
}
require_once(dirname(__FILE__) . '/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend_dev', ENVIRONMENT, FALSE);

sfContext::createInstance($configuration)->dispatch();
