Problem  Media Report 
<br/>
<br/>
<?php
echo $NoRecordFound = get_slot('my_slot');
?>

<form action="<?php echo url_for('reports/problemmediareport') ?>" method="post">
    <?php echo $form['listCollection_RRD']->renderLabel(); ?>
    <br/>
    <br/>
    <?php echo $form['listCollection_RRD']->render(); ?>
    <br/>
    <br/>
    <br/>
    <?php echo $form['Constraints']->renderLabel(); ?>
    <br/>
    <br/>
    <?php echo $form['Constraints']->render(); ?>
    <br/>
    <br/>
    <br/>

    <?php echo $form['ExportType']->renderLabel(); ?>
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
    $('#reports_Constraints').multiselect({
        'height':'auto',
        'multiple':true
    });
  
</script>