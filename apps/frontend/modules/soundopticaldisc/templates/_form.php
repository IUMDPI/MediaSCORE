<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('soundopticaldisc/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
        <tfoot>
            <tr>
                <td colspan="2">
        <!--          &nbsp;<a href="<?php // echo url_for('soundopticaldisc/index')    ?>">Back to list</a>-->
                    <?php if (!$form->getObject()->isNew()): ?>
                        &nbsp;<?php // echo link_to('Delete', 'soundopticaldisc/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?'))    ?>
                    <?php endif; ?>
<!--          <input type="submit" value="Save" />-->
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php echo $form ?>
        </tbody>
    </table>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $("#sound_optical_disc_dataLayer").multiselect({
            'height':'auto',
            'minWidth':145
        });
        $("#sound_optical_disc_reflectiveLayer").multiselect({
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