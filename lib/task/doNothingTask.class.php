<?php

class doNothingTask extends sfBaseTask {

    protected function configure() {
        // // add your own arguments here
        // $this->addArguments(array(
        //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
        // ));

        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
                // add your own options here
        ));
        $this->namespace = 'project';
        $this->name = 'do-nothing';
        $this->briefDescription = 'Does strictly nothing';

        $this->detailedDescription = <<<EOF
The [doNothing|INFO] task does things.
Call it with:

  [php symfony doNothing|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array()) {
        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();
        echo 'hello i am in boi';
        var_dump($arguments);
        var_dump($options);
        
        // add your code here
    }

}
