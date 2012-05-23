<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>



<div id="main" class="clearfix">
    <form action="<?php echo url_for('unit/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <?php if (!$form->getObject()->isNew()): ?>
            <input type="hidden" name="sf_method" value="put" />
        <?php endif; ?>

        <table>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Save" />
              <!--          &nbsp;or&nbsp;<a href="<?php //echo url_for('unit/index')    ?>">cancel</a>-->
                        &nbsp;or&nbsp;<a href="javascript://" onclick="$.fancybox.close();">cancel</a>
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php echo $form ?>
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
        
    });
</script>
