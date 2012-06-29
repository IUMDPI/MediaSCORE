<?php include_partial('form', array('form' => $form)) ?>
<script type="text/javascript">
    $(document).ready(function() {
        checkFormat();
    });
    function checkFormat(){
        if($('#digital_betacam_format').val()==2)
        {
            $('label[for=digital_betacam_bitrate]').show();
            $('#digital_betacam_bitrate').prepend('<option value="">Select</option>');
            $('#digital_betacam_bitrate').show();
        }
        else{
            $('label[for=digital_betacam_bitrate]').hide();
            $('#digital_betacam_bitrate').hide();
        }
    }
</script>
