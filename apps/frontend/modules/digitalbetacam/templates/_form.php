<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('digitalbetacam/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
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
        checkFormat();
    });
    function checkFormat(){
        if($('#digital_betacam_format').val()==2)
        {
            $('label[for=digital_betacam_bitrate]').show();
                $('#digital_betacam_bitrate').show();
        }
        else{
                $('label[for=digital_betacam_bitrate]').hide();
                $('#digital_betacam_bitrate').hide();
        }
    }
</script>
