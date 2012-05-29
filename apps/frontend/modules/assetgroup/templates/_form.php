<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form id="asset-group-form" action="<?php echo url_for('assetgroup/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table class="assets-table">
        <tfoot>
            <!-- For the selection of the format type constants -->
            <?php if (!$form->getObject()->isNew()): ?>
                <tr><td colspan="2">
                        <div class="section edit-asset-group clearfix">
                            <h3>Format</h3>
                            <div class="left-column-container">

                                <div class="row clearfix">
                                    <div class="left-column"><b>Format Type: </b></div>
                                    <div class="right-column">
                                        <select id="format-type-model-name" onchange="getRelatedForm()">
                                            <option value ="" selected>Format</option>
                                            <?php
                                            foreach (FormatType::$typeNames as $formatTypeArray):
                                                foreach ($formatTypeArray as $formatTypeModelName => $formatTypeStr):
                                                    ?>
                                                    <option value ="<?php echo strtolower($formatTypeModelName) ?>"><?php echo $formatTypeStr ?></option>
                                                    <?php
                                                endforeach;
                                            endforeach
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div id="format_specific" class="left-column-container"></div>
                        </div>
                    </td>


                </tr>


            <?php endif; ?>



            <tr>
                <?php
                if (!$form->getObject()->isNew())
                    $buttonValue = 'Save';
                else
                    $buttonValue = 'Continue';
                ?>
                <td colspan="2">&nbsp;<input id="asset-group-save" type="submit" value="<?php echo $buttonValue; ?>" />&nbsp;or&nbsp;<a href="<?php echo url_for('assetgroup/index?c=' . $form->getOption('collectionID')) ?>">cancel</a></td>
            </tr>
        </tfoot>
        <tbody>
            <?php if ($form->getObject()->isNew()) { ?>
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
                        <?php echo $form['inst_id']->render(); ?> <div class="help-text">IU's identifier if applicable</div>
                        <?php echo $form['inst_id']->renderError(); ?>
                    </td>

                </tr>
                <tr>
                    <th>
                        <?php echo $form['location']->renderLabel(); ?>
                    </th>
                    <td>
                        <?php echo $form['location']->render(); ?> <div class="help-text">Provide a specific location within the storage location such as a shelf number or area of a room</div>
                        <?php echo $form['location']->renderError(); ?>
                    </td>

                </tr>
                <tr>
                    <th>
                        <?php echo $form['storage_location_id']->renderLabel(); ?>
                    </th>
                    <td>
                        <?php echo $form['storage_location_id']->render(); ?> 
                        <?php echo $form['storage_location_id']->renderError(); ?>
                    </td>

                </tr>
                <tr>
                    <th><label><span class="required">*</span>Collection Assignment:</label></th>
                    <td>
                        <select multiple="multiple" id="unit-multiple-select">
                            <option>Loading Unit(s)...</option>
                        </select>
                        <select multiple="multiple" id="collection-multiple-select">
                            <option>Loading Collection(s)...</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        <?php echo $form['notes']->renderLabel(); ?>
                    </th>
                    <td>
                        <?php echo $form['notes']->render(); ?> <div class="help-text">Explain what is distinctive about this subcollection</div>
                        <?php echo $form['notes']->renderError(); ?>
                    </td>

                </tr>
                <?php
            } else {
                ?>
                <tr>
                    <td colspan="2">
                        <select multiple="multiple" id="unit-multiple-select">
                            <option>Loading Unit(s)...</option>
                        </select>
                        <select multiple="multiple" id="collection-multiple-select">
                            <option>Loading Collection(s)...</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="section edit-asset-group clearfix">
                            <h3>Basic Information</h3>
                            <div class="left-column-container">

                                <div class="row clearfix">
                                    <div class="left-column"><?php echo $form->renderHiddenFields(); ?>
                                        <?php echo $form['name']->renderLabel(); ?></div>
                                    <div class="right-column">
                                        <?php echo $form['name']->render(); ?> 
                                        <?php echo $form['name']->renderError(); ?>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="left-column"><?php echo $form['location']->renderLabel(); ?></div>
                                    <div class="right-column">
                                        <?php echo $form['location']->render(); ?>
                                        <?php echo $form['location']->renderError(); ?>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="left-column"> <?php echo $form['inst_id']->renderLabel(); ?></div>
                                    <div class="right-column">
                                        <div><?php echo $form['inst_id']->render(); ?>
                                            <?php echo $form['inst_id']->renderError(); ?></div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="left-column"><?php echo $form['storage_location_id']->renderLabel(); ?></div>
                                    <div class="right-column">
                                        <div>
                                            <?php echo $form['storage_location_id']->render(); ?>
                                            <?php echo $form['storage_location_id']->renderError(); ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="right-column-container">
                                <div class="row">
                                    <div class="left-column"><?php echo $form['notes']->renderLabel(); ?></div>
                                    <?php echo $form['notes']->render(array('style' => 'width:450px;')); ?>
                                    <?php echo $form['notes']->renderError(); ?>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div id="format-type-container" class="section edit-asset-group clearfix">

                        </div>
                    </td>
                </tr>




                <?php
//                echo $form;
            }
            ?>


        </tbody>
    </table>


</form>
