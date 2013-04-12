<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('characteristicsvalues/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>

        <tbody>
            <?php echo $form->renderGlobalErrors() ?>
            <tr>
                <th><?php echo $form['c_name']->renderLabel() ?></th>
                <td>
                    <?php echo $form['c_name']->renderError() ?>
                    <?php echo $form['c_name'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['c_score']->renderLabel() ?></th>
                <td>
                    <?php echo $form['c_score']->renderError() ?>
                    <?php echo $form['c_score'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['format_id']->renderLabel() ?></th>
                <td>
                    <?php echo $form['format_id']->renderError() ?>
                    <?php echo $form['format_id'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['constraint_id']->renderLabel() ?></th>
                <td>
                    <?php echo $form['constraint_id']->renderError() ?>
                    <?php echo $form['constraint_id'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['parent_characteristic_id']->renderLabel() ?></th>
                <td>
                    <?php echo $form['parent_characteristic_id']->renderError() ?>
                    <?php echo $form['parent_characteristic_id'] ?>
                </td>
            </tr>
      <!--      <tr>
              <th><?php // echo $form['created_at']->renderLabel()   ?></th>
              <td>
            <?php // echo $form['created_at']->renderError() ?>
            <?php // echo $form['created_at'] ?>
              </td>
            </tr>
            <tr>
              <th><?php // echo $form['updated_at']->renderLabel()   ?></th>
              <td>
            <?php // echo $form['updated_at']->renderError() ?>
            <?php // echo $form['updated_at'] ?>
              </td>
            </tr>-->
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">
                    <?php echo $form->renderHiddenFields(false) ?>
                    &nbsp;<a href="<?php echo url_for('characteristicsvalues/index') ?>">Back to list</a>
                    <?php if (!$form->getObject()->isNew()): ?>
                        &nbsp;<?php echo link_to('Delete', 'characteristicsvalues/delete?id=' . $form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
                    <?php endif; ?>
                    <input type="submit" value="Save" />
                </td>
            </tr>
        </tfoot>
    </table>
</form>
