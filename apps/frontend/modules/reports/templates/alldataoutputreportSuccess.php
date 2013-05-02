All Data Output Report 
<br/><br/>
<?php
echo $NoRecordFound = get_slot('my_slot');
?>

<form action="<?php echo url_for('reports/alldataoutputreport') ?>" method="post">
    <span ><?php echo $form['listReports']->renderLabel(); ?></span>
    <br/>
    <br/>
    <?php echo $form['listReports']->render(); ?>
    <br/>
    <br/>
    <br/>

    <span ><?php echo $form['ExportType']->renderLabel(); ?></span>
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