<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('xdcamoptical/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
        checkCodec();
    });
    function checkFormat(){
        if($('#xd_cam_optical_format').val()==0){
            $('#xd_cam_optical_codec').show();
            $('label[for="xd_cam_optical_codec"]').show();
            checkCodec();
            
        }
        else{
            $('#xd_cam_optical_codec').hide();
            $('label[for="xd_cam_optical_codec"]').hide();
            $('#xd_cam_optical_dataRate').hide();
            $('label[for="xd_cam_optical_dataRate"]').hide();
        }
    }
    function checkCodec(){
        if($('#xd_cam_optical_codec').val()==1){
            $('#xd_cam_optical_dataRate').show();
            $('label[for="xd_cam_optical_dataRate"]').show();
            
        }
        else{
            $('#xd_cam_optical_dataRate').hide();
            $('label[for="xd_cam_optical_dataRate"]').hide();
            
        }
    }

</script>