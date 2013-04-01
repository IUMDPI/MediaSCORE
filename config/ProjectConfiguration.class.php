<?php

//require_once dirname(__FILE__).'/../lib/vendor/lib/autoload/sfCoreAutoload.class.php';
//require_once 'D://xampp//htdocs//symfony//symfony//lib/autoload/sfCoreAutoload.class.php';
require_once '/usr/lib/symfony-1.4.16/lib/autoloadsfCoreAutoload.class.php';  
sfCoreAutoload::register();
@date_default_timezone_set('America/New_York');
class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
	  $this->enablePlugins(array(
		  'sfDoctrinePlugin',
		  // 04/29/12
		  'sfDoctrineGuardPlugin',
	  ));
  }
}
