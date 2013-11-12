<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<style>
    
</style>
<form action="<?php echo url_for('openreelaudiotapepolyster/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
     <?php echo $form->renderHiddenFields(); ?>
    <table>
        <tfoot>
        </tfoot>
        <tbody>
            <?php echo $form ?>
        </tbody>
    </table>
</form>
<script type="text/javascript">
    $(document).ready(function() {

        $("#open_reel_audiotape_polyster_speed").multiselect({
            'height':'auto',
            'minWidth':145
        });
        
        
    });
</script>

<script type="text/javascript">
    $(function(){
        $("#format_type_off_brand").parents(".row").show();
        $("#format_type_fungus").parents(".row").show();
    });
</script>