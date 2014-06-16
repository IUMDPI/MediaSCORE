<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('analogaudiocassette/' . ($form->getObject()->isNew() ? 'create' : 'update') . ( ! $form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
	<?php if ( ! $form->getObject()->isNew()): ?>
		<input type="hidden" name="sf_method" value="put" />
	<?php endif; ?>
    <table>
        <tfoot>
        </tfoot>
        <tbody>
            <tr>
                <th>
					<?php echo $form->renderHiddenFields(); ?>
					<?php echo $form['tape_type']->renderLabel(); ?>
                </th>
                <td>
					<?php echo $form['tape_type']->render(); ?> 
					<?php echo $form['tape_type']->renderError(); ?>
                </td>

            </tr>
            <tr id="thin_tape_row">
                <th>

					<?php echo $form['thin_tape']->renderLabel(); ?>
                </th>
                <td>
					<?php echo $form['thin_tape']->render(); ?> 
					<?php echo $form['thin_tape']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

					<?php echo $form['slow_speed']->renderLabel(); ?>
                </th>
                <td>
					<?php echo $form['slow_speed']->render(); ?>
					<?php echo $form['slow_speed']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

					<?php echo $form['sound_field']->renderLabel(); ?>
                </th>
                <td>
					<?php echo $form['sound_field']->render(); ?> 
					<?php echo $form['sound_field']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

					<?php echo $form['noise_reduction']->renderLabel(); ?>
                </th>
                <td>
					<?php echo $form['noise_reduction']->render(); ?> 
					<?php echo $form['noise_reduction']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

					<?php echo $form['pack_deformation']->renderLabel(); ?>
                </th>
                <td>
					<?php echo $form['pack_deformation']->render(); ?> 
					<?php echo $form['pack_deformation']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

					<?php echo $form['softBinderSyndrome']->renderLabel(); ?>
                </th>
                <td>
					<?php echo $form['softBinderSyndrome']->render(); ?> 
					<?php echo $form['softBinderSyndrome']->renderError(); ?>
                </td>

            </tr>
        </tbody>
    </table>
</form>
<script type="text/javascript">
	$(function() {
		checkTapeType();
		$("#format_type_off_brand").parents(".row").show();
		$("#format_type_fungus").parents(".row").show();
	});
	function checkTapeType() {
		tapeType = $('analog_audiocassette_tape_type').val();
		if (tapeType == 4 || tapeType == 5) {
			$('#thin_tape_row').hide();
			$('#analog_audiocassette_thin_tape').attr('checked', false);
		}
	}
</script>