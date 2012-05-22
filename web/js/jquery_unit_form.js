
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
						{ id: personID },
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


});
