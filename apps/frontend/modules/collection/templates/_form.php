<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<h1>Create/Edit a Collection</h1>
<form action="<?php echo url_for('collection/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
	<td colspan="2">
	<input type="submit" value="Save" />&nbsp;or&nbsp;<?php echo link_to('Back to List','collection/index?u='.$form->getOption('unitID')) ?>
        </td>
      </tr>
    </tfoot>
    <tbody>
    <?php echo $form ?>
    </tbody>
  </table>
</form>
