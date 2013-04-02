function login_user()
{
	$.ajax({
		data:	$('#loginform').serialize(),
		type:	'post',
		url:	'inc/functions.php',
		success: function(response) {
			DisplayNotification(response);
			
			if (response == 'Login succeeded')
				loadPage('', 5);
		}
	});
}