<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>


<!--<h1>Create/Edit a Unit</h1>-->
<div style="background-color: #F4F4F4;padding-left: 5px;padding-right: 5px;" id="unitMain">
    <div id="main" class="clearfix" >
        <form id="unit_form" action="<?php echo url_for('unit/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
            <?php if (!$form->getObject()->isNew()): ?>
                <input type="hidden" name="sf_method" value="put" />
            <?php endif; ?>

            <table class="extended_form">
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Save" id="unit_save"/>
<!--                            &nbsp;or&nbsp;<a href="<?php echo url_for('unit/index') ?>">cancel</a>-->
                            &nbsp;or&nbsp;<a href="javascript:void(0);" onclick="$.fancybox.close();">cancel</a>

                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <th>
                            <?php echo $form->renderHiddenFields(); ?>
                            <?php echo $form['name']->renderLabel(); ?>
                        </th>
                        <td>
                            <?php echo $form['name']->render(); ?> 
                            <?php echo $form['name']->renderError(); ?>
                        </td>

                    </tr>
                    <tr>
                        <th>
                            <?php echo $form['inst_id']->renderLabel(); ?>
                        </th>
                        <td>
                            <?php echo $form['inst_id']->render(array('title' => 'Unit Code assigned by MPI')); ?> <div class="help-text">Unit Code assigned by MPI</div>
                            <?php echo $form['inst_id']->renderError(); ?>
                        </td>

                    </tr>
                    <tr>
                        <th>
                            <?php echo $form['resident_structure_description']->renderLabel(); ?>
                        </th>
                        <td>
                            <?php echo $form['resident_structure_description']->render(array('title' => 'Enter the Building name(s) or Room number(s) where the Unit is located')); ?> <div class="help-text">Enter the Building name(s) or Room number(s) where the Unit is located</div>
                            <?php echo $form['resident_structure_description']->renderError(); ?>
                        </td>

                    </tr>
                    <tr>
                        <th>
                            <?php echo $form['notes']->renderLabel(); ?>
                        </th>
                        <td>
                            <?php echo $form['notes']->render(array('style' => 'width:725px;')); ?><?php echo $form['notes']->renderError(); ?>
                        </td>

                    </tr>
                    <tr>
                        <th>
                            <?php echo $form['storage_locations_list']->renderLabel(); ?>
                        </th>
                        <td>
                            <?php echo $form['storage_locations_list']->render(); ?>
                            <?php if (isset($error)) {
                                echo '<span class="required">' . $error . '</span>';
                            } ?>
<?php echo $form['storage_locations_list']->renderError(); ?>
                        </td>

                    </tr>
                    <tr style="background-color: #DADADA;">
                        <th>
<?php echo $form['personnel_list']->renderLabel(); ?>
                        </th>
                        <td style="padding: 8px 10px;">


<?php echo $form['personnel_list']->render(); ?><?php echo $form['personnel_list']->renderError(); ?>
                            <table id="user_info" style="width: 70%;">

                            </table>

                        </td>

                    </tr>

<?php //echo $form  ?>
                </tbody>
            </table>

        </form>

    </div>
</div>
</div>
