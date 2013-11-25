<h1>Problem  Media Report</h1>
<hr/>
<?php
echo $NoRecordFound = get_slot('my_slot');
?>

<form action="<?php echo url_for('reports/problemmediareport') ?>" method="post">
    <table>

        <tfoot>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Export" />&nbsp;<span>or</span>&nbsp;<a href="<?php echo url_for('reports/index') ?>">Cancel</a>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <tr> 
                <th>
                    <?php echo $form->renderHiddenFields(); ?>
                    <?php echo $form['listCollection_RRD']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['listCollection_RRD']->render(); ?>
                    <?php echo $form['listCollection_RRD']->renderError(); ?>
                </td>
            </tr>
            <tr>
                <th>

                    <?php echo $form['Constraints']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['Constraints']->render(); ?>
                    <?php echo $form['Constraints']->renderError(); ?>
                </td>
            </tr>
            <tr>
                <th>

                    <?php echo $form['ExportType']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['ExportType']->render(); ?>
                    <?php echo $form['ExportType']->renderError(); ?>
                </td>
            </tr>
        </tbody>
    </table>
</form>

<script type="text/javascript">

    $('#reports_listCollection_RRD').multiselect({
        multiple: true,
        height: 200

    });
    $('#reports_Constraints').multiselect({
        height: 'auto',
        multiple: true,
    });
    if ($('#reports_listCollection_RRD').val() == '' || $('#reports_listCollection_RRD').val() == null)
        $("#reports_Constraints").multiselect("disable");
    else
        getCollectionsProblems($('#reports_listCollection_RRD').val());
    $("#reports_listCollection_RRD").bind("multiselectclick multiselectcheckall multiselectuncheckall", function(event, ui) {
        var array_of_checked_values = $("#reports_listCollection_RRD").multiselect("getChecked").map(function() {
            return this.value;
        }).get();

        getCollectionsProblems(array_of_checked_values);

    });
    
    var allCollectionsProblem=[];
    var allCollectionsProblemcount =0;
    function getCollectionsProblems(ids) {
        $("#reports_Constraints").multiselect("disable");
        
        //Aborting previous ajax call before sending a new ajax calls
        if(typeof allCollectionsProblem != undefined && parseInt(allCollectionsProblem.length) > 0){
            $.each(allCollectionsProblem, function(index,oneajaxcall){
                if(typeof oneajaxcall != undefined)
                    oneajaxcall.abort(); 
            });
            allCollectionsProblem=[];
        }
                
        allCollectionsProblem[allCollectionsProblemcount] = $.ajax({
            method: 'POST',
            url: '/frontend_dev.php/reports/getCollectionProblems?c=' + ids,
            dataType: 'json',
            cache: false,
            success: function(result) {
                $('#reports_Constraints').html('');
                for (cnt in result) {

                    $('#reports_Constraints').append('<option value="' + cnt + '">' + result[cnt] + '</option>');
                }
                $("#reports_Constraints").multiselect("destroy");
                $("#reports_Constraints").multiselect("refresh");

                $('#reports_Constraints').multiselect({
                    height: 'auto',
                    multiple: true
                });

                if (Object.keys(result).length > 0)
                    $("#reports_Constraints").multiselect("enable");
            }
        });
        allCollectionsProblemcount++;
    }
</script>