<?php

require_once(dirname(__FILE__) . '/../config/ProjectConfiguration.class.php');
$serverName = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : gethostname();


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
$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', ENVIRONMENT, TRUE);
sfContext::createInstance($configuration)->dispatch();
