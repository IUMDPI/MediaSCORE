<?php
if ($sf_user->getGuardUser()->getType() != 3) {
    ?>
    <a class="button create_new_unit" href="<?php echo url_for('unit/new') ?>">Create Unit</a>
<?php } ?>
<?php include_partial('search', array('AllStorageLocations' => $AllStorageLocations)) ?>
<div id="filter-container">
    <div id="filter" class="Xhidden" style="display:none;"> <!-- toggle class "hidden" to show/hide -->
        <div class="title">Filter by:</div>
        <form id="filterUnits" action="">
            <strong>Text:</strong> <input type="text" class="text" onkeyup="filterUnits();" id="searchText"/>
            <strong>Date:</strong>
            <div class="filter-date">
                <select id="date_type" onchange="filterUnits();">
                    <option value="">Date Type</option>
                    <option value="0">Created On</option>
                    <option value="1">Updated On</option>
                </select>
                <input type="text" id="from" onchange="filterUnits();" readonly="readonly"/>
                to
                <input type="text" id="to" onchange="filterUnits();" readonly="readonly"/>
            </div>
            <strong>Status:</strong>
            <select id="filterStatus" onchange="filterUnits();">
                <option value="">Any Status</option>
                <option value="0">Incomplete</option>
                <option value="1">In Progress</option>
                <option value="2">Completed</option>
            </select>
            <br/>
            <br/>
            <strong>Score Type : </strong>
            <div class="filter-date">
                <select id="scoreType" onchange="filterUnits();">
                    <option value="score">MediaSCORE</option>
                    <option value="river">MediaRIVERS</option>
                </select>
                &nbsp;From <input type="text" class="text" onkeydown="filterUnits();" id="score_start"/>To &nbsp;
                <input type="text" class="text" onkeydown="filterUnits();" id="score_end"/>  
            </div>
        </form>
        <div class="reset"><a href="javascript:void(0);" onclick="resetFields('#filterUnits');"><span>R</span> Reset</a></div>
    </div>
</div> 
<div class="show-hide-filter"><a href="javascript:void(0)" onclick="filterToggle();" id="filter_text">Show Filter</a></div>
<div  style="margin: 10px; text-align: center;color: #7D110C;font-weight: bold;"><?php echo $deleteMessage; ?></div>
<table id="unitTable" class="tablesorter">
    <?php
    if (sizeof($units) > 0) {
        ?>
        <thead>
            <tr>
                <?php
                if ($sf_user->getGuardUser()->getType() != 3) {
                    ?>
                    <td width="50"></td>
                <?php } ?>
                <th><span>Unit</span></th>
                <th><span>Created</span></th>
                <th><span>Created By</span></th>
                <th><span>Updated On</span></th>
                <th><span>Updated By</span></th>
                <th style="text-align: center;" width="8.5%"><span>Duration</span></th>

            </tr>
        </thead>
        <tbody id="unitResult">
            <?php foreach ($units as $unit): ?>
                <?php 
                $duration = $unit->getDurationRealTime($unit->getId());
                ?>
                <tr>
                    <?php
                    if ($sf_user->getGuardUser()->getType() != 3) {
                        ?>
                        <td class="invisible">
                            <div class="options">
                                <a class="create_new_unit" href="<?php echo url_for('unit/edit?id=' . $unit->getId()) ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
                                <a href="#fancybox1" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getUnitID(<?php echo $unit->getId(); ?>)"/></a>
                            </div>
                        </td>
                    <?php } ?>
                    <td><a href="<?php echo url_for('collection', $unit) ?>"><?php echo $unit->getName() ?></a></td>
                    <td><?php echo date('Y-m-d', strtotime($unit->getCreatedAt())); ?></td>
                    <td><span style="display: none;"><?php echo $unit->getCreator()->getLastName() ?></span><?php echo '<span>' . $unit->getCreator()->getName(); ?></td>
                    <td><?php echo date('Y-m-d', strtotime($unit->getUpdatedAt())) ?></td>
                    <td><span style="display: none;"><?php echo $unit->getEditor()->getLastName() ?></span><?php echo $unit->getEditor()->getName(); ?></td>
                    <td style="display: none;"><span style="display: none;"><?php echo (int) minutesToHour::ConvertHoursToMin($duration); ?></span></td>
                    <td style="text-align: right;"><?php echo $duration; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <?php
    } else {
        echo '<tr><td>No Unit Available</td></tr>';
    }
    ?>
</table>
<script type="text/javascript">
    var userType = '<?php echo $sf_user->getGuardUser()->getType(); ?>';
    $(document).ready(function() {
        var dates = $("#from, #to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 2,
            'dateFormat': 'yy-mm-dd',
            onSelect: function(selectedDate) {
                filterUnits();
                var option = this.id == "from" ? "minDate" : "maxDate",
                instance = $(this).data("datepicker"),
                date = $.datepicker.parseDate(
                instance.settings.dateFormat ||
                    $.datepicker._defaults.dateFormat,
                selectedDate, instance.settings);
                dates.not(this).datepicker("option", option, date);
            }
        });
        $(".delete_unit").fancybox({
            'width': '100%',
            'height': '100%',
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut': 'none',
            'type': 'inline',
            'padding': 0,
            'showCloseButton': false

        });
        $(".create_new_unit").fancybox({
            'width': '100%',
            'height': '100%',
            'autoScale': true,
            'transitionIn': 'none',
            'transitionOut': 'none',
            'type': 'inline',
            'padding': 0,
            'showCloseButton': true

        });
        //        $("#unitTable").tablesorter({textExtraction: myTextExtraction}); 
        $("#unitTable").tablesorter();

    });

    var myTextExtraction = function(node)
    {
        console.log(node.childNodes[0].innerHTML);
        // extract data from markup and return it  
        //    return node.childNodes[0].childNodes[0].innerHTML; 
    }
    var filter = 1;
    var unitId = null;

    function getUnitID(id) {
        unitId = id;

    }
    function deleteUnit() {
        window.location.href = '/unit/delete?id=' + unitId;
    }
    function filterToggle() {
        $('#filter').slideToggle();
        if (filter == 0) {
            filter = 1;
            $('#filter_text').html('Show Filter');

        }
        else {
            $('#filter_text').html('Hide Filter');
            filter = 0;
        }


    }
    function resetFields(form) {
        form = $(form);
        form.find('input:text, input:password, input:file, select').val('');
        form.find('input:radio, input:checkbox')
        .removeAttr('checked').removeAttr('selected');
        filterUnits();
    }
    var Check = new Array();
    var i = 0;
    function filterUnits() {
        Check[i] = $.ajax({
            method: 'POST',
            url: '/index.php/unit/index',   //scoreType score_start score_end
            data: {s: $('#searchText').val(), status: $('#filterStatus').val(), from: $('#from').val(), to: $('#to').val(), datetype: $('#date_type').val(), scoreType: $('#scoreType').val(), score_start: $('#score_start').val(), score_end: $('#score_end').val()},
            dataType: 'json',
            cache: false,
            success: function(result) {
                if (result != undefined && result.length > 0) {
                    $('#unitResult').html('');
                    for (collection in result) {
                        editdelete = '';

                        if (userType != 3)
                            editdelete = '<td class="invisible">' +
                            '<div class="options">' +
                            '<a class="create_new_unit" href="/unit/edit/id/' + result[collection].id + '"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a> ' +
                            ' <a href="#fancybox1" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getUnitID(' + result[collection].id + ');"/></a>' +
                            '</div>' +
                            '</td>';
                        $('#unitResult').append('<tr>' +
                            editdelete +
                            '<td><a href="/' + result[collection].name_slug + '">' + result[collection].name + '</a></td>' +
                            '<td>' + result[collection].created_at + '</td>' +
                            '<td><span style="display: none;">' + result[collection].Creator.last_name + '</span>' + result[collection].Creator.first_name + ' ' + result[collection].Creator.last_name + '</td>' +
                            '<td>' + result[collection].updated_at + '</td>' +
                            '<td><span style="display: none;">' + result[collection].Editor.last_name + '</span>' + result[collection].Editor.first_name + ' ' + result[collection].Editor.last_name + '</td>' +
                            '<td style="text-align: right;">' + result[collection].duration + '</td>');
                        if (result[collection].StorageLocations[0]) {
                            //                            $('#unitResult').append('<td style="text-align: right;">'+result[collection].StorageLocations[0].resident_structure_description+'</td>'+'</tr>'); 
                        } else {
                            //                            $('#unitResult').append('<td style="text-align: right;"> None </td>'+'</tr>'); 
                        }
                    }
                    $(".delete_unit").fancybox({
                        'width': '100%',
                        'height': '100%',
                        'autoScale': false,
                        'transitionIn': 'none',
                        'transitionOut': 'none',
                        'type': 'inline',
                        'padding': 0,
                        'showCloseButton': false

                    });
                    $(".create_new_unit").fancybox({
                        'width': '100%',
                        'height': '100%',
                        'autoScale': true,
                        'transitionIn': 'none',
                        'transitionOut': 'none',
                        'type': 'inline',
                        'padding': 0,
                        'showCloseButton': true

                    });
                }
                else {
                    $('#unitResult').html('<tr><td colspan="6" style="text-align:center;">No Unit found</td></tr>');
                }
                $("#unitTable").trigger("update");

            }
        });
        for (j = 0; j <= (i - 1); j++) {
            Check[j].abort();
        }
        i++;

    }

</script>
<?php
if (sizeof($units) > 0) {
    ?>
    <div style="display: none;"> 
        <div id="fancybox1" style="background-color: #F4F4F4;width: 600px;" >
            <header>
                <h5  class="fancybox-heading">Warning!</h5>
            </header>
            <div style="margin: 10px;">
                <h3>Careful!</h3>
            </div>
            <div style="margin: 10px;font-size: 0.8em;">
                You are about to delete a Unit which will permanently erase all information associated with it.<br/>
                Are you sure you want to proceed?
            </div>
            <div style="margin: 10px;"><a class="button" href="javascript://" onclick="$.fancybox.close();">NO</a>&nbsp;&nbsp;&nbsp;<a  href="javascript:void(0);" onclick="deleteUnit();">YES</a></div>
        </div>
    </div>
<?php } ?>