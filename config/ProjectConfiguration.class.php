<?php

//require_once dirname(__FILE__).'/../lib/vendor/lib/autoload/sfCoreAutoload.class.php';
require_once '/usr/share/pear/symfony/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
	  $this->enablePlugins(array(
		  'sfDoctrinePlugin',
		  // 04/29/12
		  'sfDoctrineGuardPlugin'
	  ));
  }
}
