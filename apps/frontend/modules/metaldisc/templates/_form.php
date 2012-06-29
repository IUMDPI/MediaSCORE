<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('metaldisc/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
        <tfoot>
        </tfoot>
        <tbody>
            <tr>
                <th>
                    <?php echo $form->renderHiddenFields(); ?>
                    <?php echo $form['material']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['material']->render(); ?> 
                    <?php echo $form['material']->renderError(); ?>
                </td>

            </tr> 
            <tr>
                <th>
                    <?php echo $form['oxidationCorrosion']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['oxidationCorrosion']->render(); ?> 
                    <?php echo $form['oxidationCorrosion']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>
                    <?php echo $form['physicalDamage']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['physicalDamage']->render(); ?> 
                    <?php echo $form['physicalDamage']->renderError(); ?>
                </td>

            </tr>
        </tbody>
    </table>
</form>
