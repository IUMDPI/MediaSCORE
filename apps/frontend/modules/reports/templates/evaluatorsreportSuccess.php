<h1>Evaluator's Report</h1>
<hr/>

<?php
echo $NoRecordFound = get_slot('my_slot');
?>
<br/>
<form action="<?php echo url_for('reports/evaluatorsreport') ?>" method="post">
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
					<?php echo $form['ListEvaluators']->renderLabel(); ?>
                </th>
                <td>
					<?php echo $form['ListEvaluators']->render(); ?>
					<?php echo $form['ListEvaluators']->renderError(); ?>
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

	$(document).ready(function() {
		$("#reports_EvaluatorsStartDate").attr('readonly', 'readonly');
		$("#reports_EvaluatorsEndDate").attr('readonly', 'readonly');
		$("#reports_EvaluatorsStartDate").attr('style', 'background:#d7d7d2;');
		$("#reports_EvaluatorsEndDate").attr('style', 'background:#d7d7d2;');
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
//				if ((new Date($("#reports_EvaluatorsStartDate").val()).getTime() > new Date($("#reports_EvaluatorsEndDate").val()).getTime())) {
//					alert('End Date cannot be less then Start Date');
//					$("#reports_EvaluatorsEndDate").val('');
//				} else {
				$("#reports_EvaluatorsEndDate").datepicker('hide');
//				}
			}
		});
		$('#reports_format_id').multiselect({
			height: 'auto',
			multiple: true

		});
		$('#reports_format_id .ui-multiselect').css('width', '400px');
		if ($('#reports_ListEvaluators').val() != '')
			getFormats();
		else
			$("#reports_format_id").multiselect("disable");
	});
	function getFormats() {
		$("#reports_format_id").multiselect("disable");
		user = $('#reports_ListEvaluators').val();
		$.ajax({
			method: 'POST',
			url: '/index.php/reports/getUserFormats?u=' + user,
			dataType: 'json',
			cache: false,
			success: function(result) {
				$('#reports_format_id').html('');

				for (cnt in result) {
					$('#reports_format_id').append('<option value="' + cnt + '">' + result[cnt] + '</option>');
				}
				$("#reports_format_id").multiselect("destroy");
				$("#reports_format_id").multiselect("refresh");

				$('#reports_format_id').multiselect({
					height: '200',
					multiple: true
				});

				if (Object.keys(result).length > 0)
					$("#reports_format_id").multiselect("enable");
			}
		});
	}
</script>