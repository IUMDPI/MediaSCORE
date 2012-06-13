<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('oneinchopenreelvideo/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
        formatype1 =new Array('Spot, 9"','10.5"','11.75"','14"');
        formatype2 =new Array('8"','12.5"');
        format=$('#one_inch_open_reel_video_format').val();
        reelsize=$('#one_inch_open_reel_video_reelSize').val();
        $('#one_inch_open_reel_video_reelSize').html('');
        if(format==0 || format==1 || format==2){
            for(i=0;i<formatype1.length;i++){
                if(i==reelsize)
                    selected='selected="selected"';
                else
                    selected='';
                $('#one_inch_open_reel_video_reelSize').append('<option value="'+i+'" '+selected+'>'+formatype1[i]+'</option>');
            }
        }
        else{
            cnt=4;
            for(i=0;i<formatype2.length;i++){
               if(cnt==reelsize)
                    selected='selected="selected"';
                else
                    selected='';
                $('#one_inch_open_reel_video_reelSize').append('<option value="'+cnt+'" '+selected+'>'+formatype2[i]+'</option>');
                cnt++;
            }
        }
    }

</script>