<?php

// this check prevents access to debug front controllers that are deployed by accident to production servers.
// feel free to remove this, extend it or make something more sophisticated.
/*if (!in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', '192.168.2.102')))
{
  die('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}*/

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'testing', true);
echo 'om1';
exit;
sfContext::createInstance($configuration)->dispatch();
