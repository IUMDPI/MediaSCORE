<?php include_partial('form', array('form' => $form)) ?>
<script type="text/javascript">
    $(document).ready(function() {
        checkFormat();
    });
    function checkFormat(){
        if($('#hd_cam_formatVersion').val()==1)
        {
            $('label[for=hd_cam_speed]').show();
                $('#hd_cam_speed').prepend('<option value="">Select</option>');
                $('#hd_cam_speed').show();
        }
        else{
                $('label[for=hd_cam_speed]').hide();
                $('#hd_cam_speed').hide();
        }
    }
</script>
