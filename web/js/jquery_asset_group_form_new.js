
// Once the document object is loaded...
$('document').ready(function () {

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

    // asset_group_storage_location_id
    //
    populateStorageLocations = function() {
        collectionID=$('#collection-multiple-select').val();

        if(collectionID) {
            $.get(
                appBaseURL + 'storagelocation/index',
                {
                    c:collectionID,
                    n:1
                },
                function (storageLocations) {
                    selected='';
                    $('#asset_group_storage_location_id').empty();
                    for(i in storageLocations.s){
                        if(storageLocations.n!=undefined && storageLocations.n[i]==storageLocations.s[i].id)
                            selected='selected="selected"';
                         $('#asset_group_storage_location_id').append('<option value="'+storageLocations.s[i].id+'" '+selected+'>'+storageLocations.s[i].name+'</option>');
                    }
                       
                });
        }
        else{
            $('#asset_group_storage_location_id').empty();
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

    selectUnitForAssetGroupID = function (assetGroupID) {
        $.get(
            appBaseURL+'unit/getUnitForAssetGroup',
            {
                id:assetGroupID
            },
            function (unit) {
                selectUnit(unit.id);
                getCollectionsForUnitID( $('#unit-multiple-select').val().shift() );
            }
            );
    }
    serializedCollectionID = $('#asset_group_parent_node_id').val();
    var relatedUnitID;

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

