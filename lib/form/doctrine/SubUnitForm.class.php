<?php

/**
 * SubUnit form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SubUnitForm extends BaseSubUnitForm
{
  /**
   * @see UnitForm
   */
  public function configure()
  {
	  parent::configure();

	  $this->getWidget('notes')->setLabel('Description:&nbsp;');

  }
}
