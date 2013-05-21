<?php
if (ENVIRONMENT === 'production' || ENVIRONMENT === 'qa')
	require_once dirname(__FILE__) . '/../lib/vendor/lib/autoload/sfCoreAutoload.class.php';
else
	require_once dirname(__FILE__) . '/../lib/vendor/lib/autoload/sfCoreAutoload.class.php';
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
