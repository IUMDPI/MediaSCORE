
<style>
    .tooltip {outline:none; }
    .tooltip strong {line-height:30px;}
    .tooltip:hover {text-decoration:none;} 
    .tooltip span {
        z-index:10;display:none; padding: 10px 20px;
        margin-top: -3px; margin-left:5px;
        width:auto ;line-height:0px;
    }
    .tooltip:hover span{
        display:inline; position:absolute; color:#111;
        border:1px solid gray; background:#d8d8d8;
    }
    .callout {z-index:20;position:absolute;top:30px;border:0;left:-12px;}

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

    .long_name_handler{
        display:inline-block !important;
        white-space: nowrap !important;
        text-overflow: ellipsis !important;
        max-width:218px !important;
        height:12px !important;
        overflow:hidden !important;
        width: 218px !important;
        line-height: 10px !important;
    }
    .long_name_handler_inst{
        text-overflow: ellipsis !important;
        max-width: 130px !important;
        height: 10px !important;
        overflow: hidden !important;
        white-space: nowrap !important;
        width: 130px !important;
    }
</style>
<div id="search-box">
    <form action="<?php echo url_for('unit/search') ?>" method="post" onkeypress="return event.keyCode != 13;">
        <div class="search-input">

            <div id="token_string" style="float: left;">
                <?php
                if (count($searchString) > 0) {
                    foreach ($searchString as $key => $value) {
                        ?>
                        <div class="token" id="div_<?php echo $key + 1; ?>">
                            <span id="search_string_<?php echo $key + 1; ?>"><?php echo $value; ?></span>
                            <span> 
                                <a href="javascript:void(0);" onclick="removeTokenDiv(<?php echo $key + 1; ?>);">X</a>
                            </span>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <input type="hidden" id="search_values" name="search_values" value="<?php echo $searchValues; ?>"/>
            <input type="search" placeholder="Search all records" id="mainsearch" onkeyup="makeToken(event);"/>
            <div class="container">
                <a class="search-triangle" href="javascript:void(0);" onclick="$('.dropdown-container').slideToggle();
                    $('.dropdown-container').css('width', $('.search-input').width() + 26);"></a><b class="token-count"><?php echo count($searchString); ?></b>
                <a class="search-close" href="javascript:void(0);" onclick="removeAllTokenDivs();"></a>
            </div>

            <input class="button" type="submit" value="" />
            <div class="dropdown-container" style="height: 200px;overflow-y: scroll;display: none;">
                <div class="dropdown clearfix Xhidden">
                    <ul class="left-column">
                        <li><h1>Format</h1></li>
                        <?php
                        foreach (FormatType::$formatTypesValue as $formatTypeArray):
                            foreach ($formatTypeArray as $formatTypeModelName => $formatTypeStr):
                                ?>
                                <li><a id="type_<?php echo $formatTypeModelName ?>" value="<?php echo $formatTypeModelName ?>" onclick="makeTypeToken('<?php echo $formatTypeStr ?>');"><?php echo $formatTypeStr ?></a></li>

                                <?php
                            endforeach;
                        endforeach
                        ?>

                    </ul>

                    <ul class="right-column">
                        <li><h1>Type</h1></li>
                        <li><a href="javascript:void(0);" onclick="makeTypeToken(0);">Unit</a></li>
                        <li><a href="javascript:void(0);" onclick="makeTypeToken(1);">Collection</a></li>
                        <li><a href="javascript:void(0);" onclick="makeTypeToken(2);">Asset Group</a></li>
                    </ul>
                    <ul class="right-column"> 

                        <li><h1>Storage Location</h1></li>
                        <?php foreach ($AllStorageLocations as $StorageLoca): ?>
                            <li><a href="javascript:void(0);" onclick="makeTypeToken('<?php echo $StorageLoca['name'] ?>');"><?php echo $StorageLoca['name'] ?></a></li>
                        <?php endforeach
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="filter-container">
    <div id="filter" class="Xhidden" style="display:none;"> <!-- toggle class "hidden" to show/hide -->
        <div class="title">Filter by:</div>
        <form id="filterUnits" action="">
            <strong>Text:</strong> <input type="text" class="text" onkeyup="filterRecords();" id="searchText"/>
            <strong>Date:</strong>
            <div class="filter-date">
                <select id="date_type" onchange="filterRecords();">
                    <option value="">Date Type</option>
                    <option value="0">Created On</option>
                    <option value="1">Updated On</option>
                </select>
                <input type="text" id="from" onchange="filterRecords();" readonly="readonly"/>
                to
                <input type="text" id="to" onchange="filterRecords();" readonly="readonly"/>
            </div>
            <strong>Status:</strong>
            <select id="filterStatus" onchange="filterRecords();">
                <option value="">Any Status</option>
                <option value="0">Incomplete</option>
                <option value="1">In Progress</option>
                <option value="2">Completed</option>
            </select>
            <br/>
            <br/>
            <strong>Score Type : </strong>
            <div class="filter-date">
                <select id="scoreType" onchange="filterRecords();">
                    <option value="score">MediaSCORE</option>
                    <option value="river">MediaRIVERS</option>
                </select>
                &nbsp;From <input type="text" class="text" onkeydown="filterRecords();" id="score_start"/>To &nbsp;
                <input type="text" class="text" onkeydown="filterRecords();" id="score_end"/>  
            </div>

<!--            <strong>Score:</strong> <input type="text" name="searchScore" class="text" onkeyup="filterUnits();" id="searchScore"/>-->
        </form>
        <div class="reset"><a href="javascript:void(0);" onclick="resetFields('#filterUnits');"><span>R</span> Reset</a></div>
    </div>
</div> 
<div class="show-hide-filter"><a href="javascript:void(0)" onclick="filterToggle();" id="filter_text">Show Filter</a></div>
<div  style="margin: 10px; text-align: center;color: #7D110C;font-weight: bold;"><?php echo $deleteMessage; ?></div>

<table id="searchTable" class="tablesorter">
    <thead>
        <tr>
            <?php
            if ($sf_user->getGuardUser()->getType() != 3) {
                ?>
                <td width="50"></td>
            <?php } ?>
            <th><span>Title</span></th>
            <th><span>Created</span></th>
            <th><span>Created By</span></th>
            <th><span>Updated On</span></th>
            <th><span>Updated By</span></th>
            <th><span>Duration</span></th>
        </tr>
    </thead>
    <tbody id="unitResult">


        <?php
        if (isset($searchResult) && sizeof($searchResult) > 0) {
            ?>
            <?php
            foreach ($searchResult as $result):
                if ($result->getType() == 1) {
                    $text = 'Unit';
                    $urlOnName = url_for('collection', $result);
                    $urlonEdit = url_for('unit/edit?id=' . $result->getId());
                    $parentId = 0;
                    $duration = $result->getDurationRealTime($result->getId());
                }
                if ($result->getType() == 3) {
                    $text = 'Collection';
                    if ($result) {
                        $urlOnName = url_for('assetgroup', $result);
                    }

                    $urlonEdit = url_for('collection/edit?id=' . $result->getId()) . '/u/' . $result->getParentNodeId();
                    $context = sfContext::getInstance();
                    $user = $context->getUser()->getAttribute('view');
                    if ($user) {
                        if ($user['view'] == 'river') {
                            $urlonEdit .='/form/' . $user['view'];
                            $urlOnName = $urlonEdit;
                        }
                    }
                    $parentId = $result->getParentNodeId();
                    $duration = $result->getDurationRealTime($result->getId());
                }
                if ($result->getType() == 4) {
                    $text = 'Asset Group';
                    $urlOnName = '/assetgroup/edit/id/' . $result->getId() . '/c/' . $result->getParentNodeId();
                    $parentId = $result->getParentNodeId();
                    $duration = $result->getDurationRealTime($result->getFormatId());
                }
                ?>
                <tr>
                    <?php
                    if ($sf_user->getGuardUser()->getType() != 3) {
                        ?>
                        <td class="invisible">
                            <div class="options">
                                <?php
                                if ($result->getType() != 4) {
                                    ?>
                                    <a class="editModal" href="<?php echo $urlonEdit; ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
                                <?php } ?>
                                <a href="#fancyboxUCAG" class="delete_UCAG"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getID(<?php echo $result->getId(); ?>,<?php echo $result->getType(); ?>,<?php echo $parentId; ?>)"/></a>
                            </div>
                        </td>
                    <?php } ?>
                    <td ><a href="<?php echo $urlOnName; ?>" class="long_name_handler <?php echo ((int) strlen($result->getName())) >= 40 ? 'tooltip' : '' ?>"><?php echo substr($result->getName(), 0, 43) ?><span><?php echo ((int) strlen($result->getName())) >= 40 ? $result->getName() : ''; ?></span></a>&nbsp;&nbsp;<div class="help-text"><?php echo $text; ?></div></td>
                    <td><?php echo date('Y-d-m', strtotime($result->getCreatedAt())); ?></td>
                    <td> 
                        <?php echo '<span>' . $result->getCreator()->getName() . '</span>'; ?>
                    </td>
                    <td><?php echo date('Y-d-m', strtotime($result->getUpdatedAt())) ?></td>
                    <td>
                        <?php echo $result->getEditor()->getName(); ?>
                    </td>
                    <td>
                        <?php echo $duration; ?>
                    </td>


                </tr>
                <?php
            endforeach;
        }
        ?>
    </tbody>
    <?php ?>
</table>
<script type="text/javascript">
    var token = 0;
    var ucagId = null;

    $(document).ready(function() {
        $("#searchTable").tablesorter();
        var dates = $("#from, #to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 2,
            'dateFormat': 'yy-mm-dd',
            onSelect: function(selectedDate) {
                filterRecords();
                var option = this.id == "from" ? "minDate" : "maxDate",
                instance = $(this).data("datepicker"),
                date = $.datepicker.parseDate(
                instance.settings.dateFormat ||
                    $.datepicker._defaults.dateFormat,
                selectedDate, instance.settings);
                dates.not(this).datepicker("option", option, date);
            }
        });
        $(".delete_UCAG").fancybox({
            'width': '100%',
            'height': '100%',
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut': 'none',
            'type': 'inline',
            'padding': 0,
            'showCloseButton': false

        });
        $(".editModal").fancybox({
            'width': '100%',
            'height': '100%',
            'autoScale': true,
            'transitionIn': 'none',
            'transitionOut': 'none',
            'type': 'inline',
            'padding': 0,
            'showCloseButton': true

        });

    });

    token = '<?php echo count($searchString); ?>';
    token = parseInt(token);
    var removeToken = 0;
    var deletionType = null;
    var ParentDeletionId = null;
    function getID(id, type, parentId) {
        console.log(parentId);
        ParentDeletionId = parentId;
        ucagId = id;
        deleteType = type;
    }
    function deleteUCAG() {
        console.log(deleteType);
        if (deleteType == 1) {
            window.location.href = '/unit/delete?id=' + ucagId;
        }
        else if (deleteType == 3) {
            window.location.href = '/collection/delete?id=' + ucagId + '&u=' + ParentDeletionId;
        }
        else if (deleteType == 4) {
            window.location.href = '/assetgroup/delete?c=' + ParentDeletionId + '&id=' + ucagId;
        }
    }
    function makeToken(event) {
        if (event.keyCode == 13 && $('#mainsearch').val() != '') {
            token = token + 1;
            $('#token_string').append('<div class="token" id="div_' + token + '"><span id="search_string_' + token + '">' + $('#mainsearch').val() + '</span><span> <a href="javascript:void(0);" onclick="removeTokenDiv(' + token + ');">X</a></span></div>');
            getRecords();
            $('#mainsearch').val('');
            $('.dropdown-container').css('width', $('.search-input').width() + 26);
        }
        else if (event.keyCode == 8) {
            if ($('#mainsearch').val() == '' && token != 0) {
                if (removeToken == 1) {
                    $('.token').last().remove();
                    $('.dropdown-container').css('width', $('.search-input').width() + 26);
                    token = token - 1;
                    removeToken = 0;
                    getRecords();
                }
                else {
                    removeToken = 1;
                }
            }
        }
        if (token > 0) {
            $('.token-count').html(token);
            $('.search-close').show();
            $('.token-count').show();
        }
        else {
            $('.token-count').html(token);
            $('.search-close').hide();
            $('.token-count').hide();
        }
    }



    var Check = new Array();
    var i = 0;

    function filterRecords() {
        Check[i] = $.ajax({
            type: 'POST',
            url: '/frontend_dev.php/unit/search',
            data: {s: $('#searchText').val(), status: $('#filterStatus').val(), from: $('#from').val(), to: $('#to').val(), datetype: $('#date_type').val(), search_values: $('#search_values').val(), scoreType: $('#scoreType').val(), score_start: $('#score_start').val(), score_end: $('#score_end').val()},
            dataType: 'json',
            cache: false,
            success: function(result) {

                if (result != undefined && result.length > 0) {
                    console.log(result);
                    $('#unitResult').html(result);

                }
                else {
                    $('#unitResult').html('<tr><td colspan="6" style="text-align:center;">No record found.</td></tr>');
                }
                $("#unitTable").trigger("update");
                $(".delete_UCAG").fancybox({
                    'width': '100%',
                    'height': '100%',
                    'autoScale': false,
                    'transitionIn': 'none',
                    'transitionOut': 'none',
                    'type': 'inline',
                    'padding': 0,
                    'showCloseButton': false

                });
                $(".editModal").fancybox({
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
        });
        for (j = 0; j <= (i - 1); j++) {
            Check[j].abort();
        }
        i++;
    }

    function removeTokenDiv(id) {
        $('#div_' + id).remove();
        token = token - 1;
        getRecords();
        if (token > 0) {
            $('.token-count').html(token);
            $('.search-close').show();
            $('.token-count').show();
            $('.dropdown-container').css('width', $('.search-input').width() + 26);
        }
        else {
            $('.token-count').html(token);
            $('.search-close').hide();
            $('.token-count').hide();
        }
    }
    function removeAllTokenDivs() {
        $('.token').remove();
        token = 0;
        getRecords();
        $('.token-count').html(token);
        $('.search-close').hide();
        $('.token-count').hide();
        $('.dropdown-container').css('width', $('.search-input').width() + 26);


    }
    function makeTypeToken(type) {
        if (type == 0) {
            value = 'Unit';
        }
        else if (type == 1) {
            value = 'Collection';
        }
        else if (type == 2) {
            value = 'Asset Group';
        }
        else {
            value = type;
        }
        token = token + 1;
        $('#token_string').append('<div class="token" id="div_' + token + '"><span id="search_string_' + token + '">' + value + '</span><span> <a href="javascript:void(0);" onclick="removeTokenDiv(' + token + ');">X</a></span></div>');
        getRecords();
        $('.dropdown-container').css('width', $('.search-input').width() + 26);
        if (token > 0) {
            $('.token-count').html(token);
            $('.search-close').show();
            $('.token-count').show();

        }
        else {
            $('.token-count').html(token);
            $('.search-close').hide();
            $('.token-count').hide();
        }
    }
    function getRecords() {
        var search = new Array();
        count = 1;
        if (token > 0) {
            for (i = 1; i <= token; ) {
                if ($('#search_string_' + count).length > 0) {
                    search[i - 1] = $('#search_string_' + count).text();
                    i++;
                }
                count++;
            }
        }
        $('#search_values').val(search);
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
        filterRecords();
    }
</script>
<div style="display: none;"> 
    <div id="fancyboxUCAG" style="background-color: #F4F4F4;width: 600px;" >
        <header>
            <h5  class="fancybox-heading">Warning!</h5>
        </header>
        <div style="margin: 10px;">
            <h3>Careful!</h3>
        </div>
        <div style="margin: 10px;font-size: 0.8em;" id="msg_UCAG">
            You are about to delete a Unit which will permanently erase all information associated with it.<br/>
            Are you sure you want to proceed?
        </div>
        <div style="margin: 10px;"><a class="button" href="javascript://" onclick="$.fancybox.close();">NO</a>&nbsp;&nbsp;&nbsp;<a  href="javascript:void(0);" onclick="deleteUCAG();">YES</a></div>
    </div>
</div>