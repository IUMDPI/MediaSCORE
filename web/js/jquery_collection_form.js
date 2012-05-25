
$(document).ready(function () {
    //console.log( $('#collection_storage_locations_list').prop('tagName');
    unitSelectElement = $('#collection_parent_node_id');
    storageLocationSelectElement = $('#collection_storage_locations_list');

    //"Loading" message
    $('<option>Loading collections...</option>').appendTo(storageLocationSelectElement);
	
    // For the 'Edit' View
    selectedUnitIndex = unitSelectElement.prop('selectedIndex');
    selectedStorageUnit = storageLocationSelectElement.val();

    unitSelectElement.click(function (event) {
        updateStorageLocationList();

    });

    selectSerializedValues = function () {
        // 'Edit'
        if(unitSelectElement.prop('selectedIndex') == selectedUnitIndex) {
            storageLocationSelectElement.val(selectedStorageUnit);
        }

    }

    updateStorageLocationList = function () {
        $.get(
            '/frontend_dev.php/storagelocation/index',
            {
                u:unitSelectElement.val()
                },
            function (storageLocation) {
                storageLocationSelectElement.empty();
                if(storageLocation.length) {
                    for(i in storageLocation)
                        if(storageLocation[i])
                            $( '<option value="'+storageLocation[i].id+'">'+storageLocation[i].name+'</option>').appendTo(storageLocationSelectElement);
                } else {
                    $( '<option value="-1">(None)</option>').appendTo(storageLocationSelectElement);
                }
		 			
                selectSerializedValues();
        
                storageLocationSelectElement.multiselect({
            'height':'auto'
        }).multiselectfilter(); 
       
            });
    }

    updateStorageLocationList();
//selectSerializedValues();
});
