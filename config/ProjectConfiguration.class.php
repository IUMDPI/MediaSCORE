<?php

//require_once dirname(__FILE__).'/../lib/vendor/lib/autoload/sfCoreAutoload.class.php'; // live/testing
//require_once '/usr/share/pear/symfony/autoload/sfCoreAutoload.class.php'; //nouman
require_once dirname(__FILE__) . '/../lib/vendor/lib/autoload/sfCoreAutoload.class.php';  //furqan
sfCoreAutoload::register();
@date_default_timezone_set('America/New_York');

class ProjectConfiguration extends sfProjectConfiguration {

    public function setup() {
        $this->enablePlugins(array(
            'sfDoctrinePlugin',
            // 04/29/12
            'sfDoctrineGuardPlugin',
        ));
        
        
    }

}
