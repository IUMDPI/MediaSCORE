<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('lacquerdisc/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
                    <?php echo $form['substrate']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['substrate']->render(); ?> 
                    <?php echo $form['substrate']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

                    <?php echo $form['delamination']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['delamination']->render(); ?> 
                    
                    <?php echo $form['delamination']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

                    <?php echo $form['plasticizerExudation']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['plasticizerExudation']->render(); ?>
                    <?php echo $form['plasticizerExudation']->renderError(); ?>
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
