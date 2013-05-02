Recording Date Report
<br/><br/>
<form action="<?php echo url_for('reports/recordingdatereport') ?>" method="post">
    <div style="clear: both;"></div>        
    <?php echo $form['listUnits_RRD']->renderLabel(); ?>
    <br/>
    <div style="clear: both;"></div>        
    <?php echo $form['listUnits_RRD']->render(); ?>
    <div style="clear: both;"></div>
    <br/>
    <br/>
    <br/>
    <?php echo $form['ExportType']->renderLabel(); ?>
    <div style="clear: both;"></div>
    <br/>
    <br/>
    <?php echo $form['ExportType']->render(); ?>
    <br/>
    <br/>   
    <br/>
    <input type="submit" value="Export" />
</form>
<script type="text/javascript">
    $('#reports_listUnits_RRD').multiselect({
        'height':'auto',
        'multiple':true,
        'height':200
    });
    $('#reports_listCollection_RRD').multiselect({
        'height':'auto',
        'multiple':true,
        'height':200
        
    });
    
    $('#reports_collectionStatus').multiselect({
        'height':'auto',
        'multiple':true
    });
  
</script>