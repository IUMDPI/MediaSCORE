
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

            <div class="right-column small"><a href="#">Forgot password?</a></div>
            <div class="right-column"><input type="submit" value="Log In" class="button" /></div>
        </div>
    </div>
    <div id="log-in-configuration">
        <p>Configure your defaults for this session:</p>

        <div class="row">
            <div class="left-column"><?php echo $form['unit']->renderLabel(); ?>:</div>
            <?php echo $form['unit']->render(); ?>
        </div>

        <div class="row">
            <div class="left-column"><?php echo $form['personnel_list']->renderLabel(); ?>:</div>
            <?php echo $form['personnel_list']->render(); ?>
        </div>

        <div class="row">
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
            'multiple':false
            
        });
        $("#signin_storage_locations_list").multiselect({
            'height':'auto',
            'minWidth':145
            
        }).multiselectfilter();
        $('#signin_personnel_list').multiselect({
            'height':'auto',
            'minWidth':145
        }).multiselectfilter();
        
    });

</script>

