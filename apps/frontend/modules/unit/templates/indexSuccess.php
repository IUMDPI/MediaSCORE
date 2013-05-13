<a class="button create_new_unit" href="<?php echo url_for('unit/new') ?>">Create Unit</a>
<div id="search-box">
    <form action="<?php echo url_for('unit/search') ?>" method="post" onkeypress="return event.keyCode != 13;">
        <div class="search-input">
            <div id="token_string" style="float: left;">

            </div>
            <input type="hidden" id="search_values" name="search_values"/>
            <input type="search" placeholder="Search all records" id="mainsearch" onkeyup="makeToken(event);"/>
            <div class="container">
                <a class="search-triangle" href="javascript:void(0);" onclick="$('.dropdown-container').slideToggle();$('.dropdown-container').css('width',$('.search-input').width()+26);"></a><b class="token-count" style="display: none;"></b>
                <a class="search-close" href="javascript:void(0);" onclick="removeAllTokenDivs();" style="display: none;"></a>
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
                    <br/>
                    <ul class="right-column">

                        <li><h1>Storage Location</h1></li>
                        <?php foreach ($AllStorageLocations as $StorageLoca): ?>
                            <li><a href="javascript:void(0);" onclick="GotoStorageLocation('<?php echo $StorageLoca['id'] ?>');"><?php echo $StorageLoca['name'] ?></a></li>
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
            <strong>Storage Location : </strong>
            <input type="text" class="text" onkeyup="filterUnits();" id="searchStorageLocation"/>
<!--            <strong>Score:</strong> <input type="text" name="searchScore" class="text" onkeyup="filterUnits();" id="searchScore"/>-->
        </form>
        <div class="reset"><a href="javascript:void(0);" onclick="resetFields('#filterUnits');"><span>R</span> Reset</a></div>
    </div>
</div> 
<div class="show-hide-filter"><a href="javascript:void(0)" onclick="filterToggle();" id="filter_text">Show Filter</a></div>
<div  style="margin: 10px; text-align: center;color: #7D110C;font-weight: bold;"><?php echo $deleteMessage; ?></div>
<table id="unitTable" class="tablesorter">
    <?php if (sizeof($units) > 0) { ?>
        <thead>
            <tr>
                <td width="50"></td>
                <th><span>Unit</span></th>
                <th><span>Created</span></th>
                <th><span>Created By</span></th>
                <th><span>Updated On</span></th>
                <th><span>Updated By</span></th>
                <th style="text-align: center;"><span>Duration</span></th>
        <!--                <th style="text-align: center;"><span>Storage Locations</span></th>-->
            </tr>
        </thead>
        <tbody id="unitResult">
            <?php foreach ($units as $unit): ?>
                <tr>
                    <td class="invisible">
                        <div class="options">
                            <a class="create_new_unit" href="<?php echo url_for('unit/edit?id=' . $unit->getId()) ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
                            <a href="#fancybox1" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getUnitID(<?php echo $unit->getId(); ?>)"/></a>
                        </div>
                    </td>
                    <td><a href="<?php echo url_for('collection', $unit) ?>"><?php echo $unit->getName() ?></a></td>
                    <td><?php echo $unit->getCreatedAt() ?></td>
                    <td><span style="display: none;"><?php echo $unit->getCreator()->getLastName() ?></span><?php echo '<span>' . $unit->getCreator()->getName(); ?></td>
                    <td><?php echo $unit->getUpdatedAt() ?></td>
                    <td><span style="display: none;"><?php echo $unit->getEditor()->getLastName() ?></span><?php echo $unit->getEditor()->getName(); ?></td>
                    <td style="display: none;"><span style="display: none;"><?php echo (int) minutesToHour::ConvertHoursToMin($unit->getDuration($unit->getId())); ?></span></td>
                    <td style="text-align: right;"><?php echo $unit->getDuration($unit->getId()); ?></td>
        <!--                    <td style="text-align: right;"><?php // echo $unit->getStorageLocation()->getName()  ?></td>-->

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
    $(document).ready(function() {
        var dates = $( "#from, #to" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 2,
            'dateFormat':'yy-mm-dd',
            onSelect: function( selectedDate ) {
                filterUnits();
                var option = this.id == "from" ? "minDate" : "maxDate",
                instance = $( this ).data( "datepicker" ),
                date = $.datepicker.parseDate(
                instance.settings.dateFormat ||
                    $.datepicker._defaults.dateFormat,
                selectedDate, instance.settings );
                dates.not( this ).datepicker( "option", option, date );
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
            'showCloseButton':false
           
        });
        $(".create_new_unit").fancybox({
            'width': '100%',
            'height': '100%',
            'autoScale': true,
            'transitionIn': 'none',
            'transitionOut': 'none',
            'type': 'inline',
            'padding': 0,
            'showCloseButton':true
           
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
    var filter=1;
    var unitId=null;
    var token=0;
    var removeToken=0;
    function getUnitID(id){
        unitId=id;
      
    }
    function deleteUnit(){
        window.location.href='/unit/delete?id='+unitId;
    }
    function filterToggle(){
        $('#filter').slideToggle();
        if(filter==0){
            filter=1;
            $('#filter_text').html('Show Filter');
            
        }
        else{
            $('#filter_text').html('Hide Filter');
            filter=0;
        }
            
            
    }
    function resetFields(form){
        form=$(form);
        form.find('input:text, input:password, input:file, select').val('');
        form.find('input:radio, input:checkbox')
        .removeAttr('checked').removeAttr('selected');
        filterUnits();
    }
    var Check  = new Array();
    var i = 0;
    function filterUnits(){
        Check[i] = $.ajax({ 
            method: 'POST', 
            url: '/unit/index',
            data:{s:$('0#searchText').val(),status:$('#filterStatus').val(),from:$('#from').val(),to:$('#to').val(),datetype:$('#date_type').val(),searchStorageLocation:$('#searchStorageLocation').val()},
            dataType: 'json',
            cache: false,
            success: function (result) { 
                
                if(result!=undefined && result.length>0){
                    $('#unitResult').html('');
                    for(collection in result){
                        
                        $('#unitResult').append('<tr><td class="invisible">'+
                            '<div class="options">'+
                            '<a class="create_new_unit" href="/unit/edit/id/' +result[collection].id+'"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a> '+
                            ' <a href="#fancybox1" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getUnitID('+result[collection].id+');"/></a>'+
                            '</div>'+
                            '</td>'+
                            '<td><a href="/'+result[collection].name_slug+'">'+result[collection].name+'</a></td>'+
                            '<td>'+result[collection].created_at+'</td>'+
                            '<td><span style="display: none;">'+result[collection].Creator.last_name+'</span>'+result[collection].Creator.first_name+' '+result[collection].Creator.last_name+'</td>'+
                            '<td>'+result[collection].updated_at+'</td>'+
                            '<td><span style="display: none;">'+result[collection].Editor.last_name+'</span>'+result[collection].Editor.first_name+' '+result[collection].Editor.last_name+'</td>'+
                            '<td style="text-align: right;">'+result[collection].duration+'</td>');
                        if(result[collection].StorageLocations[0]){
                            $('#unitResult').append('<td style="text-align: right;">'+result[collection].StorageLocations[0].resident_structure_description+'</td>'+'</tr>'); 
                        }else{
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
                        'showCloseButton':false
           
                    });
                    $(".create_new_unit").fancybox({
                        'width': '100%',
                        'height': '100%',
                        'autoScale': true,
                        'transitionIn': 'none',
                        'transitionOut': 'none',
                        'type': 'inline',
                        'padding': 0,
                        'showCloseButton':true
           
                    });
                }
                else{
                    $('#unitResult').html('<tr><td colspan="6" style="text-align:center;">No Unit found</td></tr>');
                }
                $("#unitTable").trigger("update");  
                    
            }
        });
        for(j=0;j<=(i-1);j++){
            Check[j].abort();
        }
        i++;

    }
    function makeToken(event){
    
        if (event.keyCode == 13 && $('#mainsearch').val()!='') {
            token=token+1;
            
            $('#token_string').append('<div class="token" id="div_'+token+'"><span id="search_string_'+token+'">'+$('#mainsearch').val()+'</span><span> <a href="javascript:void(0);" onclick="removeTokenDiv('+token+');">X</a></span></div>');
            getRecords();
            $('#mainsearch').val('');
            $('.dropdown-container').css('width',$('.search-input').width()+26);
            
        }
        else if (event.keyCode == 8) {
            if($('#mainsearch').val()=='' && token!=0){
                if(removeToken==1){
                    $('.token').last().remove();
                    
                    $('.dropdown-container').css('width',$('.search-input').width()+26);
                    token=token-1;
                    removeToken=0;
                    getRecords();
                }
                else{
                    removeToken=1;
                }
                
            }
            
        }
        if(token>0){
            $('.token-count').html(token);
            $('.search-close').show();
            $('.token-count').show();
            
        }
        else{
            $('.token-count').html(token);
            $('.search-close').hide();
            $('.token-count').hide();
        }
        //        console.log(token);
    }
    function removeTokenDiv(id){
        $('#div_'+id).remove();
        
        token=token-1;
        getRecords();
        if(token>0){
            $('.token-count').html(token);
            $('.search-close').show();
            $('.token-count').show();
            $('.dropdown-container').css('width',$('.search-input').width()+26);
            
        }
        else{
            $('.token-count').html(token);
            $('.search-close').hide();
            $('.token-count').hide();
        }

    }
    function removeAllTokenDivs(){
        $('.token').remove();
        token=0;
        getRecords();
        $('.token-count').html(token);
        $('.search-close').hide();
        $('.token-count').hide();
        $('.dropdown-container').css('width',$('.search-input').width()+26);

        
    }
    function makeTypeToken(type){
        if(type==0){
            value='Unit';
        }
        else if(type==1){
            value='Collection';
        }
        else if(type==2){
            value='Asset Group';
        }
        else{
            value=type;
        }
        token=token+1;
        $('#token_string').append('<div class="token" id="div_'+token+'"><span id="search_string_'+token+'">'+value+'</span><span> <a href="javascript:void(0);" onclick="removeTokenDiv('+token+');">X</a></span></div>');
        getRecords();
        $('.dropdown-container').css('width',$('.search-input').width()+26);
        if(token>0){
            $('.token-count').html(token);
            $('.search-close').show();
            $('.token-count').show();
            
        }
        else{
            $('.token-count').html(token);
            $('.search-close').hide();
            $('.token-count').hide();
        }
    }
    function getRecords(){
        var search=new Array();
        count=1;;
        if(token>0){
            for(i=1;i<=token;){
                if($('#search_string_'+count).length>0){
                    search[i-1]=$('#search_string_'+count).text();
                    i++;
                }
                count++;
            }
        }
        $('#search_values').val(search);
    }
</script>
<?php if (sizeof($units) > 0) { ?>
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