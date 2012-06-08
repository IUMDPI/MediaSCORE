<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<!--<h1>Create/Edit a Collection</h1>-->
<div style="background-color: #F4F4F4;padding-left: 5px;padding-right: 5px;" id="collectionMain">
<div id="main" class="clearfix">
    <form id="collection_form" action="<?php echo url_for('collection/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <?php if (!$form->getObject()->isNew()): ?>
            <input type="hidden" name="sf_method" value="put" />
        <?php endif; ?>
            
        <table class="normal_form">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Save" id="collection_save"/>
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
                        <?php echo $form['name']->render(array('title'=>'The name commonly used to refer to the collection')); ?> <div class="help-text">The name commonly used to refer to the collection</div>
                        <?php echo $form['name']->renderError(); ?>
                    </td>

                </tr>
                <tr>
                    <th>
                        <?php echo $form['inst_id']->renderLabel(); ?>
                    </th>
                    <td>
                        <?php echo $form['inst_id']->render(array('title'=>'IU\'s identifier if applicable')); ?> <div class="help-text">IU's identifier if applicable</div>
                        <?php echo $form['inst_id']->renderError(); ?>
                    </td>

                </tr>
                <?php if ($form->getOption('action') == 'edit') { ?>
                    <tr>
                        <th>
                            <?php echo $form['parent_node_id']->renderLabel(); ?>
                        </th>
                        <td>
                            <?php echo $form['parent_node_id']->render(); ?> 
                            <?php echo $form['parent_node_id']->renderError(); ?>
                        </td>

                    </tr>
                <script type="text/javascript">
                    $('#collection_parent_node_id').multiselect({
                        'height':'auto',
                        'multiple':false
                    });
                    $("#collection_parent_node_id").bind("multiselectclick", function(event, ui){
                        var array_of_checked_values = $("#collection_parent_node_id").multiselect("getChecked").map(function(){
                            return this.value;	
                        }).get();
            
                        getStorage(array_of_checked_values);
                    });
                </script>
            <?php } ?>
            <tr>
                <th>
                    <?php echo $form['storage_locations_list']->renderLabel(); ?>:
                </th>
                <td>
                    <?php echo $form['storage_locations_list']->render(); ?><?php echo $form['storage_locations_list']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>
                    <?php echo $form['notes']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['notes']->render(array('title'=>'Provide a description of the collection')); ?>
                    <div style="clear: both;"></div><div class="help-text">Provide a description of the collection</div>
                    <?php echo $form['notes']->renderError(); ?>
                </td>

            </tr>

            <tr>
                <th>
                    <?php echo $form['status']->renderLabel(); ?>
                </th>
                <td>


                    <?php echo $form['status']->render(); ?><?php echo $form['status']->renderError(); ?>


                </td>

            </tr>

            <?php //echo $form ?>
            </tbody>
        </table>
    </form>
</div>
</div></div>
