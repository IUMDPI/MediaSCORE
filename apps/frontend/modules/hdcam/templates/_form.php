<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('hdcam/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
        if($('#hd_cam_formatVersion').val()==1)
        {
            $('label[for=hd_cam_speed]').show();
                $('#hd_cam_speed').show();
        }
        else{
                $('label[for=hd_cam_speed]').hide();
                $('#hd_cam_speed').hide();
        }
    }
</script>