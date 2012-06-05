function getRelatedForm(){
    if($('#format-type-model-name').val()!=''){
        urlSuffix='/new';
        if($('#asset_group_format_id').val()!='')
            //            urlSuffix='/edit/id/'+$('#asset_group_format_id').val();
            $('#format_specific').empty();
        $.ajax({
            type: 'POST',
            url: appBaseURL+$('#format-type-model-name').val()+urlSuffix,
            success: function(data,textStatus) {
                $('#format_specific').append(data);
            }
                
        });
    }
    else{
        $('#format_specific').empty();
    }
}
var firstTimeLoad=0;
// Once the document object is loaded...
$('document').ready(function () {
    
    $.blockUI({ message: '<h3><img src="/images/ajax-loader.gif" /> Loading Please wait...</h3>' });  
    // Debugging
    debugAJAXRequest = function (url,requestType,requestData) {
        console.log('Debugging...');

        $.ajax(url,
        {
            type: requestType,
            data: requestData,
            success: function (data) {
                console.log('Success');
                for(attrib in data)
                    console.log(data[attrib]);
            },
            error: function (data) {
                for(attrib in data)
                    console.log(data[attrib]);
            }
        });
    }

    appBaseURL = '/frontend_dev.php/';
    assetGroupID = $('#asset_group_id').val();
    populateStorageLocations = function() {
        collectionID=$('#collection-multiple-select').val();
        if(collectionID) {
            $.get(
                appBaseURL + 'storagelocation/index',
                {
                    c:collectionID
                },
                function (storageLocations) {
                    $('#asset_group_storage_location_id').empty();
                    //$('body').append(storageLocations);
                    for(i in storageLocations)
                        $('#asset_group_storage_location_id').append('<option value="'+storageLocations[i].id+'">'+storageLocations[i].name+'</option>');
                    
                    if(firstTimeLoad==0){
                        firstTimeLoad=1;
                         $.unblockUI(); 
                    }
                });
        }
    }
    // Unit-Collection Multiple Selection
    populateCollections = function (element,stores) {
        element.empty();

        for(i in stores) {
            slected='';
            if(i==0)
                slected='selected="selected"';
            element.append('<option class="collection-multiple-select" value="'+stores[i].id+'" >'+stores[i].name+'</option>');
            if(stores[i].id == serializedCollectionID)
                $('#collection-multiple-select').prop('selectedIndex',i);
        }
       
        $('.collection-multiple-select').click(function () {
            $('#asset_group_parent_node_id').val( $(this).val() );
            populateStorageLocations();
        //console.log( 'updated: '+$('#asset_group_parent_node_id').val() );
        });
        setTimeout('populateStorageLocations();',1000);
    //         populateStorageLocations();
    }
    //
    getCollectionsForUnitID = function (unitID) {
        $.get(
            appBaseURL+'collection/getCollectionsForUnit',
            {
                id:unitID
            },
            function (collections) {
                
                populateCollections( $('#collection-multiple-select'),collections );

            }
            );
    }
    selectUnitForAssetGroupID = function (assetGroupID) {
        $.get(
            appBaseURL+'unit/getUnitForAssetGroup',
            {
                id:assetGroupID
            },
            function (unit) {
                //console.log( unit );
                //relatedUnitID=unit.id
                //$('#unit-multiple-select').prop('selectedIndex',unit.id - 1);
                $('#unit-multiple-select').val(unit.id);
                getCollectionsForUnitID( $('#unit-multiple-select').val().shift() );
            //console.log( $('#unit-multiple-select').val().shift() );
            }
            );
    }
		


    setMultiSelectHandler = function () {

    }
    //
    serializedCollectionID = $('#asset_group_parent_node_id').val();
    var relatedUnitID;
    //
    $.get(
        appBaseURL+'unit/index',
        {},
        function (units) {
            //console.log(indexViewHTML);
            $('#unit-multiple-select').empty();
            //console.log(units);

            for(i in units) {
                //console.log(units[i]);
                $('#unit-multiple-select').append('<option class="unit-multiple-select" value="'+units[i].id+'">'+units[i].name+'</option>');
            }

            selectUnitForAssetGroupID( $('#asset_group_id').val() );
            $('.unit-multiple-select').click(function () {
                //console.log('trace');
                getCollectionsForUnitID( $('#unit-multiple-select').val().shift() );
            });

        });

    $('#asset-group-save').click(function(event) {
        event.preventDefault();

        actionName=$('#asset_group_format_id').val() ? 'update' : 'create';
        urlSuffix='';
        moduleName=$('#format-type-model-name').val();
        if($('#format-type-model-name').val()==''){
            moduleName='formattype';
        }
        if(actionName == 'update') {
            urlSuffix='/id/'+$('#format-type-container input[id$="_id"]').val();
            $.ajax({
                type: 'POST',
                url: appBaseURL+'formattype'+'/'+actionName+urlSuffix,
                data: $('#format-type-container').children('form').serialize(),
                success: function(data,textStatus) {
                    var numericExpression = /^[0-9]+$/;
                    if(data.match(numericExpression)){
                        //                        
                        if($('#format-type-model-name').val()!=''){
                            $.ajax({
                                type: 'POST',
                                url: appBaseURL+moduleName+'/'+actionName+urlSuffix,
                                data: $('#format_specific').children('form').serialize(),
                                success: function(data,textStatus) {
                                    if(data.match(numericExpression)){
                                        $('#asset-group-form').submit(); 
                                    }
                                    else{
                                        $('#format_specific').html(data);
                                    }
                                    
                                }
                            });
                        }
                        else{
                            $('#asset-group-form').submit();
                        }
                        
                    }
                    else{
                        $('#format-type-container').html(data);
                    }
                    
                },
                error: function(data,textStatus,errorThrown) {
                    alert('Error: '+errorThrown+"\n"+'Details: '+textStatus);
                    $('body').html(data['responseText']);
                }
            });
            
        } else if ( $('#asset_group_format_id').prop('selectedIndex') == -1 ) {
            
        } else {
            
            $.ajax({
                type: 'POST',
                url: appBaseURL+'formattype'+'/'+actionName+urlSuffix,
                data: $('#format-type-container').children('form').serialize(),
                success: function(data,textStatus) {
                    var numericExpression = /^[0-9]+$/;
                    if(data.match(numericExpression)){
                        $('#asset_group_format_id').val(data);
                        
                        if($('#format-type-model-name').val()!=''){
                            $.ajax({
                                type: 'POST',
                                url: appBaseURL+moduleName+'/update/id/'+data,
                                data: $('#format_specific').children('form').serialize(),
                                success: function(data,textStatus) {
                                    $('#asset-group-form').submit();
                                }
                            });
                        }
                        else{
                            $('#asset-group-form').submit();
                        }
                    }
                    else{
                        
                        $('#format-type-container').html(data);
                    }
                },
                error: function(data,textStatus,errorThrown) {
                    alert('Error: '+errorThrown+"\n"+'Details: '+textStatus);
                    $('body').html(data['responseText']);
                }
            });
        }
    });

    // For the FormatType Models //
    //if(!$('#asset_group_format_id').val())
    $('#format-type-model-name').prop('selectedIndex',0);
    serializedFormatTypeID=$('#asset_group_format_id').val();
    serializedFormatTypeModelName='';

    getFormatTypeForm = function () {

        formatTypeID=$('#asset_group_format_id').val();
        getAddFormatTypeForm = function () {

            formatTypeName = $('#format-type-model-name').val();
            if( formatTypeName ) {
                $('#format-type-container').load(
                    appBaseURL+formatTypeName+'/new',
                    {},
                    function () {
                        $('#asset_group_format_id').val('');
                    });
            }
            else{
                
                $('#format-type-container').load(
                    appBaseURL+'formattype/newform',
                    {},
                    function () {
                        $('#asset_group_format_id').val('');
                    });
            }
        }

        if(formatTypeID) {
            // Check for match
            // Execute /new for mismatch
            //
            //console.log('selected index: '+$('#format-type-model-name').prop('selectedIndex'));
            if(serializedFormatTypeModelName != '' && serializedFormatTypeModelName != $('#format-type-model-name').val() ) {
                getAddFormatTypeForm();
            } else {

               
                $.getJSON(
                    appBaseURL+'formattype/getModelName',
                    {
                        id:formatTypeID
                    },
                    function (modelName) {
                        modelName = modelName.toLowerCase();
                        if(modelName!='formattype'){
                            if( $('#format-type-model-name').prop('selectedIndex') == 0 || modelName == serializedFormatTypeModelName ) {
                                if( $('#format-type-model-name').prop('selectedIndex') == 0 ) {
                                    $('#format-type-model-name').val(modelName);
                                    serializedFormatTypeModelName=modelName;
                                }
                                $('#format_specific').load(
                                    appBaseURL+modelName+'/edit',
                                    {
                                        id:formatTypeID
                                    }
                                    );
                            } else
                                getAddFormatTypeForm();
                        }
                    });
            }
        } else if(serializedFormatTypeModelName) {
            $('#format-type-container').load(
                appBaseURL+serializedFormatTypeModelName+'/edit',
                {
                    id:serializedFormatTypeID
                },
                function () {
                    $('#asset_group_format_id').val(serializedFormatTypeID);
                }
                );
        } else {
            getAddFormatTypeForm();
        }
    } // Format Type

    // Need to check if Format Type exists...

    //    $('#format-type-model-name').click(function () {
    //        alert(1);
    ////        getFormatTypeForm();
    //    });
    if($('#asset_group_format_id').val()!=''){
        $.ajax({
            type: 'POST',
            url: appBaseURL+'formattype/edit/id/'+$('#asset_group_format_id').val(),
            success: function(data,textStatus) {
                $('#format-type-container').html(data);
            },
            error: function(data,textStatus,errorThrown) {
                alert('Error: '+errorThrown+"\n"+'Details: '+textStatus);
                $('body').html(data['responseText']);
            }
        });
    }

    getFormatTypeForm(); // When the DOM is loaded.

    // For the EvaluatorHistory Models //
    //



    refreshElementHandlers = function () {

        // Populate the EvaluatorHistory values
        $.get(
            appBaseURL+'person/getPersonsForAssetGroup',
            {
                ag:assetGroupID
            },
            function (persons) {
                for(i in persons)
                    $('<option value="'+persons[i].id+'">'+persons[i].first_name+' '+persons[i].last_name+'</option>').appendTo('#evaluator_history_person_list');
            });

        /*
			$.get(
				appBaseURL+'collection/getCollectionsForUnit',
				{id:unitID},
				function (collections) {
				populateCollections( $('#collection-multiple-select'),collections );

				}
			);

 */

        //console.log( $('#evaluator_history_updated_at').prop('tagName') );
        //$('<input id="evaluator-history-updated-datepicker"></div>')
        //.insertBefore( '#evaluator_history_updated_at' )
        $('#evaluator_history_updated_at')
        //$('#evaluator_history_updated_at').datepicker({ 'dateFormat': 'yy-mm-dd',
        .datepicker({
            'dateFormat'		:	'yy-mm-dd',
            'altField'		:	'#evaluator_history_updated_at',
            'showButtonPanel'	:	true,
            'onSelect'		:	function(dateText,inst) {
                console.log( inst.input[0] );

            }
        });

        // If a "delete" hyperlink is clicked...
        $('.evaluator-history-delete').click(function (e) {
            e.preventDefault();
            
            $('#evaluator-history-edit-container').load(
                appBaseURL+'evaluatorhistory/delete?id='+$(this).attr('id'),
                function (data) {
                    location.reload();
                });
        });

        // If an "edit" hyperlink is clicked...
        $('.evaluator-history-edit').click(function (e) {
            e.preventDefault();
            // ...load the Evaluator History Edit View through an AJAX call...
            $('#evaluator-history-edit-container').load(
                appBaseURL+'evaluatorhistory/edit?id='+$(this).attr('id'),
                //'/symfony/mediascore1.0a/frontend_dev.php/'+$(this).attr('href'),
                // ...specifying the Evaluator History ID as a parameter value in the GET request
                //{ id : $(this).attr('target') },
                function (data) {
                    
                    refreshElementHandlers();
                    // Hide the "+ ADD NEW" input element
                    $('#evaluator-history-new').hide();
                    //alert(data);
                    // If the "cancel" hyperlink is clicked...
                    $('#evaluator-history-cancel').click(function () {
                        $('#evaluator-history-edit-container').empty();
                        $('#evaluator-history-new').show();
                    });
                });
        });

        // If the "save" hyperlink is clicked...
        $('#evaluator-history-save').click(function (e) {
            // ...load the Evaluator History Edit View through an AJAX call...
            e.preventDefault();
            if($('#evaluator_history_id').val())
                saveURL=appBaseURL+'evaluatorhistory/update/id/' + $('#evaluator_history_id').val();
            else
                saveURL=appBaseURL+'evaluatorhistory/create';

            $.post(
                saveURL,
                $('#evaluator-history-form').serialize(),
                function(data,textStatus) {

                    //alert('trace');

                    $('#evaluator-history-container').load(
                        appBaseURL+'evaluatorhistory/index',
                        {
                            id : $('input[name="asset_group[id]"]').val()
                        },
                        refreshElementHandlers);

                });
        });

        // If the "+ ADD NEW" input element is clicked...
        $('#evaluator-history-new').click(function () {
            // ...load the Evaluator History New View through an AJAX call...
            $('#evaluator-history-edit-container').load(
                appBaseURL+'evaluatorhistory/new',
                function () {

                    refreshElementHandlers();
                    // Hide the "+ ADD NEW" input element
                    $('#evaluator-history-new').hide();

                    // Load the current date and time
                    //console.log( $('#asset_group_created_at_month').prop('tagName') );
                    now = new Date();

                    // Link this new EvaluatorHistory and AssetGroup objects
                    //$('#evaluator_history_asset_group_id').val( $('input[name="asset_group[id]"]').val() );
                    $('#evaluator_history_asset_group_id').val( $('#asset_group_id').val() );
                    $('#evaluator_history_created_at_year').prop('selectedIndex',now.getFullYear() - 2006);
                    $('#evaluator_history_created_at_month').prop('selectedIndex',now.getMonth()+1);
                    $('#evaluator_history_created_at_day').prop('selectedIndex',now.getDate());
                    $('#evaluator_history_created_at_hour').prop('selectedIndex',now.getHours()+1);
                    $('#evaluator_history_created_at_minute').prop('selectedIndex',now.getMinutes()+1);
                });
        });

        $('#evaluator-history-cancel').click(function () {
            $('#evaluator-history-edit-container').empty();
            $('#evaluator-history-new').show();
        });

    }



    $('#evaluator-history-container').load(
        appBaseURL+'evaluatorhistory/index',
        // ...specifying the Asset Group's ID as a parameter value in the GET request.
        {
            id : $('input[name="asset_group[id]"]').val()
        },
        refreshElementHandlers);

});

