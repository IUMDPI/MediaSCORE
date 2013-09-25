<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('characteristicsvalues/' . ($form->getObject()->isNew() ? 'create' : 'update') . ( ! $form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
	<?php if ( ! $form->getObject()->isNew()): ?>
		<input type="hidden" name="sf_method" value="put" />
	<?php endif; ?>
    <table>

        <tbody>
			<?php echo $form->renderHiddenFields(); ?>
			<?php echo $form->renderGlobalErrors() ?>
            <tr>
                <th><?php echo $form['c_name']->renderLabel() ?></th>
                <td>
					<?php echo $form['c_name']->render(); ?> 
					<?php echo $form['c_name']->renderError() ?>

                </td>
            </tr>
            <tr>
                <th><?php echo $form['c_score']->renderLabel() ?></th>
                <td>
					<?php echo $form['c_score']->render(); ?> 
					<?php echo $form['c_score']->renderError() ?>

                </td>
            </tr>
            <tr>
                <th><?php echo $form['format_id']->renderLabel() ?></th>
                <td>
					<?php echo $form['format_id']->render(); ?> 
					<?php echo $form['format_id']->renderError() ?>

                </td>
            </tr>
            <tr>
                <th><?php echo $form['constraint_id']->renderLabel() ?></th>
                <td>
					<?php echo $form['constraint_id']->render(); ?> 
					<?php echo $form['constraint_id']->renderError() ?>

                </td>
            </tr>
            <tr>
                <th><?php echo $form['parent_characteristic_id']->renderLabel() ?></th>
                <td>
					<?php echo $form['parent_characteristic_id']->render(); ?> 
					<?php echo $form['parent_characteristic_id']->renderError() ?>

                </td>
            </tr>

        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">

                    &nbsp;<a href="<?php echo url_for('characteristicsvalues/index') ?>">Back to list</a>
					<?php // if ( ! $form->getObject()->isNew()): 
						 //echo link_to('Delete', 'characteristicsvalues/delete?id=' . $form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ;
					 //endif; ?>
                    <input type="submit" value="Save" />
                </td>
            </tr>
        </tfoot>
    </table>
</form>
