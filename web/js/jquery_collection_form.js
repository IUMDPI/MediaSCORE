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
                                        '<td style="text-align: right;">'+result[collection].duration+'</td>'+
                                       
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



var collection_score_subject_interest_obj; 
var collection_score_content_quality_obj;
var collection_score_rareness_obj;
var collection_score_documentation_obj;
var collection_score_technical_quality_obj;
var collection_collection_score_obj;
    
//        Calculating total score and setting value in Collection store Field 
function calculateScore(){
    var Total_Collection_Score = 0.0;
        
    var collection_score_subject_interest = parseFloat((collection_score_subject_interest_obj.val())? collection_score_subject_interest_obj.val():0);
    var collection_score_content_quality = parseFloat((collection_score_content_quality_obj.val())? collection_score_content_quality_obj.val():0);
    var collection_score_rareness =parseFloat((collection_score_rareness_obj.val())? collection_score_rareness_obj.val():0);
    var collection_score_technical_quality = parseFloat((collection_score_technical_quality_obj.val())? collection_score_technical_quality_obj.val():0);
    var collection_score_documentation = parseFloat((collection_score_documentation_obj.val())? collection_score_documentation_obj.val():0);
        
    if(isValidScore(collection_score_subject_interest) && IsNumeric(collection_score_subject_interest))
        Total_Collection_Score = Total_Collection_Score + collection_score_subject_interest;
    if(isValidScore(collection_score_content_quality) && IsNumeric(collection_score_content_quality))
        Total_Collection_Score = Total_Collection_Score + collection_score_content_quality;
    if(isValidScore(collection_score_rareness) && IsNumeric(collection_score_rareness))
        Total_Collection_Score = Total_Collection_Score + collection_score_rareness;
    if(isValidScore(collection_score_technical_quality) && IsNumeric(collection_score_technical_quality))
        Total_Collection_Score = Total_Collection_Score + collection_score_technical_quality;
    if(isValidScore(collection_score_documentation) && IsNumeric(collection_score_documentation))
        Total_Collection_Score = Total_Collection_Score + collection_score_documentation
        
    return Math.round(Total_Collection_Score * 100 ) /100;
}
    
//        Check is values a Number 
function IsNumeric(input){
    return !isNaN(parseFloat(input)) && isFinite(input);
}
//        Checking if given score is a value numaric value and less then 5.1 
function isValidScore(value){
    var result=false;
    if(value !='' && typeof value != "undefined") {
        if(IsNumeric(value)){
            value = parseFloat(value);
            if(value>=0 && value<=5){
                result = true;
            }else{
                result = false;
            }
        }else{
            result = false;
        }
    }else{
        result = true;
    }
    return result;
}
    
//        Score Placing and Validation of input Given Score Object
function handleValuesOfTextField(object,CollectionScoreObj){
    var score = object.val();
    if(!isValidScore(score)){
        //            object.val(0)    
        $('#'+object.attr('id')+'_errorn').remove();
        object.after('<span id="'+object.attr('id')+'_errorn" style="color:#7D110C;font-size: 9px;font-weight:bold;"><br/>Score must be integer , greater then 0 and  less then 5 </span>');
    }else{
        $('#'+object.attr('id')+'_errorn').remove();
    }
        
    var Total_Collection_Score = 0.0;
    Total_Collection_Score = calculateScore();
    CollectionScoreObj.val(Total_Collection_Score/5);  
        
}
$(function(){
    //        Getting all Socre input fields Objects
    collection_score_subject_interest_obj = $("#collection_score_subject_interest"); 
    collection_score_content_quality_obj = $("#collection_score_content_quality");
    collection_score_rareness_obj = $("#collection_score_rareness");
    collection_score_documentation_obj = $("#collection_score_documentation");
    collection_score_technical_quality_obj = $("#collection_score_technical_quality");
    collection_collection_score_obj = $("#collection_collection_score");
        
    //        Subject Interest Score Placing  and Validation
    collection_score_subject_interest_obj.live( "keyup change", function() {
        handleValuesOfTextField(collection_score_subject_interest_obj,collection_collection_score_obj); 
                      
    });
        
    //        Content Quality Score Placing  and Validation
    collection_score_content_quality_obj.live( "keyup change", function() {
        handleValuesOfTextField(collection_score_content_quality_obj,collection_collection_score_obj);
                
    });
        
        
    //        Rareness Score Placing  and Validation
    collection_score_rareness_obj.live( "keyup change", function() {
        handleValuesOfTextField(collection_score_rareness_obj,collection_collection_score_obj);
      
    });
        
        
    //        Documentation Score Placing And Validation
    collection_score_documentation_obj.live( "keydown keyup change", function() {
        handleValuesOfTextField(collection_score_documentation_obj,collection_collection_score_obj);
            
    });
        
    //        Technical Quality Score Placing  and Validation
    collection_score_technical_quality_obj.live( "keydown keyup change", function() {
        handleValuesOfTextField(collection_score_technical_quality_obj,collection_collection_score_obj);
           
    });
    //        Fixing date Text and removing the time from date
    var val = $("#collection_date_completed").val().split(' ');
    $("#collection_date_completed").val(val[0]);
        
    //        Initilizing the DataPicker for  collection_date_completed
    var dates = $("#collection_date_completed").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        'dateFormat': 'yy-mm-dd',
        minDate: $("#date_depart").val(),
        onSelect: function(selectedDate) {
            $("#collection_date_completed").datepicker('hide');
        }
    });
});