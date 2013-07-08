<h1>Collection  Status Report</h1>
<hr/>
<?php
echo $NoRecordFound = get_slot('my_slot');
?>

<form action="<?php echo url_for('reports/collectionstatusreport') ?>" method="post">
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

					<?php echo $form['collectionStatus']->renderLabel(); ?>
                </th>
                <td>
					<?php echo $form['collectionStatus']->render(); ?>
					<?php echo $form['collectionStatus']->renderError(); ?>
                </td>
            </tr>
			<tr>
                <th>

					<?php echo $form['EvaluatorsStartDate']->renderLabel(); ?>
                </th>
                <td>
					<?php echo $form['EvaluatorsStartDate']->render(); ?>
					<?php echo $form['EvaluatorsStartDate']->renderError(); ?>
                </td>
            </tr>
			<tr>
                <th>

					<?php echo $form['EvaluatorsEndDate']->renderLabel(); ?>
                </th>
                <td>
					<?php echo $form['EvaluatorsEndDate']->render(); ?>
					<?php echo $form['EvaluatorsEndDate']->renderError(); ?>
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
		height: 'auto',
		multiple: true
	});
	$('#reports_listCollection_RRD').multiselect({
		height: 'auto',
		multiple: true

	});

	$('#reports_collectionStatus').multiselect({
		height: 'auto',
		multiple: true
	});
	$('#reports_ExportType').multiselect({
		height: 'auto',
		multiple: false,
		selectedList:1,
		minWidth:65

	});

</script>


<script type="text/javascript">

	$(document).ready(function() {
		var dates = $("#reports_EvaluatorsStartDate").datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			'dateFormat': 'yy-mm-dd',
			minDate: $("#date_depart").val(),
			onSelect: function(selectedDate) {
				$("#reports_EvaluatorsStartDate").datepicker('hide');
			}
		});

		var dates = $("#reports_EvaluatorsEndDate").datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			'dateFormat': 'yy-mm-dd',
			onSelect: function(selectedDate) {
				if ((new Date($("#reports_EvaluatorsStartDate").val()).getTime() > new Date($("#reports_EvaluatorsEndDate").val()).getTime())) {
					alert('End Date cannot be less then Start Date');
					$("#reports_EvaluatorsEndDate").val('');
				} else {
					$("#reports_EvaluatorsEndDate").datepicker('hide');
				}
			}
		});


	});
</script>