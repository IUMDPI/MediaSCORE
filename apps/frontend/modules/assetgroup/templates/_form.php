<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form id="asset-group-form" action="<?php echo url_for('assetgroup/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
	<!-- For the selection of the format type constants -->
	<?php if(!$form->getObject()->isNew()): ?>
	<tr>
		<td>
			<label>Format Type</label>
			<select id="format-type-model-name">
				<option value ="" selected>Format</option>
				<?php	foreach(FormatType::$typeNames as $formatTypeArray):
						foreach($formatTypeArray as $formatTypeModelName => $formatTypeStr): ?>
							<option value ="<?php echo strtolower($formatTypeModelName)?>"><?php echo $formatTypeStr?></option>
				<?php 		endforeach;
					endforeach ?>
			</select>
		</td>
	</tr>
	<?php endif; ?>
	<tr>
		<td>Collection Assignment</td>
		<td>
			<select multiple="multiple" id="unit-multiple-select">
				<option>Loading Unit(s)...</option>
			</select>
			<select multiple="multiple" id="collection-multiple-select">
				<option>Loading Collection(s)...</option>
			</select>
		</td>
	</tr>
      <tr>
        <td colspan="2">&nbsp;<input id="asset-group-save" type="submit" value="Save" />&nbsp;or&nbsp;<a href="<?php echo url_for('assetgroup/index?c='. $form->getOption('collectionID') ) ?>">cancel</a></td>
      </tr>
    </tfoot>
    <tbody>
	<?php echo $form ?>
        
    </tbody>
 </table>
</form>
