
$(document).ready(function() {

	appBaseURL = '/frontend_dev.php';

	$('.menu-link').click(function(event) {
		event.preventDefault();
		//$('#settings-container').load(appBaseURL+'/sfGuardUser/index');
		$('#settings-container').load( $(this).attr('href') ); // Routing bug

	});

});
