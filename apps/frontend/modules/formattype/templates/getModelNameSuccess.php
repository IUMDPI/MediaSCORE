"<?php $formatTypeIDs=Doctrine_Core::getTable('FormatType')->getOption('subclasses');
	echo $formatTypeIDs[$formatTypeModel->getType() - 1] ?>"
