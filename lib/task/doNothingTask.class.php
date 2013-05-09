<?php

include(dirname(__FILE__) . '/../../apps/frontend/lib/scoreCalculator.php');

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



        $FormatTypes = Doctrine_Query::Create()
                ->from('FormatType ft')
                ->select('ft.*')
                ->fetchArray();
        $i = 0;
        foreach ($FormatTypes as $FormatType) {
            if ($FormatType) {
                $characteristicsValue = Doctrine_Query::Create()
                        ->from('CharacteristicsValues cv')
                        ->select('cv.*,cc.*,cf.*')
                        ->leftJoin('cv.CharacteristicsConstraints cc')
                        ->leftJoin('cv.CharacteristicsFormat cf')
                        ->addWhere("cv.format_id = '" . $FormatType['type'] . "'")
                        ->fetchArray();
//                foreach ($characteristicsValue as $characteristics) {
//                    if ($characteristics['CharacteristicsFormat']['format_c_name'] == 'base_score') {
//                        print_r($characteristics);
//                    }
//                }

                $score = 0;
                $AssetInformatoin = array(0 => array('FormatType' => $FormatType));
                $scoreCalculator = new scoreCalculator();
                $score = $scoreCalculator->callFormatCalculator($AssetInformatoin, $characteristicsValue);
                


                $response = Doctrine_Query::create()
                        ->update('FormatType ft')
                        ->set('ft.asset_score', "'$score'")
                        ->where('ft.id = ?', $FormatType['id'])
                        ->execute();
                
//                if ($i == 3)
//                    break;
            }
            $i++;
        }

        exit;


        // add your code here
    }

}
