<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<h1>Create/Edit a Collection</h1>
<div id="main" class="clearfix">
    <form action="<?php echo url_for('collection/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <?php if (!$form->getObject()->isNew()): ?>
            <input type="hidden" name="sf_method" value="put" />
        <?php endif; ?>
            
        <table class="normal_form">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Save" />&nbsp;or&nbsp;<?php echo link_to('cancel', 'collection/index?u=' . $form->getOption('unitID')) ?>
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
                    <?php echo $form['storage_locations_list']->renderLabel(); ?>
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
                    <?php echo $form['notes']->render(array('title'=>'Provide a description of the collection')); ?><div class="help-text">Provide a description of the collection</div>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#collection_status').multiselect({
            'height':'auto',
            'multiple':false
        });
       
        
        
        
        
    });
    function getStorage(id){
            $.ajax({
                method: 'POST', 
                url: '/frontend_dev.php/storagelocation/index?u='+id,
                dataType: 'json',
                cache: false,
                success: function (result) { 
                    $("#collection_storage_locations_list").multiselect("destroy");
                    $('#collection_storage_locations_list').html('');
                    if(result!=undefined && result.length>0){
                        for(storage in result){
                            $('#collection_storage_locations_list').append('<option value="'+result[storage].id+'">'+result[storage].name+'</option>');
                        }
                    }
                    else{
                        $('#collection_storage_locations_list').html('<option value="-1">None</option>');
                        
                    }
                    $("#collection_storage_locations_list").multiselect("refresh");
                    $('#collection_storage_locations_list').multiselect({
                        'height':'auto'
                    }).multiselectfilter(); 
                }
            });
        }
</script>