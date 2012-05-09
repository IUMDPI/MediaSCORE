
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

		// Unit-Collection Multiple Selection
		populateCollections = function (element,stores) {
			element.empty();

			for(i in stores) {
				//console.log(stores[i]);
				element.append('<option class="collection-multiple-select" value="'+stores[i].id+'">'+stores[i].name+'</option>');
				if(stores[i].id == serializedCollectionID)
					$('#collection-multiple-select').prop('selectedIndex',i);
			}
			/*$(indexViewHTML).find('tbody tr td:nth-child(2)').each(function(i,cellElement) {
				element.append('<option>'+cellElement.innerHTML+'</option>');
				console.log(cElement.innerHTML);
				});*/
			$('.collection-multiple-select').click(function () {
				$('#asset_group_parent_node_id').val( $(this).val() );
				//console.log( 'updated: '+$('#asset_group_parent_node_id').val() );
			});
		}
		//
		getCollectionsForUnitID = function (unitID) {
			$.get(
				appBaseURL+'collection/getCollectionsForUnit',
				{id:unitID},
				function (collections) {
				populateCollections( $('#collection-multiple-select'),collections );

				}
			);
		}
		selectUnitForAssetGroupID = function (assetGroupID) {
			$.get(
				appBaseURL+'unit/getUnitForAssetGroup',
				{id:assetGroupID},
				function (unit) {
					//console.log( unit );
					//relatedUnitID=unit.id
					$('#unit-multiple-select').prop('selectedIndex',unit.id - 1);
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

				//getCollectionsForUnitID( $('#unit-multiple-select').val().shift() );
				//console.log('serialized unit ID: '+relatedUnitID);
				//$('#collection-multiple-select').prop('selectedIndex',serializedCollectionID - 1);
				//getCollectionsForUnitID( $('#unit-multiple-select').val().shift() );
				/*


				//unitRowElement = $(indexViewHTML).find('tbody tr');
				//unitCellElement=unitRowElement.find('td');
				//console.log('found: '+unitCellElement.prop('tagName'));
				$(indexViewHTML).find('tbody tr').each(function(i,unitRowElement) {
					console.log('found: '+$(unitRowElement.innerHTML).find('td').innerHTML );
					//console.log(unitRowElement.innerHTML);
					//console.log('found: '+unitRowElement.prop('tagName'));
				});


				$(indexViewHTML).find('tbody tr').append('<option value="'+$(this).find('td:nth-child(1)').innerHTML+'">'+$(this).find('td:nth-child(2)').innerHTML+'</option>');
				$(indexViewHTML).find('tbody tr').each(function(i,unitRowElement) {
					console.log('i :'+i);

					$('#unit-multiple-select').append('<option value="'+unitRowElement.find('td:nth-child(1)').innerHTML+'">'+unitRowElement.find('td:nth-child(2)').innerHTML+'</option>');
					console.log( $('#unit-multiple-select').html()  );
					//$('#unit-multiple-select').append('<option>'+unitRowElement.children('td:nth-child(1)').innerHTML+'</option>');
				//$(indexViewHTML).find('tbody tr td:nth-child(2)').each(function(i,unitCellElement) {
				//	$('#unit-multiple-select').append('<option>'+unitCellElement.innerHTML+'</option>');

					console.log(unitRowElement.innerHTML);
					//for(attrib in unitRowElement)
					//	console.log(attrib+': '+unitCellElement[attrib]);
				});
				//$(indexViewHTML).find('tbody').children('tr').each( function(i,unitRowElement) {
				//	unitRowElement.children('td').each( function(j,unitCellElement) {
				//		console.log(unitCellElement.html())
				//	});
				//}
				//		);
				//$('#unit-multiple-select').load(function () {
				//	console.log();
				//}*/
			}
		);

		$('#asset-group-save').click(function(event) {
			//console.log('trace');
			event.preventDefault();

			actionName=$('#asset_group_format_id').val() ? 'update' : 'create';

			//console.log( appBaseURL+$('#format-type-model-name').val()+'/'+actionName  );
			//console.log( $('#format-type-container').children('form').serialize() );

			urlSuffix='';

			if(actionName == 'update') {
				//console.log( $('#format-type-container input[id$="_id"]').val() );
				urlSuffix='/id/'+$('#format-type-container input[id$="_id"]').val();
			}

			//$.post(
			$.ajax({
				type: 'POST',
				url: appBaseURL+$('#format-type-model-name').val()+'/'+actionName+urlSuffix,
				data: $('#format-type-container').children('form').serialize(),
				success: function(data,textStatus) {
					formatTypeModelID=$('<div id="format-type-add-response"></div>').appendTo($('body')).html(data).find('input[id$="_id"]').val();
					if(formatTypeModelID)
						$('#asset_group_format_id').val(formatTypeModelID);
					//console.log(formatTypeModelID);
					$('#asset-group-form').submit();
				},
				error: function(data,textStatus,errorThrown) {
					alert('Error: '+errorThrown+"\n"+'Details: '+textStatus);
					$('body').html(data['responseText']);
				}
			});
		});

		// For the FormatType Models //
		//if(!$('#asset_group_format_id').val())
		$('#format-type-model-name').prop('selectedIndex',0);
		serializedFormatTypeID=$('#asset_group_format_id').val();
		serializedFormatTypeModelName='';

		getFormatTypeForm = function () {

			formatTypeID=$('#asset_group_format_id').val();
			getAddFormatTypeForm = function () {
							$('#format-type-container').load(
								appBaseURL+$('#format-type-model-name').val()+'/new',
								{},
								function () {
									$('#asset_group_format_id').val('');
								});
			}

			if(formatTypeID) {
				// Check for match
				// Execute /new for mismatch
				//
				//console.log('selected index: '+$('#format-type-model-name').prop('selectedIndex'));
				if(serializedFormatTypeModelName != '' && serializedFormatTypeModelName != $('#format-type-model-name').val() ) {
					getAddFormatTypeForm();
				} else {

				//
					$.getJSON(
						appBaseURL+'formattype/getModelName',
						{id:formatTypeID},
						function (modelName) {
							modelName = modelName.toLowerCase();

							if( $('#format-type-model-name').prop('selectedIndex') == 0 || modelName == serializedFormatTypeModelName ) {
								if( $('#format-type-model-name').prop('selectedIndex') == 0 ) {
									$('#format-type-model-name').val(modelName);
									serializedFormatTypeModelName=modelName;
								}
								$('#format-type-container').load(
									appBaseURL+modelName+'/edit',
									{id:formatTypeID}
								);
							} else
								getAddFormatTypeForm();
					});
				}
			} else if(serializedFormatTypeModelName) {
				$('#format-type-container').load(
					appBaseURL+serializedFormatTypeModelName+'/edit',
					{id:serializedFormatTypeID},
					function () {
						$('#asset_group_format_id').val(serializedFormatTypeID);
					}
				);
			} else {
				getAddFormatTypeForm();
			}
		} // Format Type

		// Need to check if Format Type exists...

		$('#format-type-model-name').click(function () {

			getFormatTypeForm();
		});


		getFormatTypeForm(); // When the DOM is loaded.

		// For the EvaluatorHistory Models //
		//



		refreshElementHandlers = function () {

		// Populate the EvaluatorHistory values
		$.get(
			appBaseURL+'person/getPersonsForAssetGroup',
			{ag:assetGroupID},
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

		// If a "delete" hyperlink is clicked...
		$('.evaluator-history-delete').click(function (e) {
			e.preventDefault();
			alert('Replace me with a warning modal');
		$('#evaluator-history-edit-container').load(
						appBaseURL+'evaluatorhistory/delete?id='+$(this).attr('id'),
						function (data) {
							location.reload();
						});
		});

		// If an "edit" hyperlink is clicked...
		$('.evaluator-history-edit').click(function (e) {
			e.preventDefault();
			//alert('trace');
			//console.log('trace');
			//console.log( $(this).attr('href') );
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
			//console.log($('#evaluator_history_id').prop('tagName'));
			//console.log($('#evaluator_history_id').val());
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
							{ id : $('input[name="asset_group[id]"]').val() },
							refreshElementHandlers);


						//$('body').append(data);
						//refreshElementHandlers();
						//location.reload();
						//console.log('success');
						//$('#evaluator-history-edit-container').empty();
						//$('#evaluator-history-new').show();
						//$('#evaluator-history-container').html(data);
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
			{ id : $('input[name="asset_group[id]"]').val() },
			refreshElementHandlers);
			// If successful...
			//function () {

		//});
});

		// ...load the Evaluator History Index View for the Asset Group through an AJAX call...

		/*$('#evaluator-history-container').load(
			'/symfony/mediascore1.0a/frontend_dev.php/evaluatorhistory',
			// ...specifying the Asset Group's ID as a parameter value in the GET request.
			{ id : $('input[name="asset_group[id]"]').val() },
			// If successful...
			function () {*/
				// If the "+ ADD NEW" input element is clicked...
				/*$('#evaluator-history-new').click(function () {
				// ...load the Evaluator History New View through an AJAX call...
				$('#evaluator-history-edit-container').load(
					                        '/symfony/mediascore1.0a/frontend_dev.php/evaluatorhistory/new',
								function () {
									// Hide the "+ ADD NEW" input element
									$('#evaluator-history-new').hide();

									// Load the current date and time
									//console.log( $('#asset_group_created_at_month').prop('tagName') );
									now = new Date();

									// Link this new EvaluatorHistory and AssetGroup objects
									$('#evaluator_history_asset_group_id').val( $('input[name="asset_group[id]"]').val() );
									$('#evaluator_history_created_at_year').prop('selectedIndex',now.getFullYear() - 2006);
									$('#evaluator_history_created_at_month').prop('selectedIndex',now.getMonth()+1);
									$('#evaluator_history_created_at_day').prop('selectedIndex',now.getDate());
									$('#evaluator_history_created_at_hour').prop('selectedIndex',now.getHours()+1);
									$('#evaluator_history_created_at_minute').prop('selectedIndex',now.getMinutes()+1);*/
									//console.log( $('#asset_group_created_at_month').prop('selectedIndex') );
									// If the "cancel" hyperlink is clicked...
									/*$('#evaluator-history-cancel').click(function () {
										$('#evaluator-history-edit-container').empty();
										$('#evaluator-history-new').show();
									});*/

									//alert('trace');
									// If the "save" hyperlink is clicked...
									/*$('#evaluator-history-save').click(function (e) {
									// ...load the Evaluator History Edit View through an AJAX call...
										console.log('trace');
										e.preventDefault();

										/*$.ajax('/symfony/mediascore1.0a/frontend_dev.php/evaluatorhistory/create',
											{
												type: 'post',
												data: $('#evaluator-history-form').serialize(),
												error: function (data) {
													for(attrib in data)
														console.log(data[attrib]);
												}
											}
											
										      );*/

									/*	$.post(
											'/symfony/mediascore1.0a/frontend_dev.php/evaluatorhistory/create',
											$('#evaluator-history-form').serialize(),
											function(data,textStatus) {
												console.log('success');
												$('#evaluator-history-edit-container').empty();
												$('#evaluator-history-new').show();
												$('#evaluator-history-container').html(data);

											});
									});*/


								//});
				//});
				// If the "edit" hyperlink is clicked...
				/*$('#evaluator-history-edit').click(function () {
				// ...load the Evaluator History Edit View through an AJAX call...
				$('#evaluator-history-edit-container').load(
								'/symfony/mediascore1.0a/frontend_dev.php/evaluatorhistory/edit',
								// ...specifying the Evaluator History ID as a parameter value in the GET request
								{ id : 1 },
								function () {
									// Hide the "+ ADD NEW" input element
									$('#evaluator-history-new').hide();
									// If the "cancel" hyperlink is clicked...
									$('#evaluator-history-cancel').click(function () {
										$('#evaluator-history-edit-container').empty();
										$('#evaluator-history-new').show();
									});
								});
				});*/
//			});
//});
