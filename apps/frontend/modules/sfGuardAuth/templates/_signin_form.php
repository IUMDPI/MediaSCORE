
<form class="clearfix" action="<?php echo url_for('sfGuardAuth/signin') ?>" method="post">
    <div id="log-in" class="clearfix">
        <h3>Log In</h3>

        <?php echo $form->renderHiddenFields(); ?>
        <div class="login-field">
            <div class="row" style="color: red;">
                <?php echo ($form['username']->renderError()); ?>
                <?php echo ($form['password']->renderError()); ?>
            </div>

            <div class="row">
                <div class="left-column"> <?php echo $form['username']->renderLabel(); ?>:</div>
                <?php echo $form['username']->render(); ?> 

            </div>

            <div class="row">
                <div class="left-column"><?php echo $form['password']->renderLabel(); ?>:</div>
                <?php echo $form['password']->render(); ?>
            </div>

            <div class="right-column small"><a href="<?php echo url_for('sfGuardAuth/forgotpassword') ?>">Forgot password?</a></div>
            <div class="right-column"><input type="submit" value="Log In" class="button" /></div>
        </div>
    </div>
    <div id="log-in-configuration">
        <p>Configure your defaults for this session:</p>

        <div class="row">
            <div class="left-column"><?php echo $form['unit']->renderLabel(); ?>:</div>
            <?php echo $form['unit']->render(); ?>
        </div>

        <div class="row" id="row_personnel_list" style="display: none;">
            <div class="left-column"><?php echo $form['personnel_list']->renderLabel(); ?>:</div>
            <?php echo $form['personnel_list']->render(); ?>
        </div>

        <div class="row" id="row_location" style="display: none;" >
            <div class="left-column"><?php echo $form['storage_locations_list']->renderLabel(); ?>:</div>
            <?php echo $form['storage_locations_list']->render(); ?>
        </div>


    </div> 
</form>
<script type="text/javascript"> 
    $(document).ready(function() {
        $("#signin_unit").multiselect({
            'height':'auto',
            'minWidth':145,
            'multiple':false,
            selectedList: 1 // 0-based index
            
        });
        $("#signin_unit").bind("multiselectclick", function(event, ui){
            var array_of_checked_values = $("#signin_unit").multiselect("getChecked").map(function(){
                return this.value;	
            }).get();
        
            if(array_of_checked_values!='')
                getUnitPersonnel(array_of_checked_values);
            else{
                $('#row_personnel_list').hide();
                $('#row_location').hide();
            }
        });
        
    });
    function getUnitPersonnel(id){
        $.ajax({
            method: 'POST', 
            url: '/frontend_dev.php/unit/unitPersonnelLocation?u='+id,
            dataType: 'json',
            cache: false,
            success: function (result) { 
                
                
                $('#signin_personnel_list').html('');
                $('#signin_storage_locations_list').html('');
                if(result.unit!=undefined && result.unit.length>0){
                    for(personnel in result.unit){
                        $('#signin_personnel_list').append('<option value='+result.unit[personnel].id+'>'+result.unit[personnel].first_name+result.unit[personnel].last_name+'</option>');
                    }
                    $('#row_personnel_list').show();
                    $("#signin_personnel_list").multiselect("destroy");
                    $("#signin_personnel_list").multiselect("refresh");
                    $('#signin_personnel_list').multiselect({
                        'height':'auto',
                        'minWidth':145 // 0-based index
                    }).multiselectfilter();
                }
                else{
                    $("#signin_personnel_list").multiselect("destroy");
                    $("#signin_personnel_list").multiselect("refresh");
                    $('#row_personnel_list').hide();
                }
                if(result.location!=undefined && result.location.length>0){
                    for(storage in result.location){
                        $('#signin_storage_locations_list').append('<option value='+result.location[storage].id+'>'+result.location[storage].name+'</option>');
                    }
                    $('#row_location').show();
                    $("#signin_storage_locations_list").multiselect("destroy");
                    $("#signin_storage_locations_list").multiselect("refresh");
                    $("#signin_storage_locations_list").multiselect({
                        'height':'auto',
                        'minWidth':145
                    }).multiselectfilter();
                }
                else{
                    $("#signin_storage_locations_list").multiselect("destroy");
                    $("#signin_storage_locations_list").multiselect("refresh");
                    $('#row_location').hide();
                }
            }
        });
    }
</script>

