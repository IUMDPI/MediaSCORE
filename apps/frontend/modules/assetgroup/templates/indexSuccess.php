<?php
if ($sf_user->getGuardUser()->getType() != 3) {
    ?>
    <a class="button" href="<?php echo url_for('assetgroup/new?c=' . $collectionID) ?>">Create Asset Group</a>
<?php } ?>
<?php include_partial('unit/search', array('AllStorageLocations' => $AllStorageLocations)) ?>
<div id="filter-container">
    <div id="filter" class="Xhidden" style="display:none;"> <!-- toggle class "hidden" to show/hide -->
        <div class="title">Filter by:</div>
        <form id="filterAssets" action="">
            <strong>Text:</strong> <input type="text" class="text" onkeyup="filterAssets();" id="searchText"/>
            <strong>Date:</strong>
            <div class="filter-date">
                <select id="date_type" onchange="filterAssets();">
                    <option value="">Date Type</option>
                    <option value="0">Created On</option>
                    <option value="1">Updated On</option>
                </select>
                <input type="text" id="from" onkeyup="filterAssets();" readonly="readonly"/>
                to
                <input type="text" id="to" onkeyup="filterAssets();" readonly="readonly"/>
            </div>
            <strong>Status:</strong>
            <select id="filterStatus" onchange="filterAssets();">
                <option value="">Any Status</option>
                <option value="0">Incomplete</option>
                <option value="1">In Progress</option>
                <option value="2">Completed</option>
            </select>


            <br/> 
            <br/> 
            <strong>Score Type : </strong>
            <div class="filter-date">
                <select id="scoreType" onchange="filterAssets();">
                    <option value="score">MediaSCORE</option>
                </select>
                &nbsp;From <input type="text" class="text" onkeyup="filterAssets();" id="score_start"/>To &nbsp;
                <input type="text" class="text" onkeyup="filterAssets();" id="score_end"/>  
            </div>
        </form>
        <div class="reset"><a href="javascript:void(0);" onclick="resetFields('#filterAssets');"><span>R</span> Reset</a></div>
    </div>
</div> 
<div class="show-hide-filter"><a href="javascript:void(0)" onclick="filterToggle();" id="filter_text">Show Filter</a></div> 
<div class="breadcrumb small"><a href="<?php echo url_for('unit/index') ?>">All Units</a>&nbsp;&gt;&nbsp;<a href="<?php echo url_for('collection', $unit) ?>"><?php echo $unitName ?></a>&nbsp;&gt;&nbsp;<?php echo $collectionName ?></div>
<?php
?>
<table id="assetGroupTable" class="tablesorter">
    <thead>
        <tr>
            <?php
            if ($sf_user->getGuardUser()->getType() != 3) {
                ?>
                <td width="30"></td>
            <?php } ?>
            <th>Asset Groups</th>
            <th>Created</th>
            <th>Created By</th>
            <th>Updated On</th>
            <th>Updated By</th> 
            <th width="10%" style="text-align: center;">Duration</th>
            <th width="6%">Score:</th>

        </tr>
    </thead>
    <tbody id="assetsResult">

        <?php foreach ($asset_groups as $asset_group): ?>
            <tr>
                <?php
                if ($sf_user->getGuardUser()->getType() != 3) {
                    ?>
                    <td class="invisible">
                        <div class="options">
                            <a href="#fancyboxAsset" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getAssetID(<?php echo $asset_group->getId(); ?>)"/></a>
                        </div>
                    </td>
                <?php }
                ?>
                <?php
                $getName = $asset_group->getName();
                $lenthName = strlen($getName);
                $alterName = $getName;

                $morethenlengthName = FALSE;

                if ((int) $lenthName > 35) {
                    
                    $alterName = (substr($alterName, 0, 35). '...');
                    
                    $morethenlengthName = TRUE;
                }
                ?>
                <td  <?php echo (($morethenlengthName) ? 'class="long_name_handler tooltip"' : 'class="long_name_handler"'); ?> ><span style="display: none;"><?php echo $asset_group->getName() ?></span><a href="<?php echo url_for('assetgroup/edit?id=' . $asset_group->getId() . '&c=' . $collectionID) ?>"> <?php echo $alterName ?>  
                        <?php echo ($morethenlengthName ? '<span>' . $getName . '</span>' : ''); ?></a></td>
                <td><span style="display: none;"><?php echo $asset_group->getCreatedAt(); ?></span><?php echo date('Y-m-d', strtotime($asset_group->getCreatedAt())); ?></td>
                <td><span style="display: none;"><?php echo $asset_group->getCreator()->getLastName() ?></span><?php echo $asset_group->getCreator()->getName() ?></td>
                <td><span style="display: none;"><?php echo $asset_group->getUpdatedAt(); ?></span><?php echo date('Y-m-d', strtotime($asset_group->getUpdatedAt())); ?></td>
                <td><span style="display: none;"><?php echo $asset_group->getEditor()->getLastName() ?></span><?php echo $asset_group->getEditor()->getName() ?></td>
                <td style="text-align: right;"><span style="display: none;" ><?php echo (int) minutesToHour::ConvertHoursToMin($asset_group->getDuration($asset_group->getFormatId())); ?></span><?php echo $asset_group->getDurationRealTime($asset_group->getFormatId()) ?></td>
                <?php
                $score = '0.0';
                if ($asset_group->getFormatType()->getAssetScore() != '')
                    $score = $asset_group->getFormatType()->getAssetScore();
                if ($sf_user->getGuardUser()->getId() == 1) {
                    ?>
                    <td style="text-align: right;"><span style="display:none;"><?php echo $score; ?></span><a target="_blank" href="<?php echo url_for('assetgroup/getScore?id=' . $asset_group->getId()); ?>"><?php echo $score; ?></a></td>
                    <?php
                } else {
                    ?>
                    <td style="text-align: right;"><span style="display:none;"><?php echo $score; ?></span><?php echo ($score != '') ? $score : '0'; ?></td>
                <?php } ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<script type="text/javascript">
    var userType = '<?php echo $sf_user->getGuardUser()->getType(); ?>';
    var myTextExtraction = function(node)  
    {  
        // extract data from markup and return it  
        //        console.log(node.childNodes[0].innerHTML);
        return node.childNodes[0].innerHTML; 
    } 
    $(document).ready(function() {
        var dates = $("#from, #to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 2,
            'dateFormat': 'yy-mm-dd',
            onSelect: function(selectedDate) {
                filterAssets();
                var option = this.id == "from" ? "minDate" : "maxDate",
                instance = $(this).data("datepicker"),
                date = $.datepicker.parseDate(
                instance.settings.dateFormat ||
                    $.datepicker._defaults.dateFormat,
                selectedDate, instance.settings);
                dates.not(this).datepicker("option", option, date);
            }
        });
        $("#assetGroupTable").tablesorter( {textExtraction: myTextExtraction});
					
					
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

    });
    var filter = 1;
    var assetId = null;

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
    function getAssetID(id) {
        assetId = id;

    }
    function deleteAsset(collection) {
        window.location.href = '/assetgroup/delete?c=' + collection + '&id=' + assetId;
    }
    function resetFields(form) {
        form = $(form);
        form.find('input:text, input:password, input:file, select').val('');
        form.find('input:radio, input:checkbox')
        .removeAttr('checked').removeAttr('selected');
        filterAssets();
    }
    function removeSearchText() {

    }
    var Check = new Array();
    var i = 0;

    function filterAssets() {
        collectionID = '<?php echo $collectionID; ?>';
        Check[i] = $.ajax({
            type: 'POST',
            url: '/index.php/assetgroup/index',
            data: {c: '<?php echo $collectionID; ?>', s: $('#searchText').val(), status: $('#filterStatus').val(), from: $('#from').val(), to: $('#to').val(), datetype: $('#date_type').val(), searchScore: $('#searchScore').val(), searchStorageLocation: $('#searchStorageLocation').val(), scoreType: $('#scoreType').val(), score_start: $('#score_start').val(), score_end: $('#score_end').val()},
            dataType: 'json',
            cache: false,
            success: function(result) {
                if (result != undefined && result.length > 0) {
                    $('#assetsResult').html('');
                    for (collection in result) {
                        editdelete = '';
                        if (userType != 3) {
                            editdelete = '<td class="invisible">' +
                                '<div class="options">' +
                                ' <a href="#fancyboxAsset" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getAssetID(' + result[collection].id + ');"/></a>' +
                                '</div>' +
                                '</td>';
                        }
                        Created_at = result[collection].created_at.split(' ');
                        Updated_at = result[collection].updated_at.split(' ');
                        $('#assetsResult').append('<tr>' + editdelete +
                            '<td><span style="display: none;">' + result[collection].name + '</span><a href="/assetgroup/edit/id/' + result[collection].id + '/c/' + collectionID + '">' + result[collection].name + '</a></td>' +
                            '<td><span style="display: none;">' + result[collection].created_at + '</span>' + Created_at[0] + '</td>' +
                            '<td><span style="display: none;">'+result[collection].Creator.last_name+'</span>' + result[collection].Creator.first_name +' '+ result[collection].Creator.last_name + '</td>' +
                            '<td><span style="display: none;">' + result[collection].updated_at + '</span>' + Updated_at[0] + '</td>' +
                            '<td><span style="display: none;">'+result[collection].Editor.last_name+'</span>' + result[collection].Editor.first_name +' '+ result[collection].Editor.last_name + '</td>' +
                            '<td style="text-align: right;"><span style="display: none;">' + result[collection].duration + '</span>' + result[collection].duration + '</td>' +
                            '<td style="text-align: right;"><span style="display: none;">' + result[collection].FormatType.asset_score + '</span>' + result[collection].FormatType.asset_score + '</td>' +
                            '</tr>');
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

                }
                else {
                    $('#assetsResult').html('<tr><td colspan="6" style="text-align:center;">No Asset Group found</td></tr>');
                }

                $("#assetGroupTable").trigger("update");

            }
        });
        for (j = 0; j <= (i - 1); j++) {
            Check[j].abort();
        }
        i++;
    }
 
</script>
<style>
    .long_name_handler{
        display:inline-block !important;
        /*white-space: nowrap !important;*/
        text-overflow: ellipsis !important;
        max-width:230px !important;
        height:10px !important;
        overflow:hidden !important;
        width: 230px !important;
    }

    .tooltip {outline:none; }
    .tooltip strong {line-height:30px;}
    .tooltip:hover {text-decoration:none;} 
    .tooltip span {
        z-index:10;display:none; padding: 10px 20px;
        margin-top: -3px; margin-left:5px;
        width:auto ;line-height:0px;
    }
    .tooltip:hover span{
        display:inline; 
        position:absolute; 
        color:#111;
        border:1px solid gray; 
        background:#d8d8d8;
    }
    .callout {
        z-index:20;
        position:absolute;
        top:30px;
        border:0;
        left:-12px;
    }

    /*CSS3 extras*/
    .tooltip span
    {
        border-radius:4px;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;

        -moz-box-shadow: 5px 5px 8px #CCC;
        -webkit-box-shadow: 5px 5px 8px #CCC;
        box-shadow: 5px 5px 8px #CCC;
    }

</style>
<?php
if (sizeof($asset_groups) > 0) {
    ?>
    <div style="display: none;"> 
        <div id="fancyboxAsset" style="background-color: #F4F4F4;width: 600px;" >
            <header>
                <h5  class="fancybox-heading">Warning!</h5>
            </header>
            <div style="margin: 10px;">
                <h3>Careful!</h3>
            </div>
            <div style="margin: 10px;font-size: 0.8em;">
                You are about to delete a Asset Group which will permanently erase all information associated with it.<br/>
                Are you sure you want to proceed?
            </div>
            <div style="margin: 10px;"><a class="button" href="javascript://" onclick="$.fancybox.close();">NO</a>&nbsp;&nbsp;&nbsp;<a id="deleteAsset" href="javascript:void(0);" onclick="deleteAsset(<?php echo $collectionID; ?>)">YES</a></div>
        </div>
    </div>
<?php } ?>
