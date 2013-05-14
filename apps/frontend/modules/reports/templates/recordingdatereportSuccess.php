Recording Date Report
<br/><br/>
<br/>
<br/>
<?php
echo $NoRecordFound = get_slot('my_slot');
?>
<form action="<?php echo url_for('reports/recordingdatereport') ?>" method="post">
    <?php echo $form['listUnits_RRD']->renderLabel(); ?>
    <br/>
    <br/>
    <?php
    echo $form['listUnits_RRD']->renderError();
    echo $form['listUnits_RRD']->render();
    ?>
    <div style="clear: both;"></div>
    <br/>
    <br/>
    <br/>
    <?php echo $form['ExportType']->renderLabel(); ?>
    <br/>
    <br/>
    <?php echo $form['ExportType']->renderError(); ?>
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
        'multiple':true,
        'height':200
    });
  
</script>