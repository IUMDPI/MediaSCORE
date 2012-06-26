<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('person/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          
          
          <input type="submit" value="Save" />&nbsp;or <a href="<?php echo url_for('person/index') ?>">Cancel</a>
        </td>
      </tr>
    </tfoot>
    <tbody id="personForm">
      <?php echo $form ?>
    </tbody>
  </table>
</form>
