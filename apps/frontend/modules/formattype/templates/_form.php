<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('formattype/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" >
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table class="general">
        <tfoot></tfoot>
        <tbody>
            <tr>
                <th>
                    <?php echo $form->renderHiddenFields(); ?>
                    <?php echo $form['quantity']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['quantity']->render(); ?> 
                    <?php echo $form['quantity']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

                    <?php echo $form['generation']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['generation']->render(); ?> 
                    <?php echo $form['generation']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

                    <?php echo $form['year_recorded']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['year_recorded']->render(); ?><?php if($form['year_recorded']->hasError()){echo '<div class="help-text"> If a range, enter a midpoint or a significant year.</div>';}?> 
                    <?php echo $form['year_recorded']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

                    <?php echo $form['copies']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['copies']->render(); ?><?php if($form['copies']->hasError()){echo '<div class="help-text"> If a range, enter a midpoint or a significant year.</div>';}?> 
                    <?php echo $form['copies']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

                    <?php echo $form['stock_brand']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['stock_brand']->render(); ?> 
                    <?php echo $form['stock_brand']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

                    <?php echo $form['off_brand']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['off_brand']->render(); ?> 
                    <?php echo $form['off_brand']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

                    <?php echo $form['fungus']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['fungus']->render(); ?> 
                    <?php echo $form['fungus']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

                    <?php echo $form['other_contaminants']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['other_contaminants']->render(); ?><?php if($form['other_contaminants']->hasError()){echo '<div class="help-text"> Check the box if the object contains dirt, oil, powder, crystals, foreign objects or other particulate matter.</div>';}?> 
                    <?php echo $form['other_contaminants']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

                    <?php echo $form['duration']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['duration']->render(); ?><?php if($form['duration']->hasError()){echo '<div class="help-text"> Enter the actual or estimated playback time for the collection or asset group. This is the total duration for the entire asset group, in minutes. Not the average number of minutes per item.</div>';}?> 
                    <?php echo $form['duration']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

                    <?php echo $form['duration_type']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['duration_type']->render(); ?><?php if($form['duration_type']->hasError()){echo '<div class="help-text"> Calculated is when it is known definitively. Estimate is when you have some evidence available to inform a best guess. If you have no evidence the max estimate is used based on the maximum media duration.</div>';}?> 
                    <?php echo $form['duration_type']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>

                    <?php echo $form['duration_type_methodology']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['duration_type_methodology']->render(); ?><?php if($form['duration_type_methodology']->hasError()){echo '<div class="help-text"> Describe the methodology and evidence used to calculate duration.</div>';}?> 
                    <?php echo $form['duration_type_methodology']->renderError(); ?>
                </td>

            </tr>
            


        </tbody>
    </table>
</form>

