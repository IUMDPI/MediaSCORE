<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('analogaudiocassette/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
                    <?php echo $form['tape_type']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['tape_type']->render(); ?> 
                    <?php echo $form['tape_type']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

                    <?php echo $form['thin_tape']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['thin_tape']->render(); ?> <?php if($form['thin_tape']->hasError()){echo '<div class="help-text"> Check the box if 120 or 180 minute cassettes.</div>';}?> 
                    <?php echo $form['thin_tape']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

                    <?php echo $form['slow_speed']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['slow_speed']->render(); ?> <?php if($form['slow_speed']->hasError()){echo '<div class="help-text"> Check the box if cassette is marked as recorded at 0.9375 ips.</div>';}?> 
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
