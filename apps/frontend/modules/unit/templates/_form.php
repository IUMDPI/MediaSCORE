<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>


<h1>Create/Edit a Unit</h1>
<div id="main" class="clearfix">
    <form action="<?php echo url_for('unit/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <?php if (!$form->getObject()->isNew()): ?>
            <input type="hidden" name="sf_method" value="put" />
        <?php endif; ?>

        <table class="extended_form">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Save" />
                        &nbsp;or&nbsp;<a href="<?php echo url_for('unit/index') ?>">cancel</a>

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
                        <?php echo $form['inst_id']->render(); ?> <div class="help-text">Unit Code assigned by MPI</div>
                        <?php echo $form['inst_id']->renderError(); ?>
                    </td>

                </tr>
                <tr>
                    <th>
                        <?php echo $form['resident_structure_description']->renderLabel(); ?>
                    </th>
                    <td>
                        <?php echo $form['resident_structure_description']->render(); ?> <div class="help-text">Enter the Building name(s) or Room number(s) where the Unit is located</div>
                        <?php echo $form['resident_structure_description']->renderError(); ?>
                    </td>

                </tr>
                <tr>
                    <th>
                        <?php echo $form['notes']->renderLabel(); ?>
                    </th>
                    <td>
                        <?php echo $form['notes']->render(); ?><?php echo $form['notes']->renderError(); ?>
                    </td>

                </tr>
                <tr>
                    <th>
                        <?php echo $form['storage_locations_list']->renderLabel(); ?>
                    </th>
                    <td>
                        <?php echo $form['storage_locations_list']->render(); ?><?php echo $form['storage_locations_list']->renderError(); ?>
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

                <?php //echo $form ?>
            </tbody>
        </table>

    </form>

</div>
<script type="text/javascript">
    $(document).ready(function() {
       
        $("#unit_storage_locations_list").multiselect({
            'height':'auto'
            
        }).multiselectfilter();
        $('#unit_personnel_list').multiselect({
            'height':'auto'
        }).multiselectfilter();
        var array_of_checked_values = $("#unit_personnel_list").multiselect("getChecked").map(function(){
            return this.value;	
        }).get();
        
        getDetail(array_of_checked_values);
        
    });
    $("#unit_personnel_list").bind("multiselectclick multiselectcheckall multiselectuncheckall", function(event, ui){
        var array_of_checked_values = $("#unit_personnel_list").multiselect("getChecked").map(function(){
            return this.value;	
        }).get();
        
        getDetail(array_of_checked_values);
    });
    
    function getDetail(id){
        $.ajax({
            method: 'POST', 
            url: '/frontend_dev.php/unit/getUserDetail?id='+id,
            dataType: 'json',
            cache: false,
            success: function (result) { 
                if(result.records!=undefined){
                    length=result.records.length;
                    $('#user_info').html('');
                    for(cnt=0;cnt<length;cnt++){
                        name=result.records[cnt].first_name+result.records[cnt].last_name;
                        email=result.records[cnt].email_address;
                        phone=result.records[cnt].phone;
                        role=result.records[cnt].role;
                        $('#user_info').append('<tr><td>'+name+'</td><td>'+email+'</td><td>'+phone+'</td><td>'+role+'</td></tr>');
                        
                    }
                }
                        
                        
            }
        });
    }
    
</script>
