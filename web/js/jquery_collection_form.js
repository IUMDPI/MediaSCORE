$(document).ready(function () {
    updateStorageLocationList = function () {
        $.get(
            '/frontend_dev.php/storagelocation/index',
            {
                u:$('#collection_parent_node_id').val()
            },
            function (storageLocation) {
                $('#collection_storage_locations_list').html('');
                if(storageLocation.length) {
                    for(i in storageLocation)
                        if(storageLocation[i]){
                            $('#collection_storage_locations_list').append('<option value="'+storageLocation[i].id+'" selected="selected">'+storageLocation[i].name+'</option>');
                        }
                            
                    $('#collection_storage_locations_list').multiselect({
                        'height':'auto'
                    }).multiselectfilter(); 
                } else {
                    $('#collection_storage_locations_list').append( '<option value="-1">No Storage Location</option>');
                    $('#collection_storage_locations_list').multiselect({
                        'height':'auto',
                        header: "Storage Location!",
                        multiple:false,
                        selectedList: 1 // 0-based index
                    }); 
                    $('#collection_storage_locations_list').multiselect("checkAll"); 
                }
            });
    }
    updateStorageLocationList();
    
    $('#collection_status').multiselect({
        'height':'auto',
        'multiple':false,
        selectedList: 1 // 0-based index
    });
        
    $('#collection_save').click(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/collection/create',
            data: $('#collection_form').serialize(),
            success: function(data,textStatus) {
                var numericExpression = /^[0-9]+$/;
                if(data.match(numericExpression)){
                    $.ajax({
                        method: 'POST', 
                        url: '/frontend_dev.php/collection/index',
                        data:{
                            id:$('#collection_parent_node_id').val()
                        },
                        dataType: 'json',
                        cache: false,
                        success: function (result) { 
                            if(result!=undefined && result.length>0){
                                $('#collectionResult').html('');
                                for(collection in result){
                         
                                    $('#collectionResult').append('<tr> <td class="invisible">'+
                                        '<div class="options">'+
                                        '<a class="new_edit_collection" href="/collection/edit/id/' +result[collection].id+ '/u/'+result[collection].parent_node_id+'"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a> '+
                                        ' <a href="#fancybox" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getCollectionId('+result[collection].id+');"/></a>'+
                                        '</div>'+
                                        '<td><a href="/'+unit_slug_name+'/'+result[collection].name_slug+'/">'+result[collection].inst_id+'</a></td>'+
                                        '<td><a href="/'+unit_slug_name+'/'+result[collection].name_slug+'/">'+result[collection].name+'</a></td>'+
                                        '<td>'+result[collection].created_at+'</td>'+
                                        '<td><span style="display: none;">'+result[collection].Creator.last_name+'</span>'+result[collection].Creator.first_name+result[collection].Creator.last_name+'</td>'+
                                        '<td>'+result[collection].updated_at+'</td>'+
                                        '<td><span style="display: none;">'+result[collection].Editor.last_name+'</span>'+result[collection].Editor.first_name+result[collection].Editor.last_name+'</td>'+
                                        '<td>'+result[collection].duration+'</td>'+
                                       
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
                                $(".new_edit_collection").fancybox({
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
                                $('#collectionResult').html('<tr><td colspan="6" style="text-align:center;">No Collection.</td></tr>');
                            }
                    
                        }
                    });
                    $.fancybox.close();
                }
                else{
                    $('#new_collection').html(data);
                }
                
            },
            error: function(data,textStatus,errorThrown) {
                alert('Error: '+errorThrown+"\n"+'Details: '+textStatus);
                $('body').html(data['responseText']);
            }
        });
        
    });

});
function getStorage(id){
    $.ajax({
        method: 'POST', 
        url: '/frontend_dev.php/storagelocation/index?u='+id,
        dataType: 'json',
        cache: false,
        success: function (result) { 
            $("#collection_storage_locations_list").multiselect("destroy");
            $('#collection_storage_locations_list').html('');
            if(result!=undefined && result.length>0){
                for(storage in result){
                    $('#collection_storage_locations_list').append('<option value="'+result[storage].id+'">'+result[storage].name+'</option>');
                }
            }
            else{
                $('#collection_storage_locations_list').html('<option value="-1">None</option>');
                        
            }
            $("#collection_storage_locations_list").multiselect("refresh");
            $('#collection_storage_locations_list').multiselect({
                'height':'auto'
            }).multiselectfilter(); 
        }
    });
}