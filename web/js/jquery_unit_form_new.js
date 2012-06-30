
$(document).ready(function () {
    retrievedPersonIDs = [];
    retrievedPersons = {};

    refreshSelectedPersonnelTable = function (selectedPersonIDs) {

        $.each(selectedPersonIDs, function (i,personID) {
            //j = $.inArray(personID,Object.keys(retrievedPersons));
            if(personID in retrievedPersons ) {
                if( !$('tr.person#'+personID).length ) {
                    $('<tr class="person" id="'+retrievedPersons[personID].id+'"><td>'+retrievedPersons[personID].first_name+'&nbsp;'+retrievedPersons[personID].last_name+'</td><td>'+retrievedPersons[personID].email+'</td><td>'+retrievedPersons[personID].phone+'</td><td>'+retrievedPersons[personID].role+'</td></tr>').appendTo($('div#selected-unit-persons table tbody'));
                }
            } else {
                $.getJSON(	'/frontend_dev.php/person/show',
                {
                    id: personID
                },
                function (person) {
                    $('<tr class="person" id="'+person.id+'"><td>'+person.first_name+'&nbsp;'+person.last_name+'</td><td>'+person.email+'</td><td>'+person.phone+'</td><td>'+person.role+'</td></tr>').appendTo($('div#selected-unit-persons table tbody'));
                    retrievedPersonIDs.push(person.id);
                    retrievedPersons[person.id] = person;
                });
            }
        });
    }

    $('select#unit_personnel_list').click(function () {

        //$('<tr><td>'
        selectedPersonIDs = $(this).val();

        $('div#selected-unit-persons table tbody tr').each(function (i,tableRowElement) {

            personID = tableRowElement.id;
            if( $.inArray(personID,selectedPersonIDs) == -1) {
                $('tr.person#'+personID).remove(); // jQuery complains (see console)
            }

        });
        refreshSelectedPersonnelTable( selectedPersonIDs );

    });
    $("#unit_storage_locations_list").multiselect({
        'height':'auto'
            
    }).multiselectfilter();
    $('#unit_personnel_list').multiselect({
        'height':'auto'
    }).multiselectfilter();
        
    $('#unit_save').click(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/unit/create',
            data: $('#unit_form').serialize(),
            success: function(data,textStatus) {
                var numericExpression = /^[0-9]+$/;
                if(data.match(numericExpression)){
                    $.ajax({
                        method: 'POST', 
                        url: '/frontend_dev.php/unit/index',
                        dataType: 'json',
                        cache: false,
                        success: function (result) { 
                            if(result!=undefined && result.length>0){
                                $('#unitResult').html('');
                                for(unit in result){
                         
                                    $('#unitResult').append('<tr><td><a href="/'+result[unit].name_slug+'">'+result[unit].name+'</a></td>'+
                                        '<td>'+result[unit].created_at+'</td>'+
                                        '<td><span style="display: none;">'+result[unit].Creator.last_name+'</span>'+result[unit].Creator.first_name+' '+result[unit].Creator.last_name+'</td>'+
                                        '<td>'+result[unit].updated_at+'</td>'+
                                        '<td><span style="display: none;">'+result[unit].Editor.last_name+'</span>'+result[unit].Editor.first_name+' '+result[unit].Editor.last_name+'</td>'+
                                        '<td>'+result[unit].duration+' minute</td>'+
                                        '<td class="invisible">'+
                                        '<div class="options">'+
                                        '<a class="create_new_unit" href="/unit/edit/id/' +result[unit].id+'"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a> '+
                                        ' <a href="#fancybox1" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getUnitID('+result[unit].id+');"/></a>'+
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
                                $('#unitResult').html('<tr><td colspan="6" style="text-align:center;">No Unit.</td></tr>');
                            }
                    
                        }
                    });
                    $.fancybox.close();
                }
                else{
                    $('#new_unit').html(data);
                }
                
            },
            error: function(data,textStatus,errorThrown) {
                alert('Error: '+errorThrown+"\n"+'Details: '+textStatus);
                $('body').html(data['responseText']);
            }
        });
        
    });


});
$("#unit_personnel_list").bind("multiselectclick multiselectcheckall multiselectuncheckall", function(event, ui){
    var array_of_checked_values = $("#unit_personnel_list").multiselect("getChecked").map(function(){
        return this.value;	
    }).get();
        
    getDetail(array_of_checked_values);
});
    
function getDetail(id){
    $.ajax({
        method: 'POST', 
        url: '/frontend_dev.php/unit/getUserDetail?id='+id,
        dataType: 'json',
        cache: false,
        success: function (result) { 
            if(result.records!=undefined){
                length=result.records.length;
                $('#user_info').html('');
                for(cnt=0;cnt<length;cnt++){
                    name=result.records[cnt].first_name+result.records[cnt].last_name;
                    email=result.records[cnt].email_address;
                    phone=result.records[cnt].phone;
                    role=result.records[cnt].role;
                    $('#user_info').append('<tr><td>'+name+'</td><td>'+email+'</td><td>'+phone+'</td><td>'+role+'</td></tr>');
                        
                }
            }
                        
                        
        }
    });
}