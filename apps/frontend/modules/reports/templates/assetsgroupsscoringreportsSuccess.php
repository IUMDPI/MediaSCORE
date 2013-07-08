<h1>Asset Groups Scoring Reports </h1>
<?php
echo $NoRecordFound = get_slot('my_slot');
?>

<form action="<?php echo url_for('reports/assetsgroupsscoringreports') ?>" method="post">
	<table>
		<?php echo $form->renderGlobalErrors(); ?>
		<tfoot>
            <tr>
                <td colspan="2">
					<input type="submit" value="Export" />&nbsp;<span>or</span>&nbsp;<a href="<?php echo url_for('reports/index') ?>">Cancel</a>
                </td>
            </tr>
        </tfoot>
		 <tbody>
            <tr>
                <th>
                   <?php echo $form->renderHiddenFields(); ?>
                   <?php echo $form['listUnits_RRD']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['listUnits_RRD']->render(); ?>
                    <?php echo $form['listUnits_RRD']->renderError(); ?>
                </td>
            </tr>
            <tr>
                <th>
                   
                   <?php echo $form['format_id']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['format_id']->render(); ?>
                    <?php echo $form['format_id']->renderError(); ?>
                </td>
            </tr>
            <tr>
                <th>
                   
                   <?php echo $form['ExportType']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['ExportType']->render(); ?>
                    <?php echo $form['ExportType']->renderError(); ?>
                </td>
            </tr>
		 </tbody>
	</table>
  
  
</form>

<script type="text/javascript">
	$('#reports_listUnits_RRD').multiselect({
		'height': 'auto',
		'multiple': true,
		'height':200
	});
	$('#reports_format_id').multiselect({
		'height': 'auto',
		'multiple': true

	});
	$("#reports_listUnits_RRD").bind("multiselectclick checkall uncheckall", function(event, ui) {
		var array_of_checked_values = $("#reports_listUnits_RRD").multiselect("getChecked").map(function() {
			return this.value;
		}).get();

//            if(array_of_checked_values!='')
		getUnitFormat(array_of_checked_values);

	});
	$('#reports_collectionStatus').multiselect({
		'height': 'auto',
		'multiple': true,
		'height':200
	});
	function getUnitFormat(ids) {
		
		$.ajax({
			method: 'POST',
			url: '/reports/getUnitFormats?u=' + ids,
			dataType: 'json',
			cache: false,
			success: function(result) {
				$('#reports_format_id').html('');
				for (cnt in result) {
					$('#reports_format_id').append('<option value="' + result[cnt].format_id + '">' + result[cnt].format_name + '</option>');
				}
				$("#reports_format_id").multiselect("destroy");
				$("#reports_format_id").multiselect("refresh");
				$('#reports_format_id').multiselect({
					height: 'auto',
					multiple: true
				});
			}
		});
	}
</script>