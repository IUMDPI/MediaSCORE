<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form id="evaluator-history-form" action="<?php echo url_for('evaluatorhistory/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php //if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php //echo link_to('Delete', 'evaluatorhistory/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php //endif; ?>
          <input id="evaluator-history-save" type="submit" value="Save" />
          &nbsp;or&nbsp;<!--<a href="<?php //echo url_for('evaluatorhistory/index') ?>">Cancel</a>--><a id="evaluator-history-cancel" href="#">Cancel</a>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
