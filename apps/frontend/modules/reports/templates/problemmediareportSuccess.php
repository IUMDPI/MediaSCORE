<h1>Problem  Media Report</h1>
<hr/>
<?php
echo $NoRecordFound = get_slot('my_slot');
?>

<form action="<?php echo url_for('reports/problemmediareport') ?>" method="post">
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
					<?php echo $form['listCollection_RRD']->renderLabel(); ?>
                </th>
                <td>
					<?php echo $form['listCollection_RRD']->render(); ?>
					<?php echo $form['listCollection_RRD']->renderError(); ?>
                </td>
            </tr>
			<tr>
                <th>

					<?php echo $form['Constraints']->renderLabel(); ?>
                </th>
                <td>
					<?php echo $form['Constraints']->render(); ?>
					<?php echo $form['Constraints']->renderError(); ?>
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

	$('#reports_listCollection_RRD').multiselect({
		multiple: true,
		height: 200

	});
	$('#reports_Constraints').multiselect({
		height: 'auto',
		multiple: true,
	});

</script>