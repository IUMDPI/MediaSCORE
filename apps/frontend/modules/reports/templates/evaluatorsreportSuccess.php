
All Data Output Report
<br/><br/>
<?php
echo $NoRecordFound = get_slot('my_slot');
?>

<form action="<?php echo url_for('reports/evaluatorsreport') ?>" method="post">
    <span style="font-weight: bold;" ><?php echo $form['ListEvaluators']->renderLabel(); ?></span>
    <br/>
    <br/>
    <?php echo $form['ListEvaluators']->render(); ?>
    <br/>
    <br/>
    <br/>
    <span style="font-weight: bold;" ><?php echo $form['format_id']->renderLabel(); ?></span>
    <br/>
    <br/>
    <?php echo $form['format_id']->render(); ?>
    <br/>
    <br/>
    <br/>

    <span style="font-weight:bold;"><?php echo $form['EvaluatorsStartDate']->renderLabel(); ?></span>
    <br/>
    <br/>
    <?php echo $form['EvaluatorsStartDate']->render(); ?>
    <br/>
    <br/>
    <br/>

    <span style="font-weight: bold;"><?php echo $form['EvaluatorsEndDate']->renderLabel(); ?></span>
    <br/>
    <br/>
    <?php echo $form['EvaluatorsEndDate']->render(); ?>
    <br/>
    <br/>
    <br/>

    <span style="font-weight: bold;"><?php echo $form['ExportType']->renderLabel(); ?></span>
    <br/>
    <br/>
    <?php echo $form['ExportType']->render(); ?>
    <br/>
    <br/>

    <br/>
    <input type="submit" value="Export" />


</form>
<script type="text/javascript">

    $(document).ready(function() {
        $( "#reports_EvaluatorsStartDate" ).attr('readonly','readonly');
        $( "#reports_EvaluatorsEndDate" ).attr('readonly','readonly');
        $( "#reports_EvaluatorsStartDate" ).attr('style','background:#d7d7d2;');
        $( "#reports_EvaluatorsEndDate" ).attr('style','background:#d7d7d2;');
        var dates = $( "#reports_EvaluatorsStartDate" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 2,
            'dateFormat':'yy-mm-dd',
            minDate: $("#date_depart").val(),
            onSelect: function( selectedDate ) {
                $( "#reports_EvaluatorsStartDate" ).datepicker('hide');
            }
        });
        var dates = $( "#reports_EvaluatorsEndDate" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 2,
            'dateFormat':'yy-mm-dd',
            onSelect: function( selectedDate ) {
                if((new Date($("#reports_EvaluatorsStartDate").val()).getTime() > new Date($( "#reports_EvaluatorsEndDate" ).val()).getTime())){
                    alert('End Date cannot be less then Start Date');
                    $("#reports_EvaluatorsEndDate").val('');
                }else{
                    $( "#reports_EvaluatorsEndDate" ).datepicker('hide');
                }
            }
        });
        $('#reports_format_id').multiselect({
            'height':'auto',
            'multiple':true,
            'height':200
        });
        $('#reports_format_id .ui-multiselect').css('width', '400px');
       
    });
</script>