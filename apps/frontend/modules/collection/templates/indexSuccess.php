<?php
if ($sf_user->getGuardUser()->getType() != 3) {
    ?>
    <!--new_edit_collection-->
    <a class="button" href="<?php echo url_for('collection/new?u=' . $unitID) ?>">Create Collection</a>
<?php } ?>

<?php
if (!isset($view) || $view == '')
    $view = 'score';
include_partial('unit/search', array('AllStorageLocations' => $AllStorageLocations));
?>

<div style="width: 100%;margin: 0 auto;padding: 10px 0 4px;">
    <ul class="tabs" data-persist="true">
        <li><a class='<?php echo (isset($view) && $view == 'score' ) ? 'SelectTabClass' : ((!isset($view)) || ($view == '' ) ? 'SelectTabClass' : '') ?>' onclick='toScore("<?php echo $url; ?>","<?php echo $unitID; ?>")' href="javascript:void(0);" id="mediascoresView">Media Score</a></li>
        <?php $url = url_for('collection', $ThisUnit); ?>
        <li><a  class='<?php echo (isset($view) && $view == 'river') ? 'SelectTabClass' : 'none'; ?>' onclick='toRiver("<?php echo $url; ?>","<?php echo $unitID; ?>")' href="javascript:void(0);" id="mediariversView" >Media Rivers</a></li>
    </ul>
    <div class="tabcontents">
        <input type="hidden"
               <div id="view1">
            <div id="filter-container">
                <div id="filter" class="Xhidden" style="display:none;"> <!-- toggle class "hidden" to show/hide -->
                    <div class="title">Filter by:</div>
                    <form id="filterCollection" action="<?php echo url_for('collection/index') ?>">
                        <strong>Text:</strong> <input type="text" class="text" onkeyup="filterCollection();" id="searchText"/>
                        <strong>Date:</strong>
                        <div class="filter-date">
                            <select id="date_type" onchange="filterCollection();">
                                <option value="">Date Type</option>
                                <option value="0">Created On</option>
                                <option value="1">Updated On</option>
                            </select>
                            <input type="text" id="from" onchange="filterCollection();" readonly="readonly"/>
                            to
                            <input type="text" id="to" onchange="filterCollection();" readonly="readonly"/>
                        </div>

                        <strong>Status:</strong>
                        <select id="filterStatus" onchange="filterCollection();">
                            <option value="">Any Status</option>
                            <option value="0">Incomplete</option>
                            <option value="1">In Progress</option>
                            <option value="2">Completed</option>
                        </select>
                        <strong>Score </strong>
                        <input type="text" class="text" onkeyup="filterCollection();" id="score"/> 
                        <br/>
                        <br/>

                    </form>
                    <div class="reset"><a href="javascript:void(0);" onclick="resetFields('#filterCollection');"><span>R</span> Reset</a></div>
                </div>
            </div> 
            <div class="show-hide-filter"><a href="javascript:void(0)" onclick="filterToggle();" id="filter_text">Show Filter</a></div> 
            <div class="breadcrumb small"><a href="<?php echo url_for('unit/index') ?>">All Units</a>&nbsp;&gt;&nbsp;<?php echo $unitName ?></div>
            <div  style="margin: 10px; text-align: center;color: #7D110C;font-weight: bold;"><?php echo $deleteMessage; ?></div>
            <table id="collectionTable" class="tablesorter">

                <thead>
                    <tr>
                        <?php if ($sf_user->getGuardUser()->getType() != 3) { ?>
                            <td width="50"></td>
                        <?php } ?>
                        <th>Primary ID</th>
                        <th>Collection</th>
                        <th>Created</th>
                        <th>Created By</th>
                        <th>Updated On</th>
                        <th>Updated By</th>
                        <th style="text-align: center;">Duration</th>
            <!--            <th style="text-align: center;">Storage Location</th>-->
            <!--            <th></th>-->
                    </tr>
                </thead>
                <tbody id="collectionResult">
                    <?php if (sizeof($collections) > 0) {
                        ?>
                        <?php foreach ($collections as $collection): ?>
                            <tr>
                                <?php
                                if ($sf_user->getGuardUser()->getType() != 3) {
                                    ?>
                                    <td class="invisible">
                                        <div class="options">
                                            <!--                                            new_edit_collection-->
                                            <a  class="" href="<?php echo url_for('collection/edit?id=' . $collection->getId()) . '/u/' . $collection->getParentNodeId() ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
                                            <a href="#fancybox" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getCollectionId(<?php echo $collection->getId(); ?>);"/></a>
                                        </div>
                                    </td>
                                <?php } ?>
                                <td><a href="<?php echo url_for('assetgroup', $collection) ?>"><?php echo $collection->getInstId() ?></a></td>
                                <td><a href="<?php echo url_for('assetgroup', $collection) ?>"><?php echo $collection->getName() ?></a></td>
                                <td><?php echo $collection->getCreatedAt() ?></td>
                                <td><span style="display: none;"><?php echo $collection->getCreator()->getLastName() ?></span><?php echo $collection->getCreator()->getName() ?></td>
                                <td><?php echo $collection->getUpdatedAt() ?></td>
                                <td><span style="display: none;"><?php echo $collection->getEditor()->getLastName() ?></span><?php echo $collection->getEditor()->getName() ?></td>
                                <td style="display: none;"><span style="display: none;"><?php echo (int) minutesToHour::ConvertHoursToMin($collection->getDuration($collection->getId())); ?></span></td>
                                <td style="text-align: right;"><?php echo $collection->getDuration($collection->getId()) ?></td>
                                <?php // $storagelocationCol = $collection->getStorageLocations()        ?>
                    <!--                    <td style="text-align: right;"><?php // echo $storagelocationCol[0]->getResidentStructureDescription();                                                                                                               ?></td>-->
                            </tr>
                        <?php endforeach; ?>

                        <?php
                    } else {
                        echo '<tr><td>No Collection Available</td></tr>';
                    }
                    ?>
                </tbody>

            </table>

        </div>
        <div id="view2">
        </div>

    </div>
</div>

<script type="text/javascript">
    var userType = '<?php echo $sf_user->getGuardUser()->getType(); ?>';
    $(document).ready(function() {
        var dates = $("#from, #to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 2,
            'dateFormat': 'yy-mm-dd',
            onSelect: function(selectedDate) {
                filterCollection();
                var option = this.id == "from" ? "minDate" : "maxDate",
                instance = $(this).data("datepicker"),
                date = $.datepicker.parseDate(
                instance.settings.dateFormat ||
                    $.datepicker._defaults.dateFormat,
                selectedDate, instance.settings);
                dates.not(this).datepicker("option", option, date);
            }
        });
        $("#collectionTable").tablesorter();

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
        $(".new_edit_collection").fancybox({
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
    var filter = 1;
    var collectionId = null;

    var unit_slug_name = '<?php echo $unitObject->getNameSlug(); ?>';
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
    function getCollectionId(id) {
        collectionId = id;
    }
    function deleteCollection(unit) {
        window.location.href = '/collection/delete?id=' + collectionId + '&u=' + unit;
    }
    function resetFields(form) {
        form = $(form);
        form.find('input:text, input:password, input:file, select').val('');
        form.find('input:radio, input:checkbox')
        .removeAttr('checked').removeAttr('selected');
        filterCollection();
    }
    function removeSearchText() {

    }
    var Check = new Array();
    var i = 0;
    function filterCollection() {
        unitId = '<?php echo $unitID; ?>';

        Check[i] = $.ajax({
            type: 'POST',
            url: '/frontend_dev.php/collection/index',
            data: {id: '<?php echo $unitID; ?>', s: $('#searchText').val(), status: $('#filterStatus').val(), from: $('#from').val(), to: $('#to').val(), datetype: $('#date_type').val(), score: $('#score').val()},
            dataType: 'json',
            cache: false,
            success: function(result) {

                if (result != undefined && result.length > 0) {
                    $('#collectionResult').html('');
                    for (collection in result) {
                        editdelete = '';
                        if(userType!=3){
                            editdelete='<td class="invisible">' +
                                '<div class="options">' +
                                '<a class="new_edit_collection" href="/collection/edit/id/' + result[collection].id + '/u/' + unitId + '"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a> ' +
                                ' <a href="#fancybox" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getCollectionId(' + result[collection].id + ');"/></a>' +
                                '</div></td>';
                        }
                        $('#collectionResult').append('<tr>'+ editdelete +
                            '<td><a href="/' + unit_slug_name + '/' + result[collection].name_slug + '/">' + result[collection].inst_id + '</a></td>' +
                            '<td><a href="/' + unit_slug_name + '/' + result[collection].name_slug + '/">' + result[collection].name + '</a></td>' +
                            '<td>' + result[collection].created_at + '</td>' +
                            '<td><span style="display: none;">' + result[collection].Creator.last_name + '</span>' + result[collection].Creator.first_name + result[collection].Creator.last_name + '</td>' +
                            '<td>' + result[collection].updated_at + '</td>' +
                            '<td><span style="display: none;">' + result[collection].Editor.last_name + '</span>' + result[collection].Editor.first_name + result[collection].Editor.last_name + '</td>' +
                            '<td style="text-align: right;">' + result[collection].duration + '</td>');
                        if (result[collection].StorageLocations[0]) {
                            //                            $('#collectionResult').append('<td>'+result[collection].StorageLocations[0].resident_structure_description+'</td></tr>'); 
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
                    $(".new_edit_collection").fancybox({
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
                    $('#collectionResult').html('<tr><td colspan="6" style="text-align:center;">No Collection found</td></tr>');
                }

                $("#collectionTable").trigger("update");

            }
        });
        for (j = 0; j <= (i - 1); j++) {
            Check[j].abort();
        }
        i++;
    }

</script>



<style>
    ul.tabs
    {
        padding: 7px 0;

        margin:0;
        list-style-type: none;
        text-align: left; /*set to left, center, or right to align the tabs as desired*/
    }

    ul.tabs li
    {
        display: inline;
        margin: 0;
        margin-right:3px; /*distance between tabs*/
        cursor: pointer;
    }

    ul.tabs li a
    {

        text-decoration: none;
        position: relative;
        padding: 7px 16px;
        border: 2px solid #CCC;
        color: #000;
        background: #f4f4f4 url(tabbg.gif) 0 0 repeat-x;

        outline:none;
    }


    ul.tabs li :hover
    {
        position: relative;
        top: 0px;
        background: white;
        border: 1px solid #B7B7B7;

    }


    div.tabcontents
    {
        border: 1px solid #B7B7B7; padding: 30px;

        background-color:#f4f4f4;
        border-radius: 0 3px 3px 3px;
    }

    .SelectTabClass {
        position: relative !important;
        font-weight: bold !important;
        color:white !important;
        background: #7d110c !important;
        border: 1px solid #B7B7B7 !important;
        border-bottom-color: white !important;
    }
</style>        
<script>
    $(function(){
        $( "#mediascoresView" ).bind( "click", function() {
            $("#mediascoresView").attr('class','SelectTabClass');
            $('#mediariversView').attr('class','none');
        });
        
        $( "#mediariversView" ).bind( "click", function() {
            $("#mediariversView").attr('class','SelectTabClass');
            $('#mediascoresView').attr('class','none');
           
        });
      
    });
    function toRiver(url,unitId){
        urlToSetView = '/frontend_dev.php/collection/index';
        $.post(urlToSetView, {view:'river'}, function(response){
            if(response)
                window.location.href=url;
        },'text');
    }
    function toScore(url,unitId){
        urlToSetView = '/frontend_dev.php/collection/index';
        $.post(urlToSetView, {view:'score'}, function(response){
            if(response)
                window.location.href=url;
        },'text');
    }
</script>
<?php if (sizeof($collections) > 0) {
    ?>
    <div style="display: none;"> 
        <div id="fancybox" style="background-color: #F4F4F4;width: 600px;" >
            <header>
                <h5  class="fancybox-heading">Warning!</h5>
            </header>
            <div style="margin: 10px;">
                <h3>Careful!</h3>
            </div>
            <div style="margin: 10px;font-size: 0.8em;">
                You are about to delete a Collection which will permanently erase all information associated with it.<br/>
                Are you sure you want to proceed?
            </div>
            <div style="margin: 10px;"><a class="button" href="javascript://" onclick="$.fancybox.close();">NO</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="deleteCollection(<?php echo $unitID; ?>);">YES</a></div>
        </div>
    </div>
<?php } ?>