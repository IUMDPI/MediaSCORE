
<a class="button" href="<?php echo url_for('unit/new') ?>">Create Unit</a>
<!--<a class="button create_new_unit" href="<?php //echo url_for('unit/new')    ?>">Create Unit</a>-->
<div id="search-box">
    <form>
        <div class="search-input">
<!--            <div class="token">Token One<span> <a href="#">X</a></span></div>
          <div class="token">Token One<span> <a href="#">X</a></span></div>-->
            <input type="search" placeholder="Search all records"/>
            <div class="container">
                <a class="search-triangle" href="#"></a>
                <!--              <a class="search-close" href="#"></a>-->
            </div>
            <input class="button" type="submit" value="" />
            <!--            <div class="dropdown-container">
                          <div class="dropdown clearfix Xhidden">  toggle class "hidden" to show/hide 
                            <ul class="left-column">
                              <li><h1>Format</h1></li>
                              <li><a href="#">Format One</a></li>
                              <li><a href="#">Format Two</a></li>
                              <li><a href="#">Format Three</a></li>
                              <li><a href="#">Format Four</a></li>
                            </ul>
                            <ul class="right-column">
                              <li><h1>Type</h1></li>
                              <li><a href="#">Unit</a></li>
                              <li><a href="#">Collection</a></li>
                              <li><a href="#">Asset Group</a></li>
                            </ul>
                          </div>
                        </div>-->
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
                <input type="text" id="from" />
                to
                <input type="text" id="to" />
            </div>
            <strong>Status:</strong>
            <select id="filterStatus" onchange="filterUnits();">
                <option value="">Any Status</option>
                <option value="0">Incomplete</option>
                <option value="1">In Progress</option>
                <option value="2">Completed</option>
            </select>
        </form>
        <div class="reset"><a href="javascript:void(0);" onclick="resetFields('#filterUnits');"><span>R</span> Reset</a></div>
    </div>
</div> 
<div class="show-hide-filter"><a href="javascript:void(0)" onclick="filterToggle();" id="filter_text">Show Filter</a></div> 
<table id="unitTable" class="tablesorter">
    <?php if (sizeof($units) > 0) { ?>
        <thead>
            <tr>
                <th><span>Unit</span></th>
                <th><span>Created</span></th>
                <th><span>Created By</span></th>
                <th><span>Updated On</span></th>
                <th><span>Updated By</span></th>
    <!--                <th></th>-->
            </tr>
        </thead>
        <tbody id="unitResult">
            <?php foreach ($units as $unit): ?>
                <tr>
                    <td><a href="<?php echo url_for('collection/index?u=' . $unit->getId()) ?>"><?php echo $unit->getName() ?></a></td>
                    <td><?php echo $unit->getCreatedAt() ?></td>
                    <td>
                        <?php
//print_r( Doctrine_Core::getTable('User')->find( $unit->getCreatorId() )->getFirstName() );
                        echo '<span>'.$unit->getCreator()->getName().'</span>';

                        /* $evaluatorName = $creators[$unit->getId()];
                          if($evaluatorName == ' ')
                          echo 'Administrator';
                          else
                          echo $evaluatorName; */
                        ?>
                    </td>
                    <td><?php echo $unit->getUpdatedAt() ?></td>
                    <td>
                        <?php
                        echo $unit->getEditor()->getName();
                        /* $lastEditorName = $editors[$unit->getId()];
                          if($lastEditorName == ' ')
                          echo 'Administrator';
                          else
                          echo $lastEditorName; */
                        ?>
                    </td>

                    <td class="invisible">
                        <div class="options">
                            <a href="<?php echo url_for('unit/edit?id=' . $unit->getId()) ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
                            <a href="#fancybox1" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getUnitID(<?php echo $unit->getId(); ?>)"/></a>
                        </div>
                    </td>
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
    function removeSearchText(){
        
    }
    function filterUnits(){
        $.ajax({
            method: 'POST', 
            url: '/frontend_dev.php/unit/index',
            data:{s:$('#searchText').val(),status:$('#filterStatus').val(),from:$('#from').val(),to:$('#to').val(),datetype:$('#date_type').val()},
            dataType: 'json',
            cache: false,
            success: function (result) { 
                
                if(result!=undefined && result.length>0){
                    $('#unitResult').html('');
                    for(collection in result){
                        
                        $('#unitResult').append('<tr><td><a href="collection/index?u='+result[collection].id+'">'+result[collection].name+'</a></td>'+
                            '<td>'+result[collection].created_at+'</td>'+
                            '<td>'+result[collection].Creator.first_name+' '+result[collection].Creator.last_name+'</td>'+
                            '<td>'+result[collection].updated_at+'</td>'+
                            '<td>'+result[collection].Editor.first_name+' '+result[collection].Editor.last_name+'</td>'+
                            '<td class="invisible">'+
                            '<div class="options">'+
                            '<a href="unit/edit/id/' +result[collection].id+'"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a> '+
                            ' <a href="#fancybox1" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getUnitID('+result[collection].id+');"/></a>'+
                            '</div>'+
                            '</td>'+
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
                        'showCloseButton':false
           
                    });
                }
                else{
                    $('#unitResult').html('<tr><td colspan="6" style="text-align:center;">No Unit found</td></tr>');
                }
                    
            }
        });
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