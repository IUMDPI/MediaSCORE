<h1>Percentage of holdings Report</h1>
<hr/>

<?php
echo $NoRecordFound = get_slot('my_slot');
?>
<br/>


<form action="<?php echo url_for('reports/percentageofholdings') ?>" method="post">
	<table>

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

					<?php echo $form['listCollection_RRD']->renderLabel(); ?>
                </th>
                <td>
					<?php echo $form['listCollection_RRD']->render(); ?>
					<?php echo $form['listCollection_RRD']->renderError(); ?>
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

					<?php echo $form['ReportType']->renderLabel(); ?>
                </th>
                <td>
					<?php echo $form['ReportType']->render(); ?>
					<?php echo $form['ReportType']->renderError(); ?>
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
		multiple: true,
		height: 200
	});
	$('#reports_listCollection_RRD').multiselect({
		multiple: true,
		height: 200

	});

	$('#reports_format_id').multiselect({
		multiple: true,
		height: 200
	});
	if ($('#reports_listUnits_RRD').val() == '' || $('#reports_listUnits_RRD').val() == null) {
		$("#reports_listCollection_RRD").multiselect("disable");
		$("#reports_format_id").multiselect("disable");
	}
	else
		getCollections($('#reports_listUnits_RRD').val());

	$("#reports_listUnits_RRD").bind("multiselectclick multiselectcheckall multiselectuncheckall", function(event, ui) {
		var array_of_checked_values = $("#reports_listUnits_RRD").multiselect("getChecked").map(function() {
			return this.value;
		}).get();
		getCollections(array_of_checked_values);

	});
	$("#reports_listCollection_RRD").bind("multiselectclick multiselectcheckall multiselectuncheckall", function(event, ui) {
		var array_of_checked_values = $("#reports_listCollection_RRD").multiselect("getChecked").map(function() {
			return this.value;
		}).get();
		getCollectionFormat(array_of_checked_values);

	});
	function getCollections(ids) {
		$("#reports_listCollection_RRD").multiselect("disable");

		$.ajax({
			method: 'POST',
			url: '/index.php/reports/getUnitCollections?u=' + ids,
			dataType: 'json',
			cache: false,
			success: function(result) {
				$('#reports_listCollection_RRD').html('');
				for (cnt in result.collections) {
					$('#reports_listCollection_RRD').append('<option value="' + result.collections[cnt].id + '">' + result.collections[cnt].name + '</option>');
				}

				$("#reports_listCollection_RRD").multiselect("destroy");
				$("#reports_listCollection_RRD").multiselect("refresh");
				$('#reports_listCollection_RRD').multiselect({
					height: '180',
					multiple: true
				});

				if (result.collections.length > 0)
					$("#reports_listCollection_RRD").multiselect("enable");

			}
		});
	}
	function getCollectionFormat(ids) {
		$("#reports_format_id").multiselect("disable");
		$.ajax({
			method: 'POST',
			url: '/index.php/reports/getCollectionFormats?c=' + ids,
			dataType: 'json',
			cache: false,
			success: function(result) {
				$('#reports_format_id').html('');

				for (cnt in result.formats) {
					$('#reports_format_id').append('<option value="' + result.formats[cnt].id + '">' + result.formats[cnt].name + '</option>');
				}
				$("#reports_format_id").multiselect("destroy");
				$("#reports_format_id").multiselect("refresh");

				$('#reports_format_id').multiselect({
					height: 'auto',
					multiple: true
				});

				if (result.formats.length > 0)
					$("#reports_format_id").multiselect("enable");
			}
		});
	}
</script>