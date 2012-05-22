
$(document).ready(function () {

	appBaseURL = '';

	$('#new').click(function(event) {

		event.preventDefault();

		$.ajax({
			url: '/frontend_dev.php/storagelocation/new',
			requestType: 'GET',
			dataType: 'html',
			success: function (data) {
				modalElement = $('<div id="storage-location-modal"></div>').append($(data));

				modalElement.find('input[type="submit"]').click(function (event) {
					event.preventDefault();
					$.ajax({
						url: '/frontend_dev.php/storagelocation/create',
						data: modalElement.find('form').serialize(),
						type: 'POST',
						success: function (data) {
							modalElement.dialog('close');
							$('#ui-tabs-1').load('frontend_dev.php/storagelocation/index');
							//alert(data);
							//$(data).dialog({height:480,width:640}).dialog('open');
						},
						error: function (xHR,status) {
							alert('status: '+xHR.status);
							$(xHR.responseText).dialog({height:480,width:640}).dialog('open');
						}
					});
				});

				modalElement.dialog({
					autoOpen: false,
					height: 300,
					width: 350,
					modal: true})
				.dialog('open');

				// 05/05/12 - Should be refactored
			}});
		});

	$('.edit').click(function(event) {

		event.preventDefault();
		/*$('div#content')
			.append('<div></div>')
			.load('/symfony/mediascore1.0a/frontend_dev.php/storagelocation/edit',{id: $(this).val().slice(-1) })*/
		$.ajax({
			url: '/frontend_dev.php/storagelocation/edit',
			data: {id: $(this).attr('href').slice(-1)},
			requestType: 'GET',
			dataType: 'html',
			success: function (data) {
				modalElement = $('<div id="storage-location-modal"></div>').append($(data));

				modalElement.find('input[type="submit"]').click(function (event) {
					event.preventDefault();
					$.ajax({
						url: '/frontend_dev.php/storagelocation/update',
						data: modalElement.find('form').serialize(),
						type: 'POST',
						success: function (data) {
							modalElement.dialog('close');
							//alert(data);
							//$(data).dialog({height:480,width:640}).dialog('open');
						},
						error: function (xHR,status) {
							alert('status: '+xHR.status);
							$(xHR.responseText).dialog({height:480,width:640}).dialog('open');
						}
					});
				});

				modalElement.dialog({
					autoOpen: false,
					height: 300,
					width: 350,
					modal: true})
				.dialog('open');

				// 05/05/12 - Should be refactored
			}});
	}); // click()

	$('.delete').click(function(event) {

		deleteElement=$(this);
		//alert( 'dump: '+ deleteElement.attr('href').match(/\/\d.*$/)[0].replace(/^./,'') );

		event.preventDefault();
		//modalElement = $('<div id="storage-location-modal"></div>');
		modalElement = $('<div><span>Delete this record?</span><div id="cancel"><span>NO</span></div><span><a id="confirm" href="#">Yes</a></span></div>');
		modalElement.find('#cancel').click(function () { modalElement.dialog('close') });
		modalElement.find('#confirm').click(function (event) {
			event.preventDefault();

			$.ajax({
				url: '/frontend_dev.php/storagelocation/delete',
				data: {id: deleteElement.attr('href').match(/\/\d.*$/)[0].replace(/^./,'') },
				requestType: 'GET',
				dataType: 'html',
				success: function () {
					modalElement.dialog('close');
					$('#ui-tabs-1').load('/frontend_dev.php/storagelocation/index');
				},
				error: function (xHR,status) {
					alert('status: '+xHR.status);
					$(xHR.responseText).dialog({height:480,width:640}).dialog('open');
				}
			});
		});
		
		modalElement.dialog().dialog('open');

	}); // click()

}); // ready()

