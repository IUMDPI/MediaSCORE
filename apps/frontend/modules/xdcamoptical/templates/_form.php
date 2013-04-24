<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('xdcamoptical/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
        $("#xd_cam_optical_dataRate").multiselect({
            'height':'auto',
            'minWidth':145,
            'id':'dataRate'
        });
        $("#xd_cam_optical_codec").multiselect({
            'height':'auto',
            'minWidth':145,
            'id':'codec'
        });
        checkFormat();
        checkCodec();
    });
    function checkFormat(){
        if($('#xd_cam_optical_format').val()=='0'){
            $('.ui-multiselect').first().show();
            $('label[for="xd_cam_optical_codec"]').show();
            checkCodec();
            
        }
        else{
            $('.ui-multiselect').hide();
            $('label[for="xd_cam_optical_codec"]').hide();
            $('label[for="xd_cam_optical_dataRate"]').hide();
        }
    }
    function checkCodec(){
        codec=$('#xd_cam_optical_codec').val();
        codecSD=false;
        for(i in codec){
            if(codec[i]=='1')
                codecSD=true;
        }
        if(codecSD){
            $('.ui-multiselect').last().show();
            $('label[for="xd_cam_optical_dataRate"]').show();
            
        }
        else{
            $('.ui-multiselect').last().hide();
            $('label[for="xd_cam_optical_dataRate"]').hide();
            
        }
    }

</script>


<script type="text/javascript">
    $(function(){
        $("#format_type_off_brand").parents(".row").show();
        $("#format_type_fungus").parents(".row").show();
    });
</script>