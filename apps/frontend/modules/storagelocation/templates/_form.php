<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('storagelocation/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
        <tfoot>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Save" />&nbsp;or&nbsp;<a href="<?php echo url_for('storagelocation/index') ?>">Cancel</a>
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
                    <?php echo $form['name']->render(array('title'=>'The name commonly used to refer to the storage location.')); ?> 
                    <?php echo $form['name']->renderError(); ?>
                </td>
            </tr>
            <tr>
                <th>
                    
                    <?php echo $form['resident_structure_description']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['resident_structure_description']->render(); ?> 
                    <?php echo $form['resident_structure_description']->renderError(); ?>
                </td>
            </tr>
            <tr>
                <th>
                    
                    <?php echo $form['env_rating']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['env_rating']->render(array('title'=>'Select the environment that best describes the environment for this storage location. See help documentation for guidance.')); ?> 
                    <?php echo $form['env_rating']->renderError(); ?>
                </td>
            </tr>
            <?php //echo $form ?>
        </tbody>
    </table>
</form>
<script type="text/javascript">
$(document).ready(function() {
       
       $('#storage_location_env_rating').multiselect({
            'height':'auto',
            'multiple':false,
            selectedList: 1 // 0-based index
        });
    });
    

</script>


<script type="text/javascript">
    $(function(){
        $("#format_type_off_brand").parents(".row").show();
        $("#format_type_fungus").parents(".row").show();
    });
</script>