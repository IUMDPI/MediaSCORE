var globalLocation=new Array();
var globalUnitID=null;
var changes = false;       
function setSessionLocation(storageID,unitID){
    globalLocation=storageID;
    globalUnitID=unitID;
    
}
function saveForm(){
    changes=false;
    $.blockUI({
        css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        }
    }); 
    
}
function checkLocationStatus(){
    if($('#unit-multiple-select').val()==globalUnitID){
        count=0;
        for(i=0;i<globalLocation.length;i++){
            if($('#asset_group_resident_structure_description').val()==globalLocation[i]){
                count=1;
            }
        }
        if(count!=1){
            $('#storageAtLogin').show();
        //            $.growlUI('Storage Location', 'The selected storage location does not match to the current selected storage location!');
        //            $.blockUI({ 
        //                message: $('div.growlUI'), 
        //                fadeIn: 700, 
        //                fadeOut: 700, 
        //                timeout: 5000, 
        //                showOverlay: false, 
        //                centerY: false, 
        //                css: { 
        //                    width: '350px', 
        //                    top: '10px', 
        //                    left: '', 
        //                    right: '10px', 
        //                    border: 'none', 
        //                    padding: '5px', 
        //                    backgroundColor: '#000', 
        //                    '-webkit-border-radius': '10px', 
        //                    '-moz-border-radius': '10px',  
        //                    opacity: .9,   
        //                    color: '#fff' 
        //                } 
        //            }); 
        }
        else{
            $('#storageAtLogin').hide();
        }
    }     
}
// Once the document object is loaded...
$('document').ready(function () {

    getSessionStorage();
    // check if user press key 
    $("input,textarea,select").keypress(function() {
        changes=true;
    });
    $("select").click(function() {
        changes=true;
    });
    

    window.onbeforeunload = function() {
        if (changes)
        {
            return 'You have entered new data on this page.  If you navigate away from this page without first saving your data, the changes will be lost.';
        }
    }

    // Debugging
    debugAJAXRequest = function (url,requestType,requestData) {
        console.log('Debugging...');

        $.ajax(url,
        {
            type: requestType,
            data: requestData,
            success: function (data) {
                alert('Success');
                for(i in data)
                    for(attrib in data[i])
                        alert(attrib+': '+data[attrib]);
            },
            error: function (data) {
                for(attrib in data)
                    alert(data[attrib]);
            }
        });
    }

    appBaseURL = '/frontend_dev.php/';
    assetGroupID = $('#asset_group_id').val();
    
    
    populateStorageLocations = function() {
        collectionID=$('#collection-multiple-select').val();
        unitID=$('#unit-multiple-select').val();
        $('#asset_group_resident_structure_description').html('');
        if(unitID) {
            $.get(
                appBaseURL + 'storagelocation/index',
                {
                    u:unitID
                },
                function (storageLocations) {
                    $('#asset_group_resident_structure_description').html('');
                    if(storageLocations!= undefined && storageLocations.length>0){
                        $('#asset_group_resident_structure_description').append('<option value="">Select</option>');
                        for(i in storageLocations){
                            if($('#unit-multiple-select').val()==globalUnitID){
                                if(globalLocation.length>0){
                                    if(globalLocation[0]==storageLocations[i].id)
                                        selected='selected="selected"';
                                    else
                                        selected='';
                                }
                                
                            }
                            else
                                selected='';
                            $('#asset_group_resident_structure_description').append('<option value="'+storageLocations[i].id+'" '+selected+'>'+storageLocations[i].name+'</option>');
                        } 
                    }
                    else{
                        $('#asset_group_resident_structure_description').append('<option value="">No Storage Location</option>');
                    }
                    
                });
            
        } 
        else{
            $('#asset_group_resident_structure_description').append('<option value="">No Storage Location</option>');
        }
    }

    // Unit-Collection Multiple Selection
    populateCollections = function (element,stores) {
        element.empty();

        for(i in stores) {
            element.append('<option class="collection-multiple-select" value="'+stores[i].id+'">'+stores[i].name+'</option>');
            if(stores[i].id == serializedCollectionID)
                $('#collection-multiple-select').prop('selectedIndex',i);
            else
                $('#collection-multiple-select').prop('selectedIndex',0);
        }
        $('#asset_group_parent_node_id').val( $('#collection-multiple-select').val() );
        
        populateStorageLocations();
        $('.collection-multiple-select').click(function () {
            $('#asset_group_parent_node_id').val( $(this).val() );
        
        });
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

    selectUnit = function (unitID) {
        $('#unit-multiple-select option').each( function(i,element) {
            if(element.value == unitID) {
                $('#unit-multiple-select').prop('selectedIndex',i);
                getCollectionsForUnitID( $('#unit-multiple-select').val().shift() );
            }
        });
    }


    serializedCollectionID = $('#asset_group_parent_node_id').val();
    

    getUnitForCollectionID = function () {
        $.getJSON(	appBaseURL+'unit/show',
        {
            collectionID: $('#asset_group_parent_node_id').val()
        },
        function (unit) {
            selectUnit(unit.id);
        });
    }

    $.get(
        appBaseURL+'unit/index',
        {},
        function (units) {
            $('#unit-multiple-select').empty();
            for(i in units) {
                $('#unit-multiple-select').append('<option class="unit-multiple-select" value="'+units[i].id+'">'+units[i].name+'</option>');
            }
            $('#unit-multiple-select').prop('selectedIndex',0); // No
            getUnitForCollectionID();
            $('.unit-multiple-select').click(function () {
                getCollectionsForUnitID( $('#unit-multiple-select').val().shift() );
            });
        });
});

