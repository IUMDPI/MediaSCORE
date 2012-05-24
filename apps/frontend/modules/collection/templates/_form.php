<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<h1>Create/Edit a Collection</h1>
<div id="main" class="clearfix">
<form action="<?php echo url_for('collection/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?u=11&id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
	<td colspan="2">
	<input type="submit" value="Save" />&nbsp;or&nbsp;<?php echo link_to('cancel','collection/index?u='.$form->getOption('unitID')) ?>
        </td>
      </tr>
    </tfoot>
    <tbody>
    <?php echo $form ?>
    </tbody>
  </table>
</form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
       
//        $("#collection_storage_locations_list").multiselect({
//            'height':'auto'
//            
//        }).multiselectfilter();
        
        $('#collection_status').multiselect({
            'height':'auto',
            'multiple':false
        });
        
    });
</script>