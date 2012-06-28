<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('formattype/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" >
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table class="general formattype_table">
        <tfoot></tfoot>
        <tbody>
            <tr>
                <td colspan="2">
                    <div class="section edit-asset-group clearfix">
                       
                        <div class="left-column-container">

                            <div class="row clearfix">
                                <div class="left-column"><?php echo $form->renderHiddenFields(); ?>
                                    <b><?php echo $form['quantity']->renderLabel(); ?></b></div>
                                <div class="right-column">
                                    <?php echo $form['quantity']->render(); ?> 
                                    <?php echo $form['quantity']->renderError(); ?>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="left-column">
                                    <b><?php echo $form['generation']->renderLabel(); ?></b></div>
                                <div class="right-column">
                                    <?php echo $form['generation']->render(); ?> 
                                    <?php echo $form['generation']->renderError(); ?>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="left-column">
                                    <b><?php echo $form['year_recorded']->renderLabel(); ?></b></div>
                                <div class="right-column">
                                    <?php echo $form['year_recorded']->render(); ?><?php
                                    if ($form['year_recorded']->hasError()) {
                                        echo '<div class="help-text"> If a range, enter a midpoint or a significant year.</div>';
                                    }
                                    ?> 
<?php echo $form['year_recorded']->renderError(); ?>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="left-column">
                                    <b><?php echo $form['copies']->renderLabel(); ?></b></div>
                                <div class="right-column">
                                    <?php echo $form['copies']->render(); ?><?php
                                    if ($form['copies']->hasError()) {
                                        echo '<div class="help-text"> If a range, enter a midpoint or a significant year.</div>';
                                    }
                                    ?> 
<?php echo $form['copies']->renderError(); ?>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="left-column">
                                    <b><?php echo $form['stock_brand']->renderLabel(); ?></b></div>
                                <div class="right-column">
<?php echo $form['stock_brand']->render(); ?>
<?php echo $form['stock_brand']->renderError(); ?>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="left-column">
                                    <b><?php echo $form['off_brand']->renderLabel(); ?></b></div>
                                <div class="right-column">
<?php echo $form['off_brand']->render(); ?>
<?php echo $form['off_brand']->renderError(); ?>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="left-column">
                                    <b><?php echo $form['fungus']->renderLabel(); ?></b></div>
                                <div class="right-column">
<?php echo $form['fungus']->render(); ?>
<?php echo $form['fungus']->renderError(); ?>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="left-column">
                                    <b><?php echo $form['other_contaminants']->renderLabel(); ?></b></div>
                                <div class="right-column">
<?php echo $form['other_contaminants']->render(); ?><?php
if ($form['other_contaminants']->hasError()) {
    echo '<div class="help-text"> Check the box if the object contains dirt, oil, powder, crystals, foreign objects or other particulate matter.</div>';
}
?> 
                                    <?php echo $form['other_contaminants']->renderError(); ?>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="left-column">
                                    <b><?php echo $form['duration']->renderLabel(); ?></b></div>
                                <div class="right-column">
<?php echo $form['duration']->render(); ?><?php
if ($form['duration']->hasError()) {
    echo '<div class="help-text"> Enter the actual or estimated playback time for the collection or asset group. This is the total duration for the entire asset group, in minutes. Not the average number of minutes per item.</div>';
}
?> 
                                    <?php echo $form['duration']->renderError(); ?>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="left-column">
                                    <b><?php echo $form['duration_type']->renderLabel(); ?></b></div>
                                <div class="right-column">
<?php echo $form['duration_type']->render(); ?><?php
if ($form['duration_type']->hasError()) {
    echo '<div class="help-text"> Calculated is when it is known definitively. Estimate is when you have some evidence available to inform a best guess. If you have no evidence the max estimate is used based on the maximum media duration.</div>';
}
?> 
                                    <?php echo $form['duration_type']->renderError(); ?>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="left-column">
                                    <b><?php echo $form['duration_type_methodology']->renderLabel(); ?></b></div>
                                <div class="right-column">
                                    <?php echo $form['duration_type_methodology']->render(); ?><?php
                                        if ($form['duration_type_methodology']->hasError()) {
                                            echo '<div class="help-text"> Describe the methodology and evidence used to calculate duration.</div>';
                                        }
                                        ?> 
                            <?php echo $form['duration_type_methodology']->renderError(); ?>
                                                            </div>
                                                        </div>







                        </div>

                        <div class="right-column-container">
                            <div class="row">
                                <div class="left-column"><b><?php echo $form['format_notes']->renderLabel(); ?></b></div>
<?php echo $form['format_notes']->render(array('style' => 'width:450px;')); ?>
<?php echo $form['format_notes']->renderError(); ?>
                            </div>
                        </div>
                    </div>

                </td>
            </tr>



        </tbody>
    </table>
</form>

