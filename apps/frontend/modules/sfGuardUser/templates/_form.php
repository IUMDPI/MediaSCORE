<?php //use_stylesheets_for_form($form) ?>
<?php //use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
  <?php echo form_tag_for($form, '@sf_guard_user') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

	<?php
	// 05/13/12 - James
	$voidFieldSets = array(	'Permissions and groups' );
	$voidFields = array('Username');

	foreach ( $configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
	<?php
		if(! in_array($fieldset,$voidFieldSets) )
			include_partial('sfGuardUser/form_fieldset', array('sf_guard_user' => $sf_guard_user, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset));
	?>
    <?php endforeach; ?>

    <?php include_partial('sfGuardUser/form_actions', array('sf_guard_user' => $sf_guard_user, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>
