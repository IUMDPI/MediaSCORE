<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
// this check prevents access to debug front controllers that are deployed by accident to production servers.
// feel free to remove this, extend it or make something more sophisticated.
/* if (!in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', '192.168.2.102')))
  {
  die('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
  } */
echo 'om1221111';
exit;
require_once(dirname(__FILE__) . '/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'testing', true);

sfContext::createInstance($configuration)->dispatch();
