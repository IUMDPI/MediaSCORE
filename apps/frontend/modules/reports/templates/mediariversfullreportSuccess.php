<h1>MediaRIVERS Full Report</h1>
<hr/>
<?php
echo $NoRecordFound = get_slot('my_slot');
?>

<form action="<?php echo url_for('reports/mediariversfullreport') ?>" method="post">
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
                    <?php echo $form['listUnits_RRD']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['listUnits_RRD']->render(); ?>
                    <?php echo $form['listUnits_RRD']->renderError(); ?>
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo $form['listCollection_RRD']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['listCollection_RRD']->render(array('style'=>'max-width:600px;')); ?>
                    <?php echo $form['listCollection_RRD']->renderError(); ?>
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
    $('#reports_listUnits_RRD').multiselect({
        height: '200',
        multiple: true
    });
    $('#reports_listCollection_RRD').multiselect({
        height: '180',
        multiple: true

    });

    $('#reports_collectionStatus').multiselect({
        height: 'auto',
        multiple: true
    });
    if ($('#reports_listUnits_RRD').val() == '' || $('#reports_listUnits_RRD').val() == null) {
        $("#reports_listCollection_RRD").multiselect("disable");
        $("#reports_collectionStatus").multiselect("disable");
    }
    else
        getCollections($('#reports_listUnits_RRD').val());
    if ($('#reports_listCollection_RRD').val() != '' || $('#reports_listCollection_RRD').val() != null)
        getCollectionStatus($('#reports_listCollection_RRD').val());
    $("#reports_listUnits_RRD").bind("multiselectclick multiselectcheckall multiselectuncheckall", function(event, ui) {
        var array_of_checked_values = $("#reports_listUnits_RRD").multiselect("getChecked").map(function() {
            return this.value;
        }).get();
        getCollections(array_of_checked_values);

    });
    $("#reports_listCollection_RRD").bind("multiselectclick multiselectcheckall multiselectuncheckall", function(event, ui) {
        var array_of_checked_values = $("#reports_listCollection_RRD").multiselect("getChecked").map(function() {
            return this.value;
        }).get();
        getCollectionStatus(array_of_checked_values);

    });
    function getCollectionStatus(ids) {
        $.ajax({
            method: 'POST',
            url: '/reports/getUnitCollections?c=' + ids,
            dataType: 'json',
            cache: false,
            success: function(result) {
                $('#reports_collectionStatus').html('');

                for (cnt in result.status) {
                    $('#reports_collectionStatus').append('<option value="' + cnt + '">' + result.status[cnt] + '</option>');
                }
                $("#reports_collectionStatus").multiselect("destroy");
                $("#reports_collectionStatus").multiselect("refresh");

                $('#reports_collectionStatus').multiselect({
                    height: 'auto',
                    multiple: true
                });

                if (Object.keys(result.status).length > 0)
                    $("#reports_collectionStatus").multiselect("enable");
            }
        });
    }
    function getCollections(ids) {
        $("#reports_listCollection_RRD").multiselect("disable");
        $("#reports_collectionStatus").multiselect("disable");
        $.ajax({
            method: 'POST',
            url: '/reports/getUnitCollections?u=' + ids,
            dataType: 'json',
            cache: false,
            success: function(result) {
                $('#reports_listCollection_RRD').html('');
                $('#reports_collectionStatus').html('');
                for (cnt in result.collections) {
                    $('#reports_listCollection_RRD').append('<option value="' + result.collections[cnt].id + '">' + result.collections[cnt].name + '</option>');
                }
                for (cnt in result.status) {
                    $('#reports_collectionStatus').append('<option value="' + cnt + '">' + result.status[cnt] + '</option>');
                }
                $("#reports_listCollection_RRD,#reports_collectionStatus").multiselect("destroy");
                $("#reports_listCollection_RRD,#reports_collectionStatus").multiselect("refresh");
                $('#reports_listCollection_RRD').multiselect({
                    height: '180',
                    multiple: true
                });
                $('#reports_collectionStatus').multiselect({
                    height: 'auto',
                    multiple: true
                });
                if (result.collections.length > 0)
                    $("#reports_listCollection_RRD").multiselect("enable");
                if (Object.keys(result.status).length > 0)
                    $("#reports_collectionStatus").multiselect("enable");
            }
        });
    }
</script>


<script type="text/javascript">

    $(document).ready(function() {
        var dates = $("#reports_EvaluatorsStartDate").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            'dateFormat': 'yy-mm-dd',
            minDate: $("#date_depart").val(),
            onSelect: function(selectedDate) {
                $("#reports_EvaluatorsStartDate").datepicker('hide');
            }
        });

        var dates = $("#reports_EvaluatorsEndDate").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            'dateFormat': 'yy-mm-dd',
            onSelect: function(selectedDate) {
                //				if ((new Date($("#reports_EvaluatorsStartDate").val()).getTime() > new Date($("#reports_EvaluatorsEndDate").val()).getTime())) {
                //					alert('End Date cannot be less then Start Date');
                //					$("#reports_EvaluatorsEndDate").val('');
                //				} else {
                //					$("#reports_EvaluatorsEndDate").datepicker('hide');
                //				}
                $("#reports_EvaluatorsEndDate").datepicker('hide');
            }
        });


    });
</script>